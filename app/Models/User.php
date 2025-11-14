<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, Billable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'provider',
        'provider_id',
        'email_verified_at',
        'trial_ends_at',
        'stripe_id',
        'pm_type',
        'pm_last_four',
        'companies_viewed',
        'can_download_reports',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'trial_ends_at' => 'datetime',
        'password' => 'hashed',
        'can_download_reports' => 'boolean',
    ];

    protected $dates = [
        'trial_ends_at',
        'email_verified_at',
    ];

    /**
     * Determina si el usuario está en período de prueba.
     */
    public function isOnTrial(): bool
{
    // Administradores y premium nunca son trial
    if ($this->isAdmin() || $this->hasRole('premium')) {
        return false;
    }

    return $this->trial_ends_at && $this->trial_ends_at->isFuture();
}


    /**
     * Días restantes del período de prueba.
     */
    public function trialDaysRemaining(): int
    {
        if (!$this->trial_ends_at) {
            return 0;
        }

        return max(0, now()->diffInDays($this->trial_ends_at));

    }

    /**
     * Verifica si el usuario tiene una suscripción activa.
     */
  public function hasActiveSubscription(): bool
{
    // Solo aplica si algún día Cashier esté funcionando
    return $this->subscribed('default');
}


    /**
     * Controla el acceso a las empresas.
     * Trial: máximo 2 vistas.
     */
    public function canAccessCompany(): array
    {
        if ($this->hasRole(['admin', 'premium'])) {
            return ['canAccess' => true, 'message' => null];
        }

        if ($this->isOnTrial()) {
            if ($this->companies_viewed >= 2) {
                return [
                    'canAccess' => false,
                    'message' => 'Has alcanzado el límite de consultas durante tu prueba. Actualiza tu plan para continuar.'
                ];
            }
            return ['canAccess' => true, 'message' => null];
        }

        return [
            'canAccess' => false,
            'message' => 'Tu período de prueba ha terminado. Actualiza tu plan para continuar.'
        ];
    }

    /**
     * Incrementa el contador de empresas vistas durante el trial.
     */
    public function incrementCompanyViewCount(): void
    {
        if ($this->hasRole('usuario') && $this->isOnTrial()) {
            $this->increment('companies_viewed');
        }
    }

    /**
     * Verifica si el usuario puede descargar informes.
     */
    public function canDownloadReports(): bool
    {
        if ($this->hasRole(['admin', 'premium'])) {
            return true;
        }

        return false; // Trial y básicos no pueden descargar
    }

    /**
     * Determina si el usuario es administrador.
     */
    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    /**
     * Determina si el usuario tiene acceso premium.
     */
public function isPremium(): bool
{
    return $this->hasRole('admin') || $this->hasRole('premium');
}




    public function isFree()
{
    // Premium o admin jamás son free
    if ($this->isPremium()) {
        return false;
    }

    // Trial NO es free
    if ($this->isOnTrial()) {
        return false;
    }

    // Todo lo demás = usuario free real
    return true;
}

/**
 * Determina si el usuario puede ver datos premium de empresas.
 */
public function canSeePremiumData(): bool
{
    return $this->hasRole('admin') || $this->hasRole('premium');
}

 
}

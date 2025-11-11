<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Cashier\Subscription;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, Billable;

    /**
     * The attributes that are mass assignable.
     */
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

    /**
     * The attributes that should be hidden for arrays.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'trial_ends_at' => 'datetime',
        'password' => 'hashed',
        'can_download_reports' => 'boolean',
    ];

    /**
     * Additional date attributes.
     */
    protected $dates = [
        'trial_ends_at',
        'email_verified_at',
    ];

    /**
     * Get the default subscription name.
     *
     * @return string
     */
    public function defaultSubscriptionName()
    {
        return 'default';
    }

    /**
     * Determine if the user is currently on their trial period.
     */
    public function isOnTrial(): bool
    {
        if ($this->trial_ends_at) {
            return $this->trial_ends_at->isFuture();
        }
        
        return parent::onTrial();
    }

    /**
     * Determine if the user has an active subscription.
     * Includes users still in their trial period.
     */
    public function hasActiveSubscription(): bool
    {
        return $this->subscribed('default') || $this->isOnTrial();
    }
    
    /**
     * Get the subscription that is currently on trial.
     *
     * @return \Laravel\Cashier\Subscription|null
     */
    /**
     * Check if user can access a company based on their trial status and view count
     *
     * @return array [canAccess: bool, message: string|null]
     */
    public function canAccessCompany(): array
    {
        // Admins and premium users have unlimited access
        if ($this->hasRole(['admin', 'premium'])) {
            return ['canAccess' => true, 'message' => null];
        }

        // Check if user is on trial
        if ($this->isOnTrial()) {
            if ($this->companies_viewed >= 2) {
                return [
                    'canAccess' => false,
                    'message' => 'Has alcanzado el límite de consultas durante tu prueba. Actualiza tu plan para continuar.'
                ];
            }
            return ['canAccess' => true, 'message' => null];
        }

        // Trial has ended and user is not premium/admin
        return [
            'canAccess' => false,
            'message' => 'Tu periodo de prueba ha terminado. Actualiza tu plan para continuar.'
        ];
    }

    /**
     * Increment the company view counter
     */
    public function incrementCompanyViewCount(): void
    {
        if ($this->hasRole('usuario') && $this->isOnTrial()) {
            $this->increment('companies_viewed');
        }
    }

    /**
     * Check if user can download reports
     */
    public function canDownloadReports(): bool
    {
        // Admins and premium users can always download
        if ($this->hasRole(['admin', 'premium'])) {
            return true;
        }

        // Users on trial cannot download reports
        if ($this->isOnTrial()) {
            return false;
        }

        // For users with trial ended, check their subscription status
        return $this->hasActiveSubscription();
    }

    /**
     * Get the subscription that is currently on trial.
     *
     * @return \Laravel\Cashier\Subscription|null
     */
    public function subscription()
    {
        return $this->subscriptions()->where('stripe_status', 'active')
            ->orWhere('stripe_status', 'trialing')
            ->orWhere('stripe_status', 'incomplete')
            ->orWhere('stripe_status', 'past_due')
            ->orWhere('stripe_status', 'unpaid')
            ->latest()
            ->first();
    }

    /**
     * Determine if the user is an administrator.
     */
    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    /**
     * Determine if the user has premium access.
     *
     * Rules:
     * - Admins always have premium access.
     * - Users with the 'premium' role have access.
     * - Users with an active subscription or trial have access.
     */
    public function isPremium(): bool
    {
        if ($this->isAdmin()) {
            return true;
        }

        if ($this->hasRole('premium')) {
            return true;
        }

        return $this->hasActiveSubscription();
    }
}

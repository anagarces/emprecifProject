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

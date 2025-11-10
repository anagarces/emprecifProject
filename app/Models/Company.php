<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'cif',
        'legal_name',
        'description',
        'sector',
        'website',
        'email',
        'phone',
        'address',
        'city',
        'province',
        'postal_code',
        'country',
        'employees',
        'revenue',
        'profit',
        'financials',
        'directors',
        'shareholders',
        'is_active',
        'founded_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'financials' => 'array',
        'directors' => 'array',
        'shareholders' => 'array',
        'founded_at' => 'datetime',
        'is_active' => 'boolean',
        'revenue' => 'decimal:2',
        'profit' => 'decimal:2',
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted()
    {
        static::creating(function ($company) {
            if (empty($company->slug)) {
                $company->slug = Str::slug($company->name);
            }
        });

        static::updating(function ($company) {
            if ($company->isDirty('name') && empty($company->slug)) {
                $company->slug = Str::slug($company->name);
            }
        });
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get the URL to the company's public profile.
     */
    public function getPublicUrlAttribute(): string
    {
        return route('company.show', $this);
    }

    /**
     * Get the URL to the company's premium profile.
     */
    public function getPremiumUrlAttribute(): string
    {
        return route('company.premium', $this);
    }

    /**
     * Scope a query to only include active companies.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to search companies by name or CIF.
     */
    public function scopeSearch($query, string $search)
    {
        return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('cif', 'like', "%{$search}%")
                    ->orWhere('legal_name', 'like', "%{$search}%");
    }

    /**
     * Get the users who have favorited this company.
     */
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites')
                    ->withTimestamps();
    }

    /**
     * Check if the company is favorited by a specific user.
     */
    public function isFavoritedBy(User $user): bool
    {
        return $this->favoritedBy()->where('user_id', $user->id)->exists();
    }

    /**
     * Get the formatted revenue attribute.
     */
    public function getFormattedRevenueAttribute(): string
    {
        return $this->revenue ? number_format($this->revenue, 2, ',', '.') . ' €' : 'N/A';
    }

    /**
     * Get the formatted profit attribute.
     */
    public function getFormattedProfitAttribute(): string
    {
        return $this->profit ? number_format($this->profit, 2, ',', '.') . ' €' : 'N/A';
    }
}

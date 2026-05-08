<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScentMatchProfile extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'daily_environment',
        'energy_style',
        'scent_impression',
        'climate_profile',
        'social_density',
        'longevity_goal',
        'profile_key',
        'profile_name',
        'headline',
        'reason',
        'recommended_products',
    ];

    protected $casts = [
        'recommended_products' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MenuCafe extends Model
{
    use HasFactory;

    protected $fillable = [
        'cafe_id', 
        'name', 
        'category', 
        'price', 
        'img_menu', 
        'isAvailable', 
        'isCustomizable', 
        'isRecommended'
    ];

    protected $casts = [
        'isAvailable' => 'boolean',
        'isCustomizable' => 'boolean',
        'isRecommended' => 'boolean',
    ];
    /**
     * Get the user that owns the AlamatCafe
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cafe(): BelongsTo
    {
        return $this->belongsTo(Cafe::class);
    }

    public function customizeMenus(): HasMany
    {
        return $this->hasMany(CustomizeMenuCafe::class);
    }
}

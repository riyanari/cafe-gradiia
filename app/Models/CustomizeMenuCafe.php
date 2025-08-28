<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomizeMenuCafe extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_cafe_id',
        'name',
        'price_sub',
        'is_available',
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'price_sub' => 'decimal:2',
    ];

    /**
     * Relasi ke MenuCafe
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menuCafe(): BelongsTo
    {
        return $this->belongsTo(MenuCafe::class);
    }
}

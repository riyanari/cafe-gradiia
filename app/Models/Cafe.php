<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cafe extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'place_type', 'open', 'close', 'rating', 'tables_num', 'is_takeaway', 'logo_cafe'];

    protected $casts = [
        'is_takeaway' => 'boolean',
        'rating' => 'double',
    ];

    /**
     * Get the alamat associated with the Cafe
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function alamat(): HasOne
    {
        return $this->hasOne(AlamatCafe::class);
    }

    /**
     * Get the images associated with the Cafe
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(ImageCafe::class);
    }

    public function menus(): HasMany
    {
        return $this->hasMany(MenuCafe::class);
    }
}

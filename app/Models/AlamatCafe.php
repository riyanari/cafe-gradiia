<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AlamatCafe extends Model
{
    use HasFactory;

    protected $fillable = ['cafe_id', 'country', 'city', 'provinsi', 'url_maps'];


    /**
     * Get the user that owns the AlamatCafe
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cafe(): BelongsTo
    {
        return $this->belongsTo(Cafe::class);
    }
}

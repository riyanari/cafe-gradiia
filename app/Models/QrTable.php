<?php

namespace App\Models\Cafe;

use App\Models\Cafe;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class QrTable extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['cafe_id', 'link_url', 'no_table', 'is_reserved'];

    protected $casts = [
        'is_reserved' => 'boolean',
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
}

<?php

namespace App\Models\Cafe;

use App\Models\MenuCafe;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionMenu extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'menu_cafe_id',
        'transaction_id',
        'quantity',
        'total_price',
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
    // public function transaction(): BelongsTo
    // {
    //     return $this->belongsTo(MenuCafe::class);
    // }
}

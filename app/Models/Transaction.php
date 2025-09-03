<?php

namespace App\Models\Cafe;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'qr_table_id', 
        'invoice', 
        'date', 
        'name_customer', 
        'phone_customer', 
        'price_amount', 
        'is_takeaway', 
        'status'
    ];

    protected $casts = [
        'is_takeaway' => 'boolean',
        'status' => 'boolean',
        'date' => 'date',
    ];

    /**
     * Get the user that owns the AlamatCafe
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function qrTable(): BelongsTo
    {
        return $this->belongsTo(QrTable::class);
    }
}

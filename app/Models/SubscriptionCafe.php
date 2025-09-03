<?php

namespace App\Models\Cafe;

use App\Models\Cafe;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionCafe extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['cafe_id', 'user_id', 'is_premium', 'request_date', 'price'];

    protected $casts = [
        'is_premium' => 'boolean',
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['order_code', 'nama', 'meja', 'catatan', 'total_price'];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}

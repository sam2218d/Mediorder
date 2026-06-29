<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'item_name', 'item_image', 'quantity', 'price'];

    // Tell Laravel this item belongs to an Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
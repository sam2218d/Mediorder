<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'street_address',
        'city',
        'state',
        'zip_code',
        'item_name',
        'item_image',
        'prescription_path',
        'payment_proof_path',
        'total_amount',
        'status'
    ];
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function getTotalAmountAttribute()
    {
        // This takes all the items connected to this order, 
        // multiplies their quantity by their price, and adds them all up!
        $itemsTotal = $this->items->sum(function ($item) {
            return $item->quantity * $item->price;
        });

        // Add your flat shipping fee back in (if you have one)
        $shipping = 50; 
        
        // Add your tax back in (if applicable)
        $tax = $itemsTotal * 0.05; 

        return $itemsTotal + $shipping + $tax;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = "orders";
    protected $fillable = ['customer_id','shipping_id','payment_id','total','status'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function shipping()
    {
        return $this->belongsTo(Shipping::class);
    }

}

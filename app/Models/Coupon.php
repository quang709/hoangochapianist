<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon as SupportCarbon;

class Coupon extends Model
{
    use HasFactory;
    protected $table = "coupons";

    protected $fillable = ['code','quantity','condition','number','start_date','expery_date'];

    public function getExperyDateAttribute()
    {
        return SupportCarbon::parse($this->attributes['expery_date'])->format('Y-m-d');
    }

    public function getStartDateAttribute()
    {
        return SupportCarbon::parse($this->attributes['start_date'])->format('Y-m-d');
    }

    public function customer()
    {
        return $this->belongsToMany(Customer::class, 'coupon_customer');
    }

    public function firstWithExperyDate($code, $customerId)
    {
        return $this->whereCode($code)->whereDoesntHave('customer', fn($q) => $q->where('customers.id', $customerId))
        ->whereDate('expery_date', '>=', SupportCarbon::now())->first();
    }

}

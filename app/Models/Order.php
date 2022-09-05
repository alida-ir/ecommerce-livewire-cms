<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory , SoftDeletes;
    protected $fillable = ['user_id' ,
                            'transportation_cost' ,
                            'transportation_cost_status' ,
                            'total_price' , 'payment_price' ,
                            'payment_status' , 'zip_code' , 'address' , 'state'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function discounts()
    {
        return $this->belongsToMany(Discount::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function transActions()
    {
        return $this->hasMany(TransAction::class);
    }


}

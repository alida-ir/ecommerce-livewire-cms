<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransAction extends Model
{
    use HasFactory;
    protected $fillable = ['user_id' ,
        'order_id' ,
        'price' ,
        'token' ,
        'trans_id' ,
        'card_number' ,
        'trace_number' ,
        'message' ,
        'status' ,
        'tracking_code' ,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function shoe()
    {
        return $this->belongsTo(Shoe::class, 'id_sepatu');
    }

    // public function orderDetails()
    // {
    //     return $this->hasMany(OrderDetail::class, 'id_order', 'id');
    // }
}

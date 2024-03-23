<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shoe extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function treatments(){
        return $this->belongsTo(Treatment::class, 'id_treatment', 'id');
    }

    public function subtreatments(){
        return $this->belongsTo(SubTreatment::class, 'id_subtreatment', 'id');
    }

    // public function orderDetails()
    // {
    //     return $this->hasMany(OrderDetail::class, 'id_sepatu', 'id');
    // }

    public function orders()
    {
        return $this->hasMany(Order::class, 'id_sepatu', 'id');
    }

    
}

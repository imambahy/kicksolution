<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTreatment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function shoes(){
        return $this->hasMany(Shoe::class, 'id_subtreatment', 'id');
    }
}

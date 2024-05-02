<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $guarded =['id'];

    public function order() 
    {
        return $this->hasMany(Order::class, 'id', 'id_pembayaran');
    }
}

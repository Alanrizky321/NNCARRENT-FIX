<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    protected $table = 'ulasans'; // Tambahkan ini untuk memastikan nama tabel
    
    protected $fillable = [
        'user_id',
        'car_model',
        'rating',
        'comment'
    ];
}
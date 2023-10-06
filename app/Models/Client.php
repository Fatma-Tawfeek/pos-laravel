<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'address'
    ];

    protected $casts = [
        'phone' => 'array'
    ];

    public function orders() {
        return $this->hasMany(Order::class);
    }
}

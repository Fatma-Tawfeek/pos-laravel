<?php

namespace App\Models;

use App\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_price',
        'client_id'
    ];

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function products() {
        return $this->belongsToMany(Product::class, 'product_order')->withPivot('quantity');
    }
}

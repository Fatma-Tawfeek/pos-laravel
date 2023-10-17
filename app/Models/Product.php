<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Category;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'name',
        'purchase_price',
        'sale_price',
        'category_id',
        'warehouse_id',
        'stock',
        'description',
        'image'
    ];

    public $translatable = [
        'name',
        'description'
    ];

    public const IMAGE_PATH = 'images/products/';

    public function getProfitPercentAttribute () 
    {
        $profit = $this->sale_price - $this->purchase_price;
        $profit_percent = $profit * 100 / $this->purchase_price;
        return number_format($profit_percent, 2);
    }

    public function category() 
    {
        return $this->belongsTo(Category::class);
    }

    public function warehouse() 
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function orders() {
        return $this->belongsToMany(Order::class, 'product_order');
    }
}

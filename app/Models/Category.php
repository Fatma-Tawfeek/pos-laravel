<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['name'];

    public $translatable = ['name'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

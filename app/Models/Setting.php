<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    public const IMAGE_PATH = 'assets/img/brand/';

    protected $fillable = ['key', 'value'];
}

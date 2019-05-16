<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $fillable = [
        'name', 'product_name', 'max_product_count', 'min_product_count'
    ];
}

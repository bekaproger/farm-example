<?php
/**
 * Created by PhpStorm.
 * User: Bekzod
 * Date: 15.05.2019
 * Time: 19:02
 */

namespace App\Services;

use App\Product;

class ProductService
{
    public function addProduct(string $name, string $unit='item')
    {

        $product = Product::where('name' , $name)->first();

        //If product doesn't exist we add a new one!
        if(!$product){
            $product = Product::create([
                'name' => $name,
                'unit' => $unit
            ]);
        }

        return $product;


    }
}
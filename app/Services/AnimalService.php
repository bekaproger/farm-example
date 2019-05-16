<?php
/**
 * Created by PhpStorm.
 * User: Bekzod
 * Date: 15.05.2019
 * Time: 19:02
 */

namespace App\Services;

use App\Animal;

class AnimalService
{
    public function addAnimal(string $name, string $product_name, string $min, string $max)
    {
        $animal = Animal::create([
            'name' => $name,
            'product_name' => $product_name,
            'min_product_count' => $min,
            'max_product_count' => $max
        ]);
    }
}
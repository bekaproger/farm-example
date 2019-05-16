<?php
/**
 * Created by PhpStorm.
 * User: Bekzod
 * Date: 15.05.2019
 * Time: 18:32
 */

namespace App\Services;

use App\Animal;
use App\Product;

class FarmService
{

    protected $animal;
    protected $product;

    public function __construct(AnimalService $animal, ProductService $product)
    {
        $this->animal = $animal;
        $this->product = $product;
    }

    public function addAnimal(string $name, string $product_name, string $min, string $max, $unit='item')
    {
        //First we need to add product since animal references to the product
        $product = $this->product->addProduct($product_name, $unit);

        //next we add an animal with existing product
        $this->animal->addAnimal($name, $product->name, $min, $max);
    }

    public function getProducts()
    {
        //Getting all animals which were updated more than a minute ago
        $query_animals =Animal::where('updated_at', '<', now()->subMinute()->toDateTime());
        //collection of Animal models
        $animals = $query_animals->get();

        //If we have recently got all products throw exception
        if($animals->count() === 0){
            throw new \Exception('There is no product in the farm!');
        }

        //get an array where the name of the products are keys ['milk' => 0, 'egg' => 0, ....]
        $products = array_fill_keys($animals->groupBy('product_name')->keys()->toArray(), 0);


        //add a random number between max_product_count and min_product_count of the animal to the products
        //['milk' => max < x < min]
        foreach ($animals as $a){
            $product = mt_rand($a->min_product_count, $a->max_product_count);
            $products[$a->product_name] += $product;
        }

        //get the product from the database and add the products from products array and save it
        foreach ($products as $key => $val){
            $p = Product::where('name', $key)->first();
            $p->count += $val;
            $p->save();
        }

        //"update" all animals
        $query_animals->update(['updated_at' => now()->toDateTime()]);
    }
}
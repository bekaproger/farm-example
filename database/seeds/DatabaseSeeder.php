<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Product::class, 1)->create(['name' => 'milk', 'unit' => 'litres']);
        factory(\App\Product::class, 1)->create(['name' =>'egg', 'unit' => 'items']);
        factory(\App\Animal::class, 10)->create();
        factory(\App\Animal::class, 20)->create([
            'name' => 'chicken',
            'max_product_count'=> 1,
            'min_product_count' => 0,
            'product_name' => 'egg'
        ]) ;
        // $this->call(UsersTableSeeder::class);
    }
}

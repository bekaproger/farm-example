<?php

namespace App\Console\Commands;

use App\Animal;
use App\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FarmInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'farm:info';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get information about Farm';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Animals');
        //Getting info about all animals
        $animals = Animal::select(DB::raw('count(*) as count, name, max(max_product_count) as max, min(min_product_count) as min'))->groupBy('name')->get();

        $products = Product::all(['name', 'count'])->toArray();
        //Headers for Animals table
        $headers = ['Count', 'Animal', 'Max', 'Min'];
        //Writing table
        $this->table($headers, array_merge($animals->toArray(), [['Total' => $animals->sum('count')]]));

        //Header for products table
        $product_headers = ['Name', 'Count'];
        $this->info('Products');
        $this->table($product_headers, $products);
    }
}

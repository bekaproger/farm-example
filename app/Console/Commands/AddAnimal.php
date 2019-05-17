<?php

namespace App\Console\Commands;

use App\Services\FarmService;
use Illuminate\Console\Command;

class AddAnimal extends Command
{

    protected $command_options = [
        'name' => 'The name of the animal',
        'product' => 'The name of its product ',
        'max' => 'Max number of product the animal can make',
        'min' => 'Min number of product the animal makes',
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:animal 
                                {--name= : The name of the animal } 
                                {--product= : The name of its product}
                                {--max= : Max number of product the animal can make}
                                {--min= : Min number of product the animal makes }
                                {--unit= : The unit of the product}' ;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add animal and product';

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
    public function handle(FarmService $service)
    {
        //getting all optons
        $name = $this->option('name');
        $product_name = $this->option('product');
        $max = $this->option('max');
        $min = $this->option('min');
        $unit = $this->option('unit')??'item';

        //getting all null options
        $options = array_filter($this->options(), function($option) {
            return is_null($option);
        });

        //check if any of the required option is null
        $options = array_intersect_key($this->command_options, $options );

        //If some of the required options is null return error
        if(count($options) > 0){
            $error = 'Please supply these arguments:' . PHP_EOL;

            foreach ($options as $key => $val){
                $error .= $key . ':' . $val . PHP_EOL;
            }

            $this->error($error);
        }else{
            $service->addAnimal($name, $product_name, $min, $max, $unit);
            $this->info('Animal added');
        }

    }
}

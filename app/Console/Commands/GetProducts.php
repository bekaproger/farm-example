<?php

namespace App\Console\Commands;

use App\Services\FarmService;
use Illuminate\Console\Command;

class GetProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get products';

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
        try{
            $service->getProducts();
        }catch (\Exception $e){
            $this->error($e->getMessage());
        }
    }
}

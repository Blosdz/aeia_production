<?php

namespace App\Console\Commands;

use App\Http\Services\ApiService;   
use Illuminate\Console\Command;
use App\Http\Controllers\CurrenciesController;

class UpdateCryptoExchangeRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:crypto-rates';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch and update crypto exchange rates in cache';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $apiService;
    
    public function __construct(ApiService $apiService)
    {
        parent::__construct();
        // $this->apiService = $apiService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $controller = new CurrenciesController();
        $controller->getUpdateCurrencies();
        $this->info('Currencies updated');
        return 0;
    }
}

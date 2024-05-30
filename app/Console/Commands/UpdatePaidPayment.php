<?php

namespace App\Console\Commands;

use App\Traits\UpdatePaymentTrait;
use Illuminate\Console\Command;

class UpdatePaidPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payments:update-paids';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the payments status from pagado to vencido according to expiration_date';

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
     * @return int
     */
    public function handle()
    {
        UpdatePaymentTrait::updatePaids();

        $this->info("paid payments have been updated to vencido");

        return Command::SUCCESS;
    }
}

<?php

namespace App\Console\Commands;

use App\Traits\UpdatePaymentTrait;
use Illuminate\Console\Command;

class UpdatePaymentStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payments:update-pendings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the payments status from pendiente to vencido according to QR';

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
        UpdatePaymentTrait::updatePendings();

        $this->info("pending payments have been updated to vencido");

        return Command::SUCCESS;
    }
}

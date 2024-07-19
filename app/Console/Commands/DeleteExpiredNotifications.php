<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Notification;
use Carbon\Carbon;

class DeleteExpiredNotifications extends Command
{
    protected $signature = 'notifications:delete-expired';
    protected $description = 'Delete expired notifications';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        Notification::where('expires_at', '<', Carbon::now())->delete();
        $this->info('Expired notifications deleted successfully!');
    }
}

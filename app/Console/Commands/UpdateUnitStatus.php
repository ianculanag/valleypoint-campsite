<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Accommodation;
use Carbon\Carbon;

class UpdateUnitStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:updateUnitStatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $accommodations = Accommodation::where('checkinDatetime', '<', Carbon::now())
        ->count();
        echo "Accommodations before today\n";
        dd($accommodations);
    }
}

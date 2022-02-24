<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use App\Models\Ticket;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();


         $schedule->call(function () {

            $ticket = Ticket::where('tiempo_realizar','>',0)->where('status_id',1)->get();
            foreach($ticket as $ticket)
            {
                $tiempo = $ticket->tiempo_realizar;

                $ticket->tiempo_realizar = $tiempo - 1;
                if($ticket->tiempo_realizar == 0)
                {
                    $ticket->status_id = 5;
                }
                $ticket->save();

            }



        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

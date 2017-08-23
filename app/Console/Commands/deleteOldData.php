<?php

namespace App\Console\Commands;
use App\PostWatcher;
use App\PostHistory;
use Illuminate\Console\Command;

class deleteOldData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reddit:deleteOldData';

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
        $date = new \DateTime;
        $date->modify('-24 hours');
        $last24hours = $date->format('Y-m-d H:i:s');
        $pws = PostWatcher::where('current_karma','<',3000)->where('created_at' ,'<', $last24hours)->get();
        foreach ($pws as $key => $p) {
           $related = $p->postHistory()->delete();
           $p->delete();
        }
    }
}
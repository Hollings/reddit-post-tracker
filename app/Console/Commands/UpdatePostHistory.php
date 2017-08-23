<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\PostWatcher;
use App\PostHistory;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
class UpdatePostHistory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reddit:history';

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
        $yesterday = $date->format('Y-m-d H:i:s');
        $date = new \DateTime;
        $date->modify('-2 hours');
        $last2hours = $date->format('Y-m-d H:i:s');
        $postWatchers = PostWatcher::where('created_at', '>=', $yesterday)->get();
        echo $last2hours.PHP_EOL;
        echo (new \DateTime)->format('Y-m-d H:i:s').PHP_EOL;

        // Generate the "fullname" for each post id
        $postList = [];
        foreach ($postWatchers as $key => $pw) {

            if (strtotime($pw->created_at) < strtotime($last2hours) && ($pw->current_karma - $pw->starting_karma) < 10) {
                $pw->delete();
            } else {
                $postList[] = "t3_".$pw->reddit_id;
            }
        }

        // Reddit limits these calls to 15 per request
        $postListChunks = array_chunk($postList, 15);
        foreach ($postListChunks as $key => $chunk) {
            PostWatcher::byId($chunk);
        }

    }
}

<?php

namespace App\Console\Commands;
use App\PostWatcher;
use App\PostHistory;
use Illuminate\Console\Command;

class GetRandomFromRising extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reddit:rising';

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
        PostWatcher::GetRandomFromRising();
    }
}

<?php

namespace Joy2fun\RedisPubLogger\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class Subscribe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:subscribe 
                            {channel=laravel-log-channel : Redis channel}
                            {--c|connection=default : Redis connection name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A subscriber for redis channel.';

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
        $channel = $this->argument('channel');
        $connection = $this->option('connection');
        Redis::connection($connection)->subscribe([$channel], function ($message) {
            echo $message;
        });
    }
}

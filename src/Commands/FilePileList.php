<?php

namespace KilroyWeb\FilePile\Commands;

use Illuminate\Console\Command;

class FilePileList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'filepile:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all available piles';

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
        $baseURI = config('filepile.baseURI');
        $apiKey = config('filepile.apiKey');
        $this->info($baseURI);
        $this->info($apiKey);
        $this->info('Call FilePile api for this key and list related piles');
    }
}
<?php

namespace KilroyWeb\FilePile\Commands;

use Illuminate\Console\Command;

class FilePile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'filepile';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'An alias for filepile:list';

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
        $this->info('run list command');
    }
}
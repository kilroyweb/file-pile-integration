<?php

namespace KilroyWeb\FilePile\Commands;

use KilroyWeb\FilePile\Support\Files\FileWriter;
use Illuminate\Console\Command;

class FilePileInstallPile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'filepile:install {pileSlug}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install selected pile';

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
        $pileSlug = $this->argument('pileSlug');
        $apiClient = new \KilroyWeb\FilePile\API\Client();
        $pileResponse = $apiClient->call('GET','/api/v1/account/pile/find',['slug'=>$pileSlug]);
        $pile = json_decode($pileResponse);
        if(!$pile){
            $this->error('Pile not found!');
        }else{
            $defaultRootDirectory = base_path();
            $rootDirectory = $this->ask('Root Directory?',$defaultRootDirectory);
            $promptsResponse = $apiClient->call('GET','/api/v1/account/pile/'.$pile->uuid.'/prompt');
            $promptInputs = [];
            $prompts = json_decode($promptsResponse);
            foreach($prompts as $prompt){
                $promptInputs[$prompt->uuid] = $this->ask($prompt->label);
            }
            $filesResponse = $apiClient->call('GET','/api/v1/account/pile/'.$pile->uuid.'/file',[
                'prompts' => $promptInputs,
            ]);
            $fileDetails = json_decode($filesResponse);
            foreach($fileDetails as $fileDetail){
                $this->info('Creating: '.$fileDetail->path);
                $filePath = $defaultRootDirectory.'/'.$fileDetail->path;
                $fileContent = base64_decode($fileDetail->content);
                $fileWriter = new FileWriter();
                $fileWriter->create($filePath,$fileContent);
            }
        }
    }

}
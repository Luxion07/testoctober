<?php
/**
 * Created by PhpStorm.
 * User: darinx
 * Date: 20.12.16
 * Time: 13:18
 */

namespace Vanya\Console;
use Illuminate\Console\Command;
use System\Classes\UpdateManager;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Vanya\Models\InstaPhoto;

class GetPhotos extends Command
{
    /**
     * The console command name.
     */
    protected $name = 'getPhotos';

    /**
     * The console command description.
     */
    protected $description = 'Getting insta photos and store';
    protected $apiLink = 'https://api.instagram.com/v1/users/4295819079/media/recent?access_token=4295819079.ac5ca3e.9a9fed16a1ba4b8d83df9bb5dea5e618';


    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function fire()
    {
        $ch = curl_init($this->apiLink);

        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $json = json_decode(curl_exec($ch));
        curl_close($ch);
        if($json){
            $iterator = 0;
            InstaPhoto::whereNotNull('id')->delete();
            $count = InstaPhoto::count();
            if(!$count){
                foreach ($json->data as $post){
                    //$post->images->standard_resolution->url
                    if($post->type == "image"){
                        InstaPhoto::create(['src' => $post->images->standard_resolution->url]);
                        $iterator++;
                    }
                    if($iterator == 5){
                        break;
                    }
                }
            }

        }
    }

    /**
     * Get the console command arguments.
     */
    protected function getArguments()
    {
        return [];
    }

    /**
     * Get the console command options.
     */
    protected function getOptions()
    {
        return [];
    }

}
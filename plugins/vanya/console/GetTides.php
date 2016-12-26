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
use Vanya\Models\Tides;

class GetTides extends Command
{
    /**
     * The console command name.
     */
    protected $name = 'getTides';

    /**
     * The console command description.
     */
    protected $description = 'Getting tides info via API and store it in DB';

    protected $apiLink = 'https://www.worldtides.info/api?heights&lat=50.715&lon=-1.987&key=467c21bc-80aa-45ec-baf4-3fc731f07807';

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
        $out='';
        $min = $min_time = $max = $max_time =0;
        if( $curl = curl_init() ) {
            curl_setopt($curl, CURLOPT_URL, $this->apiLink);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
            $out = json_decode(curl_exec($curl));
            curl_close($curl);
        }
        if($out){
            $min = $max = $out->heights[0]->height;
            $min_time = $max_time = $out->heights[0]->dt;
            foreach($out->heights as $data) {
//                if (\Carbon\Carbon::createFromTimestamp($data->dt)->diffInDays() == 0) {
                    if ($max < $data->height) {
                        $max = $data->height;
                        $max_time = $data->dt;
                    }
                    if ($min > $data->height) {
                        $min = $data->height;
                        $min_time = $data->dt;
                    }
//                }
            }
            $t = Tides::first();
            if(!$t){
                $t = Tides::create([
                    'max' => strval($max),
                    'max_time' => strval($max_time),
                    'min' => strval($min),
                    'min_time' => strval($min_time),
                    'updated_at' => \Carbon\Carbon::now()
                ]);
            }else{
                $min_h =\Carbon\Carbon::createFromTimestamp($min_time)->hour;
                $min_min = \Carbon\Carbon::createFromTimestamp($min_time)->minute;
                $max_h = \Carbon\Carbon::createFromTimestamp($max_time)->hour;
                $max_min = \Carbon\Carbon::createFromTimestamp($max_time)->minute;
                if($min_min == 0){
                    $min_min = '00';
                }
                if($max_min == 0){
                    $max_min = '00';
                }
                $t->max = strval($max);
                $t->min = strval($min);
                $t->min_time = strlen($min_h)>1 ? $min_h.':'.$min_min : '0'.$min_h.':'.$min_min;
                $t->max_time = strlen($max_h)>1 ? $max_h.':'.$max_min : '0'.$max_h.':'.$max_min;
                $t->updated_at = \Carbon\Carbon::now();
                $t->save();
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
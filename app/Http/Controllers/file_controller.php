<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class file_controller extends Controller
{
    function video_feed($file_name){
        $file=base_path("app/Models/videos/".$file_name);
        //check file exist
        if (!file_exists($file)){
           return "the file did not exist";
        }
        //check is not empty file
        if(($file_size = filesize($file))===false){
            return "unable to get filesize";
        }
        $start = 0;
        $end = $file_size-1;
        if(($file_open=fopen($file,'rb'))==false){
            return "unable to open file";
        }

        $response_headers['accept-ranges'] = 'bytes';

        if(isset($_SERVER['HTTP_RANGE'])){

            //check range start position
            if(preg_match("/=([0-9]+)-([0-9]+)\/([0-9]+)$/",$_SERVER['HTTP_RANGE'],$match)){
                $start = $match['1'];
                $end = $match['2']-1;
            }
            elseif(preg_match("/=([0-9]+)-?$/",$_SERVER['HTTP_RANGE'],$match)){
                 $start = $match['1'];
             }
        
            //check not out of range
            if(($start>$end)||($start>$file_size)||($end>$file_size)||($end<=$start)){
                http_response_code(416);
                exit();   
            }
        
            //position the file pointer at the request range
            fseek($file_open,$start);
        
            http_response_code(206);
        
            //set the range of response header
            $response_headers['content-range'] = 'bytes '.$start.'-'.$end.'/'.$file_size;
        }else{
           http_response_code(200);
        }

        //set header value
        $response_headers['content-length'] = ($file_size - $start);

        //set date of header and check modification
        if (($timestamp = filemtime($file))!=false){
            $response_headers['last-modified'] = gmdate("D, dM Y H:i:s",$timestamp).'GMT';
            if ((isset($SERVER['HTTP_IF_MODIFIED_SINCE']))&&($_SERVER['HTTP_IF_MODIFIED_SINCE']==$response_headers['last-modified'])){
                http_response_code(304); //not modified
                exit();
            }   
        }

        //set header
        $response_headers['content-type'] = 'video/mp4';
        foreach ($response_headers as $header=>$value){
            header($header.': '.$value);
        }

        //start the file output
        $buffer = 1024;
        while(!feof($file_open)&&($pointer = ftell($file_open)) <= $end){
    
            //calculate remaining size
            if ($pointer +$buffer > $end){
                $buffer = $end - $pointer +1;
            }
    
            //output file
            $video_data=fread($file_open,$buffer);
            print ($video_data);
            flush();
        }
        fclose($file_open);
        exit();
    }
    function file_seek($video_name){
        $file_path=base_path("app/Models/jsons/video_data.json");
        $file_json=json_decode(file_get_contents($file_path),true);
        foreach($file_json as $object){
            if($object['video_name']==$video_name){
                return $object['file_name'] ;
            }
            return false;
        }
    }
}
?>
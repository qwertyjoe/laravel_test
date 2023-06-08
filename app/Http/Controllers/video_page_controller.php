<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class video_page_controller extends Controller
{
    private $user_check;
    private $file_name;
    private $file_path;
    private $file_json;
    public function request_video($video_name){
        $this->user_check=$this->verified_user();
        if(!$this->user_check){
            return redirect('/?error=please login');
        }else if($this->user_check){
            $this->file_path=base_path("app/Models/jsons/video_data.json");
            $this->file_json=json_decode(file_get_contents($this->file_path),true);
            $this->file_name=$this->find_file_name($video_name);
            if($this->file_name!=false){
                return view('video',["file_name"=>$this->file_name,"video_name"=>$video_name]);
                
            }
            else{
                return"video is not exist";
            }
        }
    }
    public function find_file_name($video_name){
        foreach($this->file_json as $object){
            if($object['video_name']==$video_name){
                return $object['file_name'] ;
            }
        }
        return false;
    }
}
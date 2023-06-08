<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Route;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    function verified_user(){
        session_save_path(base_path('app/Models/jsons/'));
        session_start();
        if(isset($_COOKIE['user'])&&isset($_SESSION[$_COOKIE['user']])&&$_SESSION[$_COOKIE['user']]==$_COOKIE['id']){
            return True ; 
        }
        else {
            return false;
        }
    }
    function check_login(){
        $check_user=$this->verified_user();
        if($check_user){
            return view('home');
        }else{
            return redirect('/?error=please login');
        }
    }
    function direct_user(){
        $check_user=$this->verified_user();
        if($check_user){
            return redirect('/home');
        }else{
            return view('password');
        }
    }
}

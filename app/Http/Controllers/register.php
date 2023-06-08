<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;


class register extends Controller
{
    /**
     * @return string
     */
    private $json_path="";
    private $exist_error=false;
    private $result = "";
    public function register(){
        $this->json_path=base_path("app/Models/jsons/data.json");
        $account=$_POST['account'];
        $password=$_POST['password'];
        if(!preg_match('/^[a-zA-Z0-9_]+$/',$account)){
            return redirect('/register?error=account must be letters or numbers');
        }else if(!preg_match('/^[a-zA-Z0-9_]+$/',$password)){
            return redirect('/register?error=password must be letters or numbers');
        }
        
        $password = password_hash($password,PASSWORD_DEFAULT);
        $json = json_decode(file_get_contents($this->json_path),true);
        $this->exist_error=$this->account_exists($json,$account);
        if($this->exist_error){
            return redirect('/register?error=account have been exist');
        }
        $new_user=[
            "account" => $account,
            "password" =>$password,
        ];
        $this->inser_user($json,$new_user);
        return redirect('/?result='.$this->result);
        
    }
    public function account_exists($list,$account){
        foreach($list as $json ){
            if($account==$json['account']){
                return true;
            }
        }
    }

    public function inser_user($json,$new_account){
        array_push($json,$new_account);
        if(file_put_contents($this->json_path,json_encode($json))){
            return $this->result="registeration is successful";
        }
        else{
            return $this->result="registeration is fail";
        } 
    }
    
}


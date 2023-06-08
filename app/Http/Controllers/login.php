<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class login extends Controller
{
    /**
     * @return string
     */
    private $json_path="";
    private $exist;
    private $right_password;
    //private $num=0;
    public function login()
    {   
        $account=$_POST['account'];
        $password=$_POST['password'];
        $this->json_path=base_path("app/Models/jsons/data.json");
        if(!preg_match('/^[a-zA-Z0-9_]+$/',$account)){
            return redirect("/?error=account must be letters or numbers");
        }else if(!preg_match('/^[a-zA-Z0-9_]+$/',$password)){
            return redirect("/?error=password must be letters or numbers");
        }
        $json=json_decode(file_get_contents($this->json_path),true);
        $this->exist = $this->account_exist($json,$account);
        if(!$this->exist){
            return redirect("/?error=account is not exist");
        }else if($this->exist){
            $this->right_password=$this->check_password($json,$account,$password);
        }
        if(!$this->right_password){
            return redirect("/?error=wrong account or password");
        }else if($this->right_password){
            $this->session_cookie($account);
            //$json[$this->num]['password']="work";
            //file_put_contents($this->json_path,json_encode($json));
            return view("home");
        }
        
    }
    public function account_exist($json,$account){
        foreach($json as $json){
            if($json['account']==$account){
                return true;
            }
        }
        return false;
    }
    public function check_password($json,$account,$password){
        foreach($json as $json){
            if($json['account']==$account){
                if(password_verify($password,$json['password'])){
                    
                    return true;
                }
            }
            //$this->num+=1;
        }
        
        return false;
    }

    public function session_cookie($account){
        session_save_path(base_path('app/Models/jsons/'));
        session_start();
        $account_hash=password_hash($account,PASSWORD_DEFAULT);
        $_SESSION[$account]=$account_hash;
        setcookie("user",$account);
        setcookie("id",$account_hash);
    }

    
}

<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class PlayersTable extends Table
{
    public function insertPlayer($id,$username, $pwd){
        
        $hashPWD = password_hash($pwd, PASSWORD_BCRYPT);

        $query = TableRegistry::get('players')->query();
        $query->insert(['id','email', 'password'])
            ->values([
                'id' => $id,
                'email' => $username,
                'password' => $hashPWD 
            ])
            ->execute();

    }
    public function checkCredentials($Flog, $Fpass){

       $query_pwd = TableRegistry::get('players')->find()
       ->select(['password'])
       ->where(['email =' => $Flog]);

       foreach($query_pwd as $player){

           if (password_verify($Fpass, $player['password'])){
               return true;
           }
       }
    }

     public function checkExists($Flog, $Fpass){

        $exist = false;

        $check_log = TableRegistry::get('players')->find()
        ->select(['id'])
        ->where(['email =' => $Flog]);

        $check_pwd = TableRegistry::get('players')->find()
        ->select(['id'])
        ->where(['password =' => $Fpass]);


        foreach($check_log as $l){

            if ($l['id']){
                
                $exist = true;
                
            }
        }

        foreach($check_pwd as $p){

            if ($p['id']){
                
                $exist = true;
                
            }
        }
        

        return $exist;

     }


     public function getIDfromLog($Flog)
     {
         $get_id = TableRegistry::get('players')->find()
         ->select(['id'])
         ->where(['email =' => $Flog]);

         foreach($get_id as $l){
                 return $l['id'];  
         }


     }

     public function ResetLostPWD($Flog)
     {

        $exist = false;

        $check_log = TableRegistry::get('players')->find()
        ->select(['id'])
        ->where(['email =' => $Flog]);

        foreach($check_log as $l){
            if ($l['id']){
                $exist = true;    
            }
        }

        if($exist == true)
        {
            $new_pass = substr(md5(rand()), 0, 10);
            $hashPWD = password_hash($new_pass, PASSWORD_BCRYPT);

            $reset_pwd = TableRegistry::get('players')->query() // augmente le lvl de 1 
            ->update()
            ->set(['password' => $hashPWD])
            ->where(['email' => $Flog])
            ->execute();

            return $new_pass;

        }
        else
            return "";


        
     }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class PlayersTable extends Table
{


    public function insertPlayer($id,$username, $pwd){

        $query = TableRegistry::get('players')->query();
        $query->insert(['id','email', 'password'])
            ->values([
                'id' => $id,
                'email' => $username,
                'password' => $pwd
            ])
            ->execute();

    }
     public function checkCredentials($Flog, $Fpass){

        $query_pwd = TableRegistry::get('players')->find()
        ->select(['password'])
        ->where(['email =' => $Flog]);


        // Par ici le hash mesieurs


        foreach($query_pwd as $player){

            if ($player['password'] ==  $Fpass){
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
                echo "Cet Email est déjà utilisé, veuillez en choisir un autre pour continuer";
                $exist = true;
                
            }
        }

        foreach($check_pwd as $p){

            if ($p['id']){
                echo "<br/> Ce Mot de passe est déjà utilisé, veuillez en choisir un autre pour continuer";
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
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class PlayersTable extends Table
{
    public function test(){
        return 'ok';
    }
    
    public function getPlayer($password){
        echo "saluu";
        $query = TableRegistry::get('players')->find();
        //debug($query);
        //echo $query;
        //foreach($query as $player){
        //    echo $player;
        //}
        
        //recupération des donnée d'un ligne!
        $query2 = $query->where(['id' => '545f827c-576c-4dc5-ab6d-27c33186dc3e' ]);
        foreach($query2 as $player){
            printf($player);
        }
        
        //select('password')->where(['id' => '545f827c-576c-4dc5-ab6d-27c33186dc3e']);
        //recupération des donnée
        //echo $query3;
        $query3 = TableRegistry::get('players')->find()->extract('password');
        foreach($query3 as $player){
            echo $player;
            if ($player==$password){
                return true;
            }
        }
        return false;
        
        
        //foreach ($query as $row){
        //    echo $row;
        //}
        //echo $query3;
        
        
        //$player_pass=$this->get('players')->find('all')->where(['id' => '545f827c-576c-4dc5-ab6d-27c33186dc3e' ]);//suppression du order entre all et first
        //$figterlist= $this->query("SELECT * FROM fighters;");
        //debug()
        //echo $player_pass;
        //if($player_pass == $password){
        //    return true;
        //}else{
        //    return false;
        //}
    }

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


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
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


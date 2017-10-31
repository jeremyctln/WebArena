<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class FightersTable extends Table
{   
    public function getMainFighter($idFighter, $idPlayer){
        $query = TableRegistry::get('fighters')->find()->where(['id' => $idFighter, 'player_id' => $idPlayer]);
        return $query;
    }
              
    public function getEnemyFighter($idFighter, $idPlayer){
        $query = TableRegistry::get('fighters')->find()->where(['id !=' => $idFighter, 'player_id !=' => $idPlayer]);
        return $query;
    }
    
    public function getXP($idFighter, $idPlayer){
        $query = TableRegistry::get('fighters')->find()->select('xp')->where(['id' => $idFighter, 'player_id' => $idPlayer]);
        return $query;
    }
    
    public function getHealth($idFighter, $idPlayer){
        $query = TableRegistry::get('fighters')->find()->select('skill_health')->where(['id' => $idFighter, 'player_id' => $idPlayer]);
        return $query;
    }
    
    public function getCurrent($idFighter, $idPlayer){
        $query = TableRegistry::get('fighters')->find()->select('current_health')->where(['id' => $idFighter, 'player_id' => $idPlayer]);
        return $query;
    }
    
    public function getStrength($idFighter, $idPlayer){
        $query = TableRegistry::get('fighters')->find()->select('skill_strength')->where(['id' => $idFighter, 'player_id' => $idPlayer]);
        return $query;
    }
    public function getSight($idFighter, $idPlayer){
        $query = TableRegistry::get('fighters')->find()->select('skill_sight')->where(['id' => $idFighter, 'player_id' => $idPlayer]);
        return $query;
    }

    
    public function getBestFighter(){
        $figterlist=$this->find("all")->first();//suppression du order entre all et first
        //$figterlist= $this->query("SELECT * FROM fighters;");
        return $figterlist;
    }
              
    public function getFighter($fighterID){
        
        $table=$query = TableRegistry::get('fighters')->find();
        //$fighter = $query->select;
        foreach ($table as $t) {
            
        }
    }


    public function fighterAttack($idPlayer, $idFighter, $direction){
        $query = TableRegistry::get('fighters');
        
       //INFO ABOUT THE FIGHTER THAT WE ARE USING
       $fighterInfo = $query->find()->where(['id' => $idFighter]);
       
       foreach($fighterInfo as $fighterI){
            
            // FOR THE ALEATOIRE SUCCESS 
            //LEVEL OF THE FIGHTER THAT ATTACK
            $levelFighterAttack = $fighterI['level'];
            
            //XP OF THE FIGHTER THAT ATTACK
            $xpFighterAttack =$fighterI['xp'];
            
            //INFORMATIONS OF THE FIGHTER THAT IS ATTACK
            if ($direction == "up"){
                $fighterIsAttack = $query->find()->where(['coordinate_x' => $fighterI['coordinate_x'], 'coordinate_y' => $fighterI['coordinate_y']-1]);
            }elseif($direction == "right"){
                $fighterIsAttack = $query->find()->where(['coordinate_y' => $fighterI['coordinate_y'], 'coordinate_x' => $fighterI['coordinate_x']+1]);
            }elseif($direction == "left"){
                $fighterIsAttack = $query->find()->where(['coordinate_y' => $fighterI['coordinate_y'], 'coordinate_x' => $fighterI['coordinate_x']-1]);
            }elseif($direction == "down"){
                $fighterIsAttack = $query->find()->where(['coordinate_x' => $fighterI['coordinate_x'], 'coordinate_y' => $fighterI['coordinate_y']+1]);
            }                
                //TO TAKE THE LEVEL OF THE FIGHTER THAT IS ATTACK
                
            foreach($fighterIsAttack as $fighterA){

                $levelFighterIsAttack = $fighterA['level']; // LEVEL OF THE FIGHTER THAT IS ATTACK
                //DECREASE THE HEALTH OF THE FIGHTER ENEMIE

                $aleaSuccess = rand (1, 20);

                // DEFINE IF THE ATTACK IS A SUCCESS OR NOT
                    if($aleaSuccess > (10 + $levelFighterIsAttack - $levelFighterAttack)){

                        //DECREASE THE LIFE A THE FIGHTER ENEMIE
                        $query->find()->update()->set(['current_health' => $fighterA['current_health']-$fighterI['skill_strength']])->where(['id' => $fighterA['id']])->execute();

                        //INCREASE THE XP OF THE FIGHTER OF +1 WHEN THE FIGHTER ATTACK 
                        $query->find()->update()->set(['xp' => $fighterI['xp']+1])->where(['id' => $fighterI['id']])->execute();

                        //VERIFICATION THAT THE ENEMIE FIGHTER IS NOT DEAD
                        if($fighterA['current_health'] - $fighterI['skill_strength'] <= 0){

                            
                            //DELETE THE FIGHTER FROM THE DATABASE
                            $query->query()->delete()->where(['id' => $fighterA['id']])->execute();

                            //INCREASE THE XP OF THE FIGHTER THAT KILL THE OTHER FIGHTER
                            $query->find()->update()->set(['xp' => $fighterI['xp']+$fighterA['level']])->where(['id' => $fighterI['id']])->execute();
                            //RECOVER THE ACTUAL INFORMATION  OF THE FIGHTER
                            $fighterInfo = $query->find()->where(['id' => $idFighter]);                
                              
                        //CHECK THE LEVEL OF THE FIGHTER
                        foreach($fighterInfo as $fighterI){

                            $levelFighter = $fighterI['level'];
                            $xpFighter = $fighterI['xp'];

                            //DISPLAY A FLOAT 
                            $actualLevel =  floor($xpFighter/4);

                            //CHECK IF THE VALUE OF THE LEVEL IS EQUAL TO THE VALUE CALCULATE
                            // IF NOT THE CASE THE FIGHTER WIN A LEVEL
                            if($levelFighter != $actualLevel){//AMELIORATION IS THE LEVEL INCREASE
                                //$query->find()->update()->set(['level' => $actualLevel])->where(['id' => $fighterI['id']])->execute();
                                /*
                                $query->find()->update()->set(['skill_sight' => $fighterI['skill_sight']+1])->where(['id' => $fighterI['id']])->execute();
                                $query->find()->update()->set(['skill_strength' => $fighterI['skill_strength']+1])->where(['id' => $fighterI['id']])->execute();
                                $query->find()->update()->set(['skill_health' => $fighterI['skill_health']+3])->where(['id' => $fighterI['id']])->execute();*/
                                //INCREASE THE LIFE OF THE FIGHTER TO THE MAXIMUM
                                $query->find()->update()->set(['current_health' => $fighterI['skill_health'] ])->where(['id' => $fighterI['id']])->execute();
                            }

                        }
                            return "You kill the enemy";

                        }else{
                            //RECOVER THE ACTUAL INFORMATION  OF THE FIGHTER
                        $fighterInfo = $query->find()->where(['id' => $idFighter]);                

                                //CHECK THE LEVEL OF THE FIGHTER
                                foreach($fighterInfo as $fighterI){

                                    $levelFighter = $fighterI['level'];
                                    $xpFighter = $fighterI['xp'];

                                    //DISPLAY A FLOAT 
                                    $actualLevel =  floor($xpFighter/4);

                                    //CHECK IF THE VALUE OF THE LEVEL IS EQUAL TO THE VALUE CALCULATE
                                    // IF NOT THE CASE THE FIGHTER WIN A LEVEL
                                    if($levelFighter != $actualLevel){//AMELIORATION IS THE LEVEL INCREASE
                                        //$query->find()->update()->set(['level' => $actualLevel])->where(['id' => $fighterI['id']])->execute();
                                        $query->find()->update()->set(['skill_sight' => $fighterI['skill_sight']+1])->where(['id' => $fighterI['id']])->execute();
                                        $query->find()->update()->set(['skill_strength' => $fighterI['skill_strength']+1])->where(['id' => $fighterI['id']])->execute();
                                        $query->find()->update()->set(['skill_health' => $fighterI['skill_health']+3])->where(['id' => $fighterI['id']])->execute();
                                        //INCREASE THE LIFE OF THE FIGHTER TO THE MAXIMUM
                                        $query->find()->update()->set(['current_health' => $fighterI['skill_health']+3 ])->where(['id' => $fighterI['id']])->execute();
                                    }

                                }
                            return "Successful attack";
                        }

                    }else{
                        //THE FIGHTER MESS THE ATTACK
                        return "You missed the attack";
                    }
                    
                }
                                              
                
                                
        }
       
    }
            

                      
                      
    // WHEN THE PLAYER WANT TO MOVE THE FIGHTERS
    public function fighterMove($idPlayer, $idFighter, $direction){
        $query = TableRegistry::get('fighters');
        $query2 = TableRegistry::get('tools');
        
        //INFO ABOUT THE FIGHTER 
        $fighterPos = $query->find()->select(['id','coordinate_x' ,'coordinate_y'])->where(['id =' => $idFighter ]);
        
        //LIST OF ALL FIGHTER
        $fighterList = $query->find()->select(['id', 'player_id', 'coordinate_x', 'coordinate_y']);
        
        //LIST OF TOOLS WITH ID FIGHTER NULL
        $toolList = $query2->find()->where(['fighter_id IS' => null] );
            
        foreach($fighterList as $fighterL){
            
            foreach ($fighterPos as $fighterP){
                
                foreach ($toolList as $tool){
                
                    if($direction == "up" ){

                        if($fighterP['coordinate_y']-1 == $fighterL['coordinate_y'] && $fighterP['coordinate_x'] == $fighterL['coordinate_x']){
                            return "fighter";
                        }elseif($fighterP['coordinate_y']-1 == $tool['coordinate_y'] && $fighterP['coordinate_x'] == $tool['coordinate_x']){
                            return "tool";
                        }else{
                            //IN THE CASE OF THE FIGHTER GO OUT OF THE GRID
                            if($fighterP['coordinate_y']-1 < 0){
                                return "You have to stay in the battlefield!";
                            }else{
                                $newPos = $fighterP['coordinate_y']-1;
                            }
                        }
                    }elseif($direction == "right"){
                        if($fighterP['coordinate_x']+1 == $fighterL['coordinate_x'] && $fighterP['coordinate_y'] == $fighterL['coordinate_y']){
                            return "fighter";
                        }elseif ($fighterP['coordinate_x']+1 == $tool['coordinate_x'] && $fighterP['coordinate_y'] == $tool['coordinate_y']){
                            return "tool";
                        }else{
                            //THE FIGHTER GO OUT ON THE RIGHT OF THE GRID
                            if($fighterP['coordinate_x']+1 > 14){
                                return "You have to stay in the battlefield!";
                            }else{
                                $newPos = $fighterP['coordinate_x']+1;
                            }

                        }
                    }elseif($direction == "left"){
                        if($fighterP['coordinate_x']-1 == $fighterL['coordinate_x'] && $fighterP['coordinate_y'] == $fighterL['coordinate_y']){
                            return "fighter";
                        }elseif ($fighterP['coordinate_x']-1 == $tool['coordinate_x'] && $fighterP['coordinate_y'] == $tool['coordinate_y']){
                            return "tool";
                        }else{
                            //THE FIGHTER GO OUT OF THE GRID ON THE LEFT
                            if($fighterP['coordinate_x']-1<0){
                                return "You have to stay in the battlefield!";
                            }else{
                                $newPos = $fighterP['coordinate_x']-1;
                            }

                        }            
                    }elseif($direction == "down"){
                        if($fighterP['coordinate_y']+1 == $fighterL['coordinate_y'] && $fighterP['coordinate_x'] == $fighterL['coordinate_x']){
                            return "fighter";
                        }elseif ($fighterP['coordinate_y']+1 == $tool['coordinate_y'] && $fighterP['coordinate_x'] == $tool['coordinate_x']){
                            return "tool";
                        }else{
                            if($fighterP['coordinate_y']+1 > 9){
                                return "You have to stay in the battlefield!";
                            }else{
                                $newPos = $fighterP['coordinate_y']+1;
                            }

                        }
                    }

                }
            }
            
        }
        
        //NO ONE HAS BEEN FOUND SO FIGHTER CAN MOVE
    
        if($direction == "up" ){
            $query->find()->update()->set(['coordinate_y' => $newPos])->where(['id' => $idFighter])->execute();
            
        }elseif($direction == "right"){
            $query->find()->update()->set(['coordinate_x' => $newPos])->where(['id' => $idFighter])->execute();
            
        }elseif($direction == "left"){
            $query->find()->update()->set(['coordinate_x' => $newPos])->where(['id' => $idFighter])->execute();
            
        }elseif($direction == "down"){
            $query->find()->update()->set(['coordinate_y' => $newPos])->where(['id' => $idFighter])->execute();
        }
        
        return $fighterPos;
        
    }
        
          //RETURN THE NUMBER OF SKILL POINT
    public function getSkillPoints($idFighter, $idPlayer){
        $query = TableRegistry::get('fighters');
        $infoFighter = $query->find()->select(['xp','level'])->where(['id' => $idFighter]);
        foreach ($infoFighter as $data){
            $skillPoint = floor(($data['xp']/4) - $data['level']);
        }
        return $skillPoint;
    }

    public function ameliorationSkill($idPlayer, $idFighter, $skill){
        $query = TableRegistry::get('fighters');
        
        $fighterInfo = $query->find()->select(['xp','level','skill_sight', 'skill_strength', 'skill_health'])->where(['id =' => $idFighter ]);
        
        foreach($fighterInfo as $fighterI){
            $nbPoint = $fighterI['xp']/4 - $fighterI['level'];
            if($nbPoint >=1){
                if($skill == "strength"){
                    $query->find()->update()->set(['level' => $fighterI['level']+1, 'skill_strength' => $fighterI['skill_strength']+1])->where(['id' => $idFighter])->execute();
                    return "You increase the strength of your fighter!";
                }elseif($skill == "health"){
                    $query->find()->update()->set(['level' => $fighterI['level']+1, 'skill_health' => $fighterI['skill_health']+3])->where(['id' => $idFighter])->execute();
                    return "You increase the health of your fighter!";          
                }elseif($skill == "sight"){
                    $query->find()->update()->set(['level' => $fighterI['level']+1, 'skill_sight' => $fighterI['skill_sight']+1])->where(['id' => $idFighter])->execute();
                    return "You increase the sight of your fighter!";
                    
                }
            }else{
                return "vous n'avez pas assez de point!";
            }
            
        }
    }
    
    public function createFighter($name,$player_id) {
        $query=TableRegistry::get('fighters');
        
        $aleaCoordinateX = rand(0,14);
        $aleaCoordinateY = rand(0,9);
        $freeCoordinate=false;
        while ($freeCoordinate=false) {
            $freeCoordinate=true;
            foreach ($posPlayer as $posP) {
                if ($aleaCoordinateX==$posP['coordinate_x']&& $aleaCoordinateY==$posP['coordinate_y']) {
                    $freeCoordinate=false;
                }
            }
            foreach ($posTools as $posT) {
                if ($aleaCoordinateX==$posT['coordinate_x']&& $aleaCoordinateY==$posT['coordinate_y']) {
                    $freeCoordinate=false;
                }      
            }
        }
            
        $query->query()->insert(['name','player_id','coordinate_x','coordinate_y','level','xp','skill_sight',
            'skill_strength','skill_health','current_health'])->
                values(['name' => $name,
            'player_id' => $player_id,
            'coordinate_x' => $aleaCoordinateX,
            'coordinate_y' => $aleaCoordinateY,
            'level' => 0,
            'xp' => 0,
            'skill_sight' => 2,
            'skill_strength' => 1,
            'skill_health' => 5,
            'current_health' => 5])->execute();
        
    }
    
    //Récupérer les fighters d'un player
    
    public function getFightersOfPlayer($id_player) {
        $query=TableRegistry::get('fighters');
        $fighterInfo = $query->find()->select(['id', 'name','level','skill_sight','skill_strength','skill_health','current_health'])->where(['player_id'=>$id_player]);
        return $fighterInfo;
    }

    public function GetIDFromName($name)
    {
        $get_id = TableRegistry::get('fighters')->find()
        ->select(['id'])
        ->where(['name'=>$name]);
        foreach ($get_id as $n) {
            return $n['id'];
        }
    }
    
}
    


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


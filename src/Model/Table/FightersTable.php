<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class FightersTable extends Table
{
    public function test(){
        return 'ok';
    }
    
    public function getMainFighter($idFighter, $idPlayer){
        $query = TableRegistry::get('fighters')->find()->where(['id' => $idFighter, 'player_id' => $idPlayer]);
        return $query;
    }
              
    public function getEnemyFighter($idFighter, $idPlayer){
        $query = TableRegistry::get('fighters')->find()->where(['id !=' => $idFighter, 'player_id !=' => $idPlayer]);
        return $query;
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

                            echo "le joueur est mort ";
                            //DELETE THE FIGHTER FROM THE DATABASE


                            //INCREASE THE XP OF THE FIGHTER THAT KILL THE OTHER FIGHTER
                            $query->find()->update()->set(['xp' => $fighterI['xp']+$fighterA['level']])->where(['id' => $fighterI['id']])->execute();

                            //INCREASE THE LIFE OF THE FIGHTER TO THE MAXIMUM
                            $query->find()->update()->set(['current_health' => $fighterI['skill_health'] ])->where(['id' => $fighterI['id']])->execute();

                        }else{
                            echo "the fighter is steel alive";
                        }

                    }else{
                        //THE FIGHTER MESS THE ATTACK
                        echo "The fighter mees the attack";
                        return false;
                    }
                    
                }
                                              
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
                    if($levelFighter != $actualLevel){
                        $query->find()->update()->set(['level' => $actualLevel])->where(['id' => $fighterI['id']])->execute();
                    }
                    
                }
                                       
            
            
        }
       
       //POSITION OF MY FIGHTER
       /*
        foreach($fighterInfo as $fighterI){
            
            if ($direction == 'up' ){
                
                //$fighterAttack = $query->where(['coordinate_x' => $fighterI['coordinate_x'] , 'coordinate_y' => $fighterI['coordinate_y']-1] );
//echo $fighterAttack;
                foreach($fighterAttack as $fighterA){
                    echo $fighterA['id'];
                    
                }*/
    }
        
        //faire en fonction de la direction l'attack pour recuperer la position du fighter enemi
       // faire reduire la vie de de l'enemi
        //faire le cas d'un attack reussi 
        //verification que le joureur est toujour en vie. sinon deleter le joureur de la BDD
        
        //quand on est dans l'autre joueur, faire une verification que le joueur enemie est toujours en vie.
                   
        
    public function fighterMove($idPlayer, $idFighter, $direction){
        $query = TableRegistry::get('fighters');
        $query2 = TableRegistry::get('tools');
        
        //INFO ABOUT THE FIGHTER 
        $fighterPos = $query->find()->select(['id','coordinate_x' ,'coordinate_y'])->where(['id =' => $idFighter ]);
        
        //LIST OF ALL FIGHTER
        $fighterList = $query->find()->select(['id', 'player_id', 'coordinate_x', 'coordinate_y']);
        
        //LIST OF TOOLS
        $toolList = $query2->find();
          
        foreach($fighterList as $fighterL){
            
            foreach ($fighterPos as $fighterP){
                
                foreach ($toolList as $tool){
                
                    if($direction == "up" ){

                        if($fighterP['coordinate_y']-1 == $fighterL['coordinate_y'] && $fighterP['coordinate_x'] == $fighterL['coordinate_x']){
                            return "fighter";
                        }elseif($fighterP['coordinate_y']-1 == $tool['coordinate_y'] && $fighterP['coordinate_x'] == $tool['coordinate_x']){
                            echo "tools";
                            return "tool";
                        }else{
                            //IN THE CASE OF THE FIGHTER GO OUT OF THE GRID
                            if($fighterP['coordinate_y']-1 < 0){
                                return false;
                            }else{
                                $newPos = $fighterP['coordinate_y']-1;
                            }
                        }

                    }elseif($direction == "right"){
                        if($fighterP['coordinate_x']+1 == $fighterL['coordinate_x'] && $fighterP['coordinate_y'] == $fighterL['coordinate_y']){
                            return "fighter";
                        }elseif ($fighterP['coordinate_x']+1 == $tool['coordinate_x'] && $fighterP['coordinate_y'] == $tool['coordinate_y']){
                            echo "tools";
                            return "tool";
                        }else{
                            //THE FIGHTER GO OUT ON THE RIGHT OF THE GRID
                            if($fighterP['coordinate_x']+1 > 14){
                                return false;
                            }else{
                                $newPos = $fighterP['coordinate_x']+1;
                            }

                        }
                    }elseif($direction == "left"){
                        if($fighterP['coordinate_x']-1 == $fighterL['coordinate_x'] && $fighterP['coordinate_y'] == $fighterL['coordinate_y']){
                            return "fighter";
                        }elseif ($fighterP['coordinate_x']-1 == $tool['coordinate_x'] && $fighterP['coordinate_y'] == $tool['coordinate_y']){
                            echo "tools";
                            return "tool";
                        }else{
                            //THE FIGHTER GO OUT OF THE GRID ON THE LEFT
                            if($fighterP['coordinate_x']-1<0){
                                return false;
                            }else{
                                $newPos = $fighterP['coordinate_x']-1;
                            }

                        }            
                    }elseif($direction == "down"){
                        if($fighterP['coordinate_y']+1 == $fighterL['coordinate_y'] && $fighterP['coordinate_x'] == $fighterL['coordinate_x']){
                            return "fighter";
                        }elseif ($fighterP['coordinate_y']+1 == $tool['coordinate_y'] && $fighterP['coordinate_x'] == $tool['coordinate_x']){
                            echo "tools";
                            return "tool";
                        }else{
                            if($fighterP['coordinate_y']+1 > 14){
                                return false;
                            }else{
                                $newPos = $fighterP['coordinate_y']+1;
                            }

                        }
                    }

                }
            }
            
        }
        
        //NO ONE HAS BEEN FOUND
        echo $newPos;

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

        public function UseXP($Pid, $Fid, $action)
    {

        /* Fonction qui gère l'utilisation de l'xp, un unique appel de cette fonction suffit pour tt les opération/tests 
        Paramètres :
        $Pid => l'id du player, normalement récupéré depuis la session
        $Fid => l'id du Figher actuel , provient également de la session normalement
        $action => le choix de l'utilisateur : prend les valeur "force" si on choisit de booster la force, "vue" si on choisit de booster la vue, et "PV" pour les points de vie.
        */

        $XP = 0; // local var pour xp
        $LVL = 0; // local var pour lvl
        $Fighter = ''; // local var pour l'id du figter /// AVEC UN F MAJUSCULE !!!
        $calcul = 0 ; // calcul = xp/4 - lvl, cela correspond au point de caractéristiques disponible a amélioré : 1PC = 1force ou 1vue ou 3PV
        $strengh = 0; // force actuelle
        $sight = 0; // vue actuelle
        $health = 0; // health actuelle

        // récupération de l'xp et du level
        $get_xp = TableRegistry::get('fighters')->find()
        ->select(['xp'])
        ->where(['id =' => $Fid]);

        $get_lvl = TableRegistry::get('fighters')->find()
        ->select(['level'])
        ->where(['id =' => $Fid]);

         foreach($get_xp as $gxp){
            $XP = $gxp['xp']; 
        }

        foreach($get_lvl as $glvl){
            $LVL = $glvl['level'];            
        }

        $calcul = ($XP/4) - $LVL; // calcul de nb de point de caractéristique restant (on gagne 1PC tout les 4 XPs)

        //pr($LVL);
        //pr($XP);

        //echo "vous avez ";
        //echo $calcul;
        //echo " point de caractéristique à dépenser <br/>" ;

        if($calcul >= 1){ // si on a des points disponibles

            echo "On est rentré dans la boucle <br/>";

            $incr_lvl = TableRegistry::get('fighters')->query() // augmente le lvl de 1 
                ->update()
                ->set(['level' => $LVL + 1])
                ->where(['id' => $Fid])
                ->execute();

            if($action =='force'){
                //si on a choisit d'augmenter la force

                $get_strengh = TableRegistry::get('fighters')->find() // selection la force actuel pour l'incrémentation
                ->select(['skill_strengh'])
                ->where(['id =' => $Fid]);

                 foreach($get_strengh as $temp){
                    $strengh = $temp['skill_strengh']; 
                }

                $add_force = TableRegistry::get('fighters')->query() // incrémente la valeur force de 1
                    ->update()
                    ->set(['skill_strengh' => $strengh + 1])
                    ->where(['id' => $Fid])
                    ->execute();
            }



            if($action =='vue'){
                //si on a choisit d'augmenter la vue

                $get_sight = TableRegistry::get('fighters')->find() // pareil que dessus
                ->select(['skill_sight'])
                ->where(['id =' => $Fid]);

                 foreach($get_sight as $temp){
                    $sight = $temp['skill_sight']; 
                }

                $add_vue = TableRegistry::get('fighters')->query()
                    ->update()
                    ->set(['skill_sight' => $sight + 1])
                    ->where(['id' => $Fid])
                    ->execute();
            }



            if($action =='PV'){
                // si on a choisit d'augmenter les PV

                $get_PV = TableRegistry::get('fighters')->find()
                ->select(['skill_health'])
                ->where(['id =' => $Fid]);

                 foreach($get_PV as $temp){
                    $PV = $temp['skill_strengh']; 
                }

                $add_PV = TableRegistry::get('fighters')->query()
                    ->update()
                    ->set(['skill_health' => $PV + 3])
                    ->where(['id' => $Fid])
                    ->execute();
            }

            //echo "<br/> Il vous reste désormais : <br/>";
            //$calcul = $calcul = ($XP/4) - ($LVL+1);
            //echo $calcul;

        }

        //echo " <br> on a finit les traitements";


    }
    
}
    


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


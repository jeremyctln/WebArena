<?php
namespace App\Controller;
use App\Controller\AppController;
/**
* Personal Controller
* User personal interface
*
*/
class ArenasController  extends AppController
{
public function index()
{
    //$this->set('myname',"julien");
    
    //permet de creer un lien vers le model ou un fichier s'appel Fighters
    $this->loadModel('Fighters');
    //$figterlist=$this->Fighters->find('all');
    //pr($figterlist->toArray());
    //$valuetest = $this->Fighters->test();
    //$this->set('value', $valuetest);
    
    //test d'un redirection
    //if ($valuetest == 3){
    //    return $this->redirect(['controller' => 'Arenas', 'action' => 'login']);
    //}
    
    //permet d'interoger dans le model la fonction test();
    //$value = $this->Fighters->test();
    //$this->set('value', $value);
    
    //permet de recuperer l'array du meilleur fighter
    $value2 = $this->Fighters->getBestFighter();
    $this->set('value2',$value2);
    
   //$valueget = $this->Fighters->getBestFighter();
   // pr($valueget->toArray());
    //$this->set('valueofget',$valueget);
    
    
}
public function login(){
    
    
    
}

public function verif(){
    
    $password=$_POST['NamePass'];
    echo $password;
    $this->loadModel('Players');
    $pass = $this->Players->getPlayer($password);
    
    if($pass==true){
        $retour = "vous avez rentré le bon mot de passe!";
    }else{
        $retour = "Vous avez rentré le mauvais mot de passe!";
       }
    $this->set('notation',$retour);
    
}
public function fighter(){
    
    
    
    
}

public function sight(){
    
    $this->loadModel('Fighters');
    $this->loadModel('Grids');
    
    
    
    $idPlayer = '545f827c-576c-4dc5-ab6d-27c33186dc3e';
    $idFighter = '1';
    
    
    //DISPLAY THE GRID IN THEVIEW
    $this->set('idsession', $idPlayer);
        
    //marche
    //demander aussi pour le tableau avec les zone sombre...
     if($this->request->is('post')){
        //if ($this->request->getData("haut")!=NULL){
            pr($this->request->getData());
            $game = $this->request->getData();
            
            if($game)
                //WHEN THE PLAYER WANT TO MOVE
                if ($game["toucheMove"]== "up"){
                    echo"touche haut";
                    
                    $direction = 'up';
                    $moveUp = $this->Fighters->fighterMove($idPlayer, $idFighter, $direction);
                    
                    //IN THE CASE WE THE VALUE RETURN IS A fighter THAT MEAN
                    // THERE IS A FIGHTER IN THE CASE
                    // ATTACK THE FIGHTER
                    $attackUp = $this->Fighters->fighterAttack($idPlayer, $idFighter, $direction);
                    echo $moveUp;
                    
                    //regader si position de 
                }elseif ($game["toucheMove"]== "right"){
                    echo"touche right";
                    $direction = 'right';
                    $moveUp = $this->Fighters->fighterMove($idPlayer, $idFighter, $direction);
                    //regader si position de 
                }elseif ($game["toucheMove"]== "left"){
                    echo"touche left";
                    $direction = 'left';
                    $moveUp = $this->Fighters->fighterMove($idPlayer, $idFighter, $direction);
                    //regader si position de 
                }elseif ($game["toucheMove"]== "down"){
                    echo"touche down";
                    $direction = 'down';
                    $moveUp = $this->Fighters->fighterMove($idPlayer, $idFighter, $direction);
                    //regader si position de 
                }
            
            
            //ADD THE CASE WHERE THE FIGHTER ATTAQUE AN OTHER FIGHTER
            // SI ATTAQUE VERS LE HAUT /
            //CALL THE METHODE ATTAQUE IN THE MODEL; 
            //
    }
    
    //$this->loadModel('Players');
    
    
    
    
    /*foreach($posPlayer as $pos){
        $arraygrid = array();
         if($player["coordinate_x"]==$j && $player["coordinate_y"]==$i){
             
         }
    }
    
     if ($player["coordinate_x"]==$j && $player["coordinate_y"]==$i){
                    echo $this->Html->image("perso".$player["id"].".png", ['width'=> '25', 'height'=>'26']);
                    $fighter = true;
                   }
                   
                }
                if($fighter==false){// in the case that no one fighter has been find
                       echo $this->Html->image("herbe.png", ['width'=> '26', 'height'=>'26']);
                }else{// previously a finghter has been find
                       $fighter = false;// a fighter has been find
                       // we have to re-initialised the variable $fighter
                }*/
    
    //echanger l'array de pos Player en une autre array ou l'on pourrait stocker tute les infos dans cette array 
    
    //THE ARRAY THAT WE SEND TO THE LOOP IN THE VIEW
    //MIMPLEMENTATION OF THE VIEW HERE
    $posPlayer = $this->Grids->getPosFighter();
    $this->set('posPlayer',$posPlayer);
    
    //SEND WIDTH AND THE HIGHT OF THE GRID
    $gridWidth = $this->Grids->getWidth();
    $gridHeight = $this->Grids->getHeight();
    $this->set('gridWidth', $gridWidth);
    $this->set('gridHeight', $gridHeight);
    
   
   
    
    //$perso = $this->Grid->getPosFighter();
    
        
        //on doit lui passer le fighter
   
    //$user = $this->player->get($user);
    
    
    
    /*
    $this->loadModel('Grids');
    $line = $this->Grids->getWidth();
    $column =$this->Grids->getHeight();
    
    for($i=0;$i<$line;$i++){
        for($j=0;$j<$column;$j++){
            $PosX = $this->Grids->getPosXFighter();
            $PosY = $this->Grids->getPosYFighter();
            if ($i==$PosY && $j==$PosX){
                return 
            }
        
        }
    }
     
     */
    
    //exemple d'affichage de la grille
    
    
}

public function diary(){
    
}


}
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
    
    $this->loadModel('Grids');
    $posPlayer = $this->Grids->getPosFighter();
    $this->set('posPlayer',$posPlayer);
    
    $gridWidth = $this->Grids->getWidth();
    $gridHeight = $this->Grids->getHeight();
    $this->set('gridWidth', $gridWidth);
    $this->set('gridHeight', $gridHeight);
    
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
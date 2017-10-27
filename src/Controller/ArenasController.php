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

        // 3 lignes suivantes à rajouté a chauqe page (sauf login) pour cérifier qu'on est bien loggé (commenté pr désactiver si besoin, ça ne change rien à la var session)
        $session = $this->request->session();
        if($session->read('player.Pid') == null){
            return $this->redirect(['controller' => 'Arenas', 'action' => 'login']);
        } // 3 lignes précédentes à rajouté a chauqe page (sauf login) pour cérifier qu'on est bien loggé


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

    public function verif(){
        // 3 lignes suivantes à rajouté a chauqe page (sauf login) pour cérifier qu'on est bien loggé (commenté pr désactiver si besoin, ça ne change rien à la var session)
        $session = $this->request->session();
        if($session->read('player.Pid') == null){
            return $this->redirect(['controller' => 'Arenas', 'action' => 'login']);
        } // 3 lignes précédentes à rajouté a chauqe page (sauf login) pour cérifier qu'on est bien loggé
        
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


    public function sight(){
        
        $this->loadModel('Fighters');
        $this->loadModel('Grids'); 
        $this->loadModel('Tools');
        $this->loadModel('Surroundings');
        
        $idPlayer = '545f827c-576c-4dc5-ab6d-27c33186dc3e';
        $idFighter = '1';
        
        //DISPLAY THE GRID IN THEVIEW
        $this->set('idsession', $idPlayer);
        
        ///////////////////////////////////////////
        
        //CREATION OF NEW 
        //$this->Tools->createTools();
        //$toolList = $this->Tools->getTools();
        
        
        ///////////////////////////////////////////
            
        //marche
        //demander aussi pour le tableau avec les zone sombre...
        if($this->request->is('post')){
            $game = $this->request->getData();
            $move="";
            //WHEN THE PLAYER WANT TO MOVE
            if ($game["touche"]== "up"){
                $direction = 'up';
                $move = $this->Fighters->fighterMove($idPlayer, $idFighter, $direction);
                
                //IN THE CASE WHERE THE VALUE RETURNED IS A fighter THAT MEAN
                // THERE IS A FIGHTER IN THE CASE
                // ATTACK THE FIGHTER
    
                if ($move == 'fighter'){
                    $attack = $this->Fighters->fighterAttack($idPlayer, $idFighter, $direction);
                    $this->set('state_information',$attack);
                }elseif ($move == "tool"){
                    //recuperer le tool à la coordonné donnée!
                    $tool = $this->Tools->retrieveTool($idFighter, $direction);
                    $this->set('state_information', $tool);
                }elseif($move == "You have to stay in the battlefield!"){
                    $this->set('state_information',$move);
                }else{
                    $this->set('state_information',"You move up!");
                }
    
                //regarder si position de 
            }elseif ($game["touche"]== "right"){
                $direction = 'right';
                $move = $this->Fighters->fighterMove($idPlayer, $idFighter, $direction);
    
                if ($move == 'fighter'){
                    $attack = $this->Fighters->fighterAttack($idPlayer, $idFighter, $direction);            
                    $this->set('state_information',$attack);                
                }elseif ($move == "tool"){
                    //recuperer le tool à la coordonnée donnée!
                    $tool = $this->Tools->retrieveTool($idFighter, $direction);
                    $this->set('state_information', $tool);
                }elseif($move == "You have to stay in the battlefield!"){
                    $this->set('state_information',$move);
                }else{
                    $this->set('state_information',"You move right!");
                }
    
            }elseif ($game["touche"]== "left"){
                $direction = 'left';
                $move = $this->Fighters->fighterMove($idPlayer, $idFighter, $direction);
    
                if ($move == 'fighter'){
                    $attack = $this->Fighters->fighterAttack($idPlayer, $idFighter, $direction);
                    $this->set('state_information',$attack);
                }elseif ($move == "tool"){
                    //récuperer le tool à la coordonnée donnée!
                    $tool = $this->Tools->retrieveTool($idFighter, $direction);
                    $this->set('state_information', $tool);
                }elseif($move == "You have to stay in the battlefield!"){
                    $this->set('state_information',$move);
                }else{
                    $this->set('state_information',"You move left!");
                }
                
            }elseif ($game["touche"]== "down"){
                $direction = 'down';
                $move = $this->Fighters->fighterMove($idPlayer, $idFighter, $direction);
    
                if ($move == 'fighter'){
                    $attack = $this->Fighters->fighterAttack($idPlayer, $idFighter, $direction);
                    $this->set('state_information',$attack);
                }elseif ($move == "tool"){
                    //récuperer le tool à la coordonnée donnée!
                    $tool = $this->Tools->retrieveTool($idFighter, $direction);
                    $this->set('state_information', $tool);
                }elseif($move == "You have to stay in the battlefield!"){
                    $this->set('state_information',$move);
                }else{
                    $this->set('state_information',"You move down!");
                }
                
            }elseif($game["touche"]=="strength"){
                $skill = "strength";
                $skillResult = $this->Fighters->ameliorationSkill($idPlayer, $idFighter, $skill);
                
            }elseif($game["touche"]=="health"){
                $skill = "health";
                $skillResult = $this->Fighters->ameliorationSkill($idPlayer, $idFighter, $skill);
            }elseif($game["touche"]=="sight"){
                $skill = "sight";
                $skillResult = $this->Fighters->ameliorationSkill($idPlayer, $idFighter, $skill);
            }
    
    
        }
        
        
        //THE ARRAY THAT WE SEND TO THE LOOP IN THE VIEW
        //MIMPLEMENTATION OF THE VIEW HERE
        //
        ///////////////////////////////////////////////////////////////////////
        //ALL INFORMATION THAT APPEAR IN THE VIEW
        ///////////////////////////////////////////////////////////////////////
        //THE FIGHTER'S XP
        $xpFighter = $this->Fighters->getXP($idFighter, $idPlayer);
        foreach($xpFighter as $xp){
            $xpFighter = $xp['xp'];
        }
        $this->set('xpFighter',$xpFighter);
        //THE FIGHTER'S LEVEL
        $levelFighter = floor($xpFighter/4);
        $this->set('levelFighter',$levelFighter);
        
        //FIGHTER' HEALTH/CURRENT HEALTH
        $healthFighter = $this->Fighters->getHealth($idFighter, $idPlayer);
        foreach($healthFighter as $health){
            $healthFighter = $health['skill_health'];
        }    
        $currentFighter = $this->Fighters->getCurrent($idFighter, $idPlayer);
        foreach($currentFighter as $current){
            $currentFighter = $current['current_health'];
        }
        $this->set('healthFighter', $healthFighter);
        $this->set('currentHealth',$currentFighter);
        
        //FIGHTER'S STRENGTH
        $strengthFighter = $this->Fighters->getStrength($idFighter, $idPlayer);
        foreach($strengthFighter as $strength){
            $strengthFighter = $strength['skill_strength'];
        }
        $this->set('strengthFighter', $strengthFighter);
        
        //FIGHTER'S SIGHT
        $sightFighter = $this->Fighters->getSight($idFighter, $idPlayer);
        foreach($sightFighter as $sight){
            $sightFighter = $sight['skill_sight'];
        }
        $this->set('sightFighter', $sightFighter);
        
        //SEND WIDTH AND THE HIGHT OF THE GRID
        $gridWidth = $this->Grids->getWidth();
        $gridHeight = $this->Grids->getHeight();
        $this->set('gridWidth', $gridWidth);
        $this->set('gridHeight', $gridHeight);
        
        //TO DISPLAY THE TOOL LIST OF THE FIHGTER
        $toolList = $this->Tools->getToolsFighter($idFighter, $idPlayer);
        $this->set('toolList', $toolList);
        
        //TO DISPLAY THE NUMBER OF SKILL POINT
        $skillPoint = $this->Fighters->getSkillPoints($idFighter, $idPlayer);
        $this->set('skillPoint', $skillPoint);
        
        
        /////////////////////////////////////////////////////////////////////////
        //INFORMATION TO DISPLAY THE GRID
        /////////////////////////////////////////////////////////////////////////
        $posMainFighter = $this->Fighters->getMainFighter($idFighter, $idPlayer);
        $posEnemyFighter = $this->Fighters->getEnemyFighter($idFighter, $idPlayer);
        $posTools = $this->Tools->getTools();
        $this->Surroundings->setSurroundings($posMainFighter, $posEnemyFighter, $posTools);
        $gridDisplay = $this->Surroundings->getSurroundings();
        $this->set('gridDisplay', $gridDisplay);
        //envoie des infos ici à la vue
      
        
        
    }
    



    public function login(){

        $session = $this->request->session();
        $session->destroy();// on réinitialise la session en entrant sur la page login, pour se reconnecter à nouveau


        $Flog = ''; // F si la donné provient d'une Form, DB si la donné provient d'une query
        $Fpass = '';
        if(isset($_POST['username'])){
            $Flog = $_POST['username']; // recupere les valeurs depuis le formulaire dans register.ctp
        }
        
        if(isset($_POST['password'])){
            $Fpass = $_POST['password'];
        }

            if (($Flog != '') && ($Fpass != '')) // si les 2 champs sont non vide 
        {
            $this->loadModel('Players');
            if($this->Players->checkCredentials($Flog, $Fpass)){
                //echo "Bon mot de passe";
                //echo "<br/> l'id de la session est :";
                $session->write('player.Pid',$this->Players->getIDfromLog($Flog));
                //echo $session->read('player.Pid');
                return $this->redirect(['controller' => 'Arenas', 'action' => 'index']);


            }
            else
                echo "Mauvais mdp/login";
        }

        


        
    }

    public function register(){

        // 3 lignes suivantes à rajouté a chauqe page (sauf login) pour cérifier qu'on est bien loggé (commenté pr désactiver si besoin, ça ne change rien à la var session)
        $session = $this->request->session();
        if($session->read('player.Pid') == null){
            return $this->redirect(['controller' => 'Arenas', 'action' => 'login']);
        } // 3 lignes précédentes à rajouté a chauqe page (sauf login) pour cérifier qu'on est bien loggé





        //echo "<br/> l'id de la session est :";
        echo $session->read('player.Pid');
        $RandID = substr(md5(rand()), 0, 36); // génère une id random
        $Flog = ''; // F si la donné provient d'une Form, DB si la donné provient d'une query
        $Fpass = '';

        //echo $this->request->getdata('username');


        if(isset($_POST['username'])){
            //echo "post username is set";
            $Flog = $_POST['username']; // recupere les valeurs depuis le formulaire dans register.ctp
        }
        
        if(isset($_POST['password'])){
            //echo "post password is set";
            $Fpass = $_POST['password'];
        }

        
        
        //echo $RandID;
        //echo $Flog;
        //echo $Fpass;


        if (($Flog != '') && ($Fpass != '')) // si les 2 champs sont non vide 
        {
            $this->loadModel('Players');
            if(!$this->Players->checkExists($Flog, $Fpass)) // regarde si l'un des champs existe déja
                $this->Players->insertPlayer($RandID, $Flog, $Fpass); // insere le nouveau péon : voir PlayersTable.php
        }



    }


public function diary(){
    // 3 lignes suivantes à rajouté a chaque page (sauf login) pour cérifier qu'on est bien loggé (commenté pr désactiver si besoin, ça ne change rien à la var session)
    $session = $this->request->session();
    if($session->read('player.Pid') == null){
        return $this->redirect(['controller' => 'Arenas', 'action' => 'login']);
    } // 3 lignes précédentes à rajouté a chaque page (sauf login) pour cérifier qu'on est bien loggé
    
    $this->loadModel('Events');
    //$a=$this->events->cancelEvents();
    $event=$this->Events->takeEvents();
    $this->set('event',$event);
    //foreach($event as $ev){
    //    echo $ev;
    //
      
}

public function fighter(){

    // 3 lignes suivantes à rajouté a chauqe page (sauf login) pour cérifier qu'on est bien loggé (commenté pr désactiver si besoin, ça ne change rien à la var session)
    $session = $this->request->session();
    if($session->read('player.Pid') == null){
        return $this->redirect(['controller' => 'Arenas', 'action' => 'login']);
    } // 3 lignes précédentes à rajouté a chauqe page (sauf login) pour cérifier qu'on est bien loggé
  
    $this->loadModel('Fighters');
    $id_player=$session->read('player.Pid');
    $name=$this->Fighters->getFightersOfPlayer($id_player);
    
    //part where we choose to create a new fighter
    if($this->request->is('post')){
            $game = $this->request->getData();
            
            if ($game["validationButton"]=="validName") {
                echo 'valide';
                $game = $this->request->getData("nameField");
                pr( $game);
                
                
            $this->Fighters->createFighter($game,$id_player);
            $this->redirect(array('controller' => 'Arenas', 'action' => 'sight'));
            }elseif($game['validationButton']!=""){
            
                $this->redirect(array('controller' => 'Arenas', 'action' => 'sight'));
            }
    }
    
    //part where we choose to play with an existant fighter (if they already have been created)

            
    $fighter=$this->Fighters->getFightersOfPlayer($id_player);
    $this->set('listCharac',$fighter);
    
    
    
}


}
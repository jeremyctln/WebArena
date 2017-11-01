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

        
        //permet de creer un lien vers le model ou un fichier s'appel Fighters
        $this->loadModel('Fighters');

        $value2 = $this->Fighters->getBestFighter();
        $this->set('value2',$value2);
       
        
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
        $this->loadModel('Events');
        
        //TO INIT THE VARAIBLE state_information
        $this->set('state_information',"");
        
        
        $session = $this->request->session();
    if($session->read('player.Pid') == null){
        return $this->redirect(['controller' => 'Arenas', 'action' => 'login']);
    } // 3 lignes précédentes à rajouté a chaque page (sauf login) pour cérifier qu'on est bien loggé*/
    
        
        $idFighter = $session->read('player.Fid'); // L'ID COMBATTANT
        $idPlayer = $session->read('player.Pid'); // L'ID JOUEUR
        
        //DISPLAY THE GRID IN THEVIEW
        $this->set('idsession', $idPlayer);
        
        
            
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
                $this->set('state_information',$skillResult);
                
            }elseif($game["touche"]=="health"){
                $skill = "health";
                $skillResult = $this->Fighters->ameliorationSkill($idPlayer, $idFighter, $skill);
                $this->set('state_information',$skillResult);
            }elseif($game["touche"]=="sight"){
                $skill = "sight";
                $skillResult = $this->Fighters->ameliorationSkill($idPlayer, $idFighter, $skill);
                $this->set('state_information',$skillResult);
            }elseif($game["touche"] == 'tool'){
                $this->Tools->createTools();
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

        $this->loadModel('Players');
        $Flog = ''; // F si la donné provient d'une Form, DB si la donné provient d'une query
        $Fpass = '';

        $Flog = $this->request->getData('username');
        $Fpass = $this->request->getData('password');
        $this->set('message',"");


        if($this->request->is('post'))
        {

            $data = $this->request->getData();
            if($data['login'] == 'oubli'){

                if($Flog != ''){
                    $temp = $this->Players->ResetlostPWD($Flog);
                    if( $temp == ""){
                        $this->set('message', "Nous n'avons pas pu identifier votre Email, veuillez rentrer un email valide svp");
                    }
                    else{
                        $this->set('message', "Un nouveau Mdp pour le compte ". $Flog ." a été généré. Le nouveau Mdp est : " .$temp);
                    }
                }
                
                else{
                    $this->set('message', "Veuillez remplir l'email du compte dont vous avez perdu le mot de passe svp");
                }
            }

            if($data['login'] == 'register'){
                return $this->redirect(['controller' => 'Arenas', 'action' => 'register']);
            }

            if($data['login'] == 'connection')
            {
                if (($Flog != '') && ($Fpass != '')) // si les 2 champs sont non vide 
                {
                    if($this->Players->checkCredentials($Flog, $Fpass)){
                        $session->write('player.Pid',$this->Players->getIDfromLog($Flog));
                        echo $session->read('player.Pid');
                        return $this->redirect(['controller' => 'Arenas', 'action' => 'fighter']);
                    }
                    else
                        $this->set('message', "Mauvais login/Mdp");
                }
                else
                 $this->set('message',"Veuillez remplir les deux champs svp");
            }
        }
     


        
    }

    public function register(){

        // PAS BESOIN D'ETRE CONNECTE POUR ACCEDER A CETTE PAGE !!!
     
        $session = $this->request->session();

        $RandID = substr(md5(rand()), 0, 36); // génère une id random
        $Flog = '1'; // F si la donné provient d'une Form, DB si la donné provient d'une query
        $Fpass = '2';

        $Flog = $this->request->getData('username');
        $Fpass = $this->request->getData('password');
        $this->set('message',"");


        $data = $this->request->getData();
        if($this->request->is('post'))
        {
           if($data['action'] == 'ajout'){

               if (($Flog != '') && ($Fpass != '')) // si les 2 champs sont non vide 
               { 
                   $this->loadModel('Players');
                   if(!$this->Players->checkExists($Flog, $Fpass)){// regarde si l'un des champs existe déja
                       $this->Players->insertPlayer($RandID, $Flog, $Fpass); // insere le nouveau péon : voir PlayersTable.php
                       $this->set('message',"Le compte a été ajouté avec succès !");
                   } 
                   else{
                       $this->set('message', "Ce compte existe déjà");
                   }
              
               }
               else
                $this->set('message',"Veuillez remplir les deux champs svp");
           
           }
           if($data['action'] == 'retour'){
           return $this->redirect(['controller' => 'Arenas', 'action' => 'login']);
           } 
        }

    }

    public function guild(){
        // 3 lignes suivantes à rajouté a chauqe page (sauf login) pour cértifier qu'on est bien loggé
        $session = $this->request->session();
        if($session->read('player.Pid') == null){
            return $this->redirect(['controller' => 'Arenas', 'action' => 'login']);
        } // 3 lignes précédentes à rajouté a chauqe page (sauf login) pour cértifier qu'on est bien loggé

        $Fid = 2;
        $error = '';

        $Fid = $session->read('player.Fid');


        $this->loadModel('Guild');

        //INITIALISE GUILD INFO
        $addGuild="";
        $this->set("addGuildInfo", $addGuild);
        
        //$this->Guild->AddMessage(1,"msg ajouté depuis un formulaire quelquonque",1);

        $guild_id = $this->Guild->GetGuildID($Fid);


        $content = $this->request->getData('Content');
        $joindre = $this->request->getData('joindre');
        $newname = $this->request->getData('Nouveau');


        $data = $this->request->getData();
        if($this->request->is('post'))
        {
            if($data['guild'] == 'Envoyer')
            {
                $this->Guild->AddMessage($Fid,$content,$guild_id);
            }
        
            if($data['guild'] == 'Rejoindre')
            {
                
                $error = $this->Guild->JoinGuild($joindre, $Fid);
                if($error == ''){
                    $special = -1;
                    $this->Guild->AddMessage($Fid,$joindre,$special);
                    return $this->redirect(['controller' => 'Arenas', 'action' => 'guild']);
                }

            }

             if($data['guild'] == 'Creer')
             {
                 //Verifier qu'il n'exist pas d'autre guild avec le meme nom
                 $addGuild = $this->Guild->CreateGuild($newname);
                 $this->set("addGuildInfo", $addGuild);
             }
        }

        $this->set('error',$error);
        $this->set('GuildName', $this->Guild->GetGuildName($guild_id));
        $this->set('MsgContent', $this->Guild->GetGuildMSG($guild_id));
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
    
    //CHARGEMENT DES MODELS
    $this->loadModel('Fighters');
    $this->loadModel('Events');
    
    // 3 lignes suivantes à rajouté a chauqe page (sauf login) pour cérifier qu'on est bien loggé (commenté pr désactiver si besoin, ça ne change rien à la var session)
    $session = $this->request->session();
    if($session->read('player.Pid') == null){
        return $this->redirect(['controller' => 'Arenas', 'action' => 'login']);
    } // 3 lignes précédentes à rajouté a chauqe page (sauf login) pour cérifier qu'on est bien loggé

    //DEFINED THE ID OF THE PLAYER
    $id_player=$session->read('player.Pid');
    //$name=$this->Fighters->getFightersOfPlayer($id_player);
    
    //List des fighter
    $fighter=$this->Fighters->getFightersOfPlayer($id_player);
    $this->set('listCharac',$fighter);
    
    //INTIALISATION OF THE $infoCreation in the template
    $infoCreation = "";
    $this->set("infoCreation", $infoCreation);
    //part where we choose to create a new fighter
    if($this->request->is('post')){
            $game = $this->request->getData();
            
            if ($game["ValidationButton"]=="validName") {

                $game = $this->request->getData("nameField");
            
            $infoCreation = $this->Fighters->createFighter($game,$id_player);
            
            $this->set("infoCreation", $infoCreation);
            
            
            //$this->redirect(array('controller' => 'Arenas', 'action' => 'sight'));
            }elseif($game["ValidationButton"] == "choisir"){
                
                $choix = $this->request->getData('field');
                $FighterName=$choix;
                //CHECK IF THE FIGHTER EXIST
                $find = false;
                foreach($fighter as $fight){
                    if($fight['name'] == $FighterName){
                        $find = true;
                    }
                }
                if($find == false){
                    $this->set('infoCreation',"None Fighters have this name");
                }else{
                
                //THE FIGHTER NAME EXIST
                $session->write('player.Fid',$this->Fighters->getIDfromName($choix));
                
                
                //DEF POSITION X AND Y
                foreach($fighter as $fighterI){
                    if( $fighterI['name'] == $FighterName){
                        $posX = $fighterI['coordinate_x'];
                        $posY = $fighterI['coordinate_y'];
                    }
                }
                
                //DEF $evenName
                $eventName = "started to fight!";
                
                $this->Events->setEvent($FighterName, $posX, $posY, $eventName);
                return $this->redirect(array('controller' => 'Arenas', 'action' => 'sight'));
                }
                
            }
    
    //part where we choose to play with an existant fighter (if they already have been created)

            
    
    
    }
    
}

public function home(){
    
}


}
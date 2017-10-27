

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Home</title>
    </head>

    <body>
  
    <?= $this->Html->css('header')?>
    <?= $this->Html->css('foundation')?>
    <?= $this->Html->css('foundation.min')?>
    <?= $this->Html->script('js/foundation.min')?>
    <?= $this->Html->script('js/foundation')?>
    <?= $this->Html->script('js/jquery')?>
    <?= $this->Html->script('js/what-input')?>
    <?= $this->Html->script('js/header')?>
    <div class="title">
    <h1>Web Arena <small>Let's play</small></h1>
    </div>
    <nav class="hover-underline-menu" data-menu-underline-from-center>
  <ul class="menu align-center">
    <li><a href="login">Login</a></li>
    <li><a href="register">Register</a></li>
    <li><a href="fighter">Fighter</a></li>
    <li><a href="sight">Sight</a></li>
    <li><a href="diary">Diary</a></li>
  </ul>
</nav>


  
    <div class="scroll"><strong>Game rules</strong></br></br></br>
• A fighter is in a board arena at a position X, Y. This position can not be outside the
dimensions of the arena. Only one fighter per square. One arena per website.</br></br>
• A fighter starts with the following characteristics: view = 2, force = 1, health point = 5 (these
values must be parametrized). It appears at a random free position.</br></br>
• Constants values: arena width (x) (15), arena length (y) (10) (these values must be set in the
model).</br></br>
• The view characteristic determines how far (Manhattan distance = x + y) a fighter can see.
Thus only the fighter and the elements of the scenery in range are displayed on the page
concerned. 0 is the current square.</br></br>
• The force characteristic determines how much life loses its opponent when the fighter
succeeds in its attack action.</br></br>
• When the fighter sees his hit points reach 0, it is removed from the game. A player whose
fighter has been removed from the game is invited to recreate a new one.</br></br>
• An attack action succeeds if a random value between 1 and 20 (20 sided dices) is greater
than a threshold calculated as follows: 10 + attacker level - attacker level.</br></br>
• Progression: with each successful attack the fighter gains 1 experience point. If the attack
kills the opponent, the fighter gains as many points of experience as the level of the defeated
opponent. All 4 points of experience, the fighter changes level and can choose to increase
one of its characteristics: view +1 or force + 1 or health point +3. In case of progression of
health, the maximum health points increase AND the current health points go up to
maximum.</br></br>
• In practice, the level will be incremented only when an increase is made, and use (xp / 4) -
level to see if there are any increases to be made. The level starts and experience points start
at 0.</br></br>
• Each action causes an event to be created with a clear description. For example: "jonh
attacks bill and hits".</br></br>
</div>
    
    <footer class="conteneur">
        <div class="element">
        <p>Developper :</p>
    <ul>
     <li>Jeremy Catelain</li>
     <li>Cécile Coton</li>
     <li>Etienne Hensgen</li>
     <li>Stanislas Pinto</li>
  </ul>
       </div>
       <div class="element">
        <p>Option:</p>
            <ul>
                <li>Foundation 6</li>
                <li> Advanced management of the fighters and equipment</li>
            </ul>
       </div>
       <div class="element">
           <p>Link:</p>
           <ul>
               <li>Git: https://github.com/jeremyctln/WebArena/tree/master</li>
           </ul>
       </div>
    </footer>
    </body>
</html>
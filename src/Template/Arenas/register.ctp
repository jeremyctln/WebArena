<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Titre</title>
       

    </head>

    <body>
    <?= $this->Html->css('login')?>
    <?= $this->Html->css('foundation')?>
    <?= $this->Html->css('foundation.min')?>
    <?= $this->Html->script('js/foundation.min')?>
    <?= $this->Html->script('js/foundation')?>
    <?= $this->Html->script('js/jquery')?>
    <?= $this->Html->script('js/what-input')?>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <div class="foret">
    <h1>Web Arena <small>Let's play</small><span><?php echo $this->Html->link("Home", array('controller' => 'Arenas','action'=> 'header'), array( 'class' => 'button'))?></span></h1>
    </div>
    <?= $this->Form->create('post') ?>
  <div class="sign-in-form">
    <div>
      <?php echo $message  ?> 
    </div>
    <h4 class="text-center">REGISTER</h4> 
    <?= $this->Form->control('username',['name'=>'username','class'=>'sign-in-form-username']) ?> 
    <?= $this->Form->control('password',['name'=>'password','class'=>'sign-in-form-password']) ?></br>
    <?= $this->Form->button('Ajouter le compte', ['value'=>'ajout','name'=>'action','class'=>'sign-in-form-button']); ?>
    <?= $this->Form->button('Retour', ['value'=>'retour','name'=>'action','class'=>'sign-in-form-button']); ?>
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
       </div>
       <div class="element">
           <p>Link:</p>
           <ul>
               <li>Git: https://github.com/jeremyctln/WebArena/tree/master</li>
           </ul>
       </div>
    </footer>
</form>
</body>
</html>

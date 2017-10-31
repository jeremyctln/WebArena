

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
    <?= $this->fetch('content') ?>
    </body>
</html>
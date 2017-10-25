<html>
<head>
  <meta charset="utf-8">
  <title>Register</title>
</head>
<body>

  <div class="users form">
  <?= $this->Form->create('post') ?>
      <fieldset>
          <legend><?= __('Ajouter un utilisateur') ?></legend>
          <?= $this->Form->control('username') ?> 
          <?= $this->Form->control('password') ?>
      </fieldset>
  <?= $this->Form->button('Ajouter'); ?>
  <?= $this->Form->end() ?>
  </div>

</body>
</html>



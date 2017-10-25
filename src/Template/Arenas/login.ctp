<html>
<head>
  <meta charset="utf-8">
  <title>Login</title>
</head>
<body>

  <div class="users form">
  <?= $this->Form->create() ?>
      <fieldset>
          <legend><?= __("Merci de rentrer vos nom d'utilisateur et mot de passe") ?></legend>
          <?= $this->Form->control('username') ?>
          <?= $this->Form->control('password') ?>
      </fieldset>
  <?= $this->Form->button('Se Connecter'); ?>
  <?= $this->Form->end() ?>
  </div>

</body>
</html>



<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
</head>
<body>

	<div class="users form">
	<?= $this->Form->create('post') ?>
	    <fieldset>
	        <legend><?= __("Merci de rentrer vos nom d'utilisateur et mot de passe") ?></legend>
	        <?= $this->Form->control('username', ['value'=>'usr','name'=>'username']) ?>
	        <?= $this->Form->control('password', ['value'=>'pwd','name'=>'password']) ?>
	    </fieldset>
	<?= $this->Form->button('Se Connecter', ['value'=>'connection','name'=>'login']); ?>
	<?= $this->Form->button('Mot de Passe oublié', ['value'=>'oubli','name'=>'login']); ?>
	<?= $this->Form->end() ?>
	</div>

</body>
</html>



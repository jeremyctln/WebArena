
<?php echo $error; ?> <br>

<h2>
   <?php echo $GuildName; ?> 
</h2> <hr>

<?php echo $MsgContent; ?>


<?= $this->Form->create('post') ?>
    <fieldset>
        <legend><?= __("Write a message") ?></legend>
        <?= $this->Form->textarea('Content', ['name'=>'Content','value'=>'']) ?>
    </fieldset>
<?= $this->Form->button('Envoyer', ['value'=>'Envoyer','name'=>'guild']); ?>

    <fieldset>
        <legend><?= __("Join a guild (enter the guild's name)") ?></legend>
        <?= $this->Form->control('Guilde', ['name'=>'joindre','value'=>'']) ?>
    </fieldset>
<?= $this->Form->button('Rejoindre', ['value'=>'Rejoindre','name'=>'guild']); ?>

    <fieldset>
        <legend><?= __("Create a guild") ?></legend>
        <?= $this->Form->control('Guilde', ['name'=>'Nouveau','value'=>'']) ?>
    </fieldset>
<?= $this->Form->button('Créer', ['value'=>'Creer','name'=>'guild']); ?>


<?= $this->Form->end() ?>





<?php echo $error; ?> <br>

<?php echo $GuildName; ?> <br><br>

<?php echo $MsgContent; ?>


<?= $this->Form->create('post') ?>
    <fieldset>
        <legend><?= __("Ecrire un message") ?></legend>
        <?= $this->Form->textarea('Content', ['name'=>'Content','value'=>'']) ?>
    </fieldset>
<?= $this->Form->button('Envoyer', ['value'=>'Envoyer','name'=>'guild']); ?>

    <fieldset>
        <legend><?= __("Rejoindre une guilde (entrez le nom de la guilde)") ?></legend>
        <?= $this->Form->control('Guilde', ['name'=>'joindre','value'=>'']) ?>
    </fieldset>
<?= $this->Form->button('Rejoindre', ['value'=>'Rejoindre','name'=>'guild']); ?>

    <fieldset>
        <legend><?= __("Créer une guilde") ?></legend>
        <?= $this->Form->control('Guilde', ['name'=>'Nouveau','value'=>'']) ?>
    </fieldset>
<?= $this->Form->button('Créer', ['value'=>'Creer','name'=>'guild']); ?>


<?= $this->Form->end() ?>




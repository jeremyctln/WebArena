
<?= $this->Html->css('header')?>
<?= $this->Html->css('guild')?>
<?= $this->Html->css('sight')?>
<?= $this->Html->css('foundation')?>
<?= $this->Html->css('foundation.min')?>
<?= $this->Html->script('js/foundation.min')?>
<?= $this->Html->script('js/foundation')?>

<?php $this->extend('header'); ?>

<div class="grid-x grid-padding-x align-center"><!--align center-->
    <div class=" grid-y small-grid-frame" style="height: 400px;width: 1000px"><!--to have the scroll bar-->
        <div class="cell small-12 medium-cell-block-y">

        <?php echo $error; ?> <br>

        <?php echo $GuildName; ?> <br><br>

        <?php echo $MsgContent; ?>

        </div>
    </div>

    
<div class="cell small-9 ">
    <?= $this->Form->create('post') ?>
        <fieldset>
            <legend><?= __("Write a message") ?></legend>
            <?= $this->Form->textarea('Content', ['name'=>'Content','value'=>'']) ?>
        </fieldset>
 <!--   <div class="button" style="width: 223px; height:77px; font-size: 25px;">-->
    <?= $this->Form->button('Envoyer', ['value'=>'Envoyer','name'=>'guild', 'class' => 'buttonSize']); ?>
 <!--   </div>-->
</div>
<div class="cell small-9 ">
    <fieldset>
        <legend><?= __("Join a guild (enter the guild's name)") ?></legend>
        <?= $this->Form->control('Guilde', ['name'=>'joindre','value'=>'']) ?>
    </fieldset>
 <!--   <div class="button" style="width: 223px; height:77px; font-size: 25px;"> -->
<?= $this->Form->button('Rejoindre', ['value'=>'Rejoindre','name'=>'guild', 'class' => 'buttonSize']); ?>
  <!--  </div>-->
</div>
<div class="cell small-9 ">
    <fieldset>
        <legend><?= __("Create a guild") ?></legend>
        <?= $this->Form->control('Guilde', ['name'=>'Nouveau','value'=>'']) ?>
    </fieldset>
 <!--   <div class="button" style="width: 223px; height:77px; font-size: 25px;">-->
<?= $this->Form->button('Créer', ['value'=>'Creer','name'=>'guild', 'class' => 'buttonSize']); ?>
   </div>

<?= $this->Form->end() ?>
</div>
</div>


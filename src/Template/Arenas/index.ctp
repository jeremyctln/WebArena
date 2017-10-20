
<!-- permet de recuperer la vue -->
<?php $this->extend('footertest') ?>
<!-- caci est le content qu'il y a dans le fichier footer test!-->
ceci est un incertion d'un blick dans une vue

<a href="login">cliquer ici pour aller vers la page de login</a>

<?php $this->start('footer'); ?>
<div id="footer">
    mon footer  TDSI1 - Cécile Coton / Jérémy Catelain - A/G
</div>

<?php $this->end(); ?>
<!DOCTYPE html>

<?php ob_start(); ?>  
    <?php 
    	echo $errorMessage;
    ?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
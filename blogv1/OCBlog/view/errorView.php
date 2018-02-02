<!DOCTYPE html>

<?php ob_start(); ?>  
    <?php 
    	echo '<p>' . $e . '</p>';
    ?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
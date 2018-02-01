<!DOCTYPE html>

<?php ob_start(); ?>
    	<header>
    		<div>
    			<a href="index.php">Accueil</a>
                <a href="index.php?action=listPost">Tout les Billets</a>
    			<?php if (isset($_SESSION['password'])){
    			?>
    			<a href="index.php?action=admin">Administration</a>
                <a href="index.php?action=deco">Déconnexion</a>
    			<?php } else {
    			?>
    			<a href="view/connectView.php">Indentifiez-vous</a>
    			<?php    				    			
    			}
    			?>
    		</div>
    	</header>    
    <?php 
    	echo $errorMessage;
    ?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
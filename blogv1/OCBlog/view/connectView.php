<!DOCTYPE html>

<?php ob_start(); ?>
    	<header>
    		<div>
    			<a href="../index.php">Accueil</a>
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
    <div>
        <form method="post" action="../index.php?action=connect">
            <label>Mot De Passe</label>
            <input type="text" name=password />
            <input type="submit" name="submit" />
        </form>
    </div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
<!DOCTYPE html>

<?php ob_start(); ?>
<header>
    <div>
    	<a href="index.php">Accueil</a>
    	<?php if (isset($_SESSION['password'])){ ?>

    	<a href="index.php?action=admin">Administration</a>
        <a href="index.php?action=deco">Déconnexion</a>

    	<?php } else { ?>

    	<a href="view/connectView.php">Indentifiez-vous</a>

    	<?php } ?>    				    			
    </div>
</header>

<div>
	<a href="index.php?action=listSignalement">Les Billets les plus Signaler</a>
	<a href="index.php?action=addPost">Ajouté un billet</a>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
<!DOCTYPE html>

<?php ob_start(); ?>
<?php if (isset($_SESSION['password'])){
?>

<header>
    <div>
    	<a href="index.php">Accueil</a>
    	<a href="index.php?action=listPost">Tout les Billets</a>
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
<?php $content = ob_get_clean();
}
else{
	throw new NewException('Vous n\'avez pas accès à cette page');
}
?>
<?php require('view/template.php'); ?>
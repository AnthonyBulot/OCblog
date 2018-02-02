<!DOCTYPE html>

<?php ob_start(); ?>
<?php if (isset($_SESSION['password'])){
?>

<div>
	<a href="index.php?action=listReport">Les Billets les plus Signaler</a>
	<a href="index.php?action=addPost">Ajouté un billet</a>
</div>
<?php $content = ob_get_clean();
}
else{
	throw new NewException('Vous n\'avez pas accès à cette page');
}
?>
<?php require('view/template.php'); ?>
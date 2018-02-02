<!DOCTYPE html>

<?php ob_start(); ?>
<?php if (isset($_SESSION['password'])){
?>

<div class="admin">
	<button><a href="index.php?action=listReport">Les Billets les plus Signaler</a></button>
	<button><a href="index.php?action=addPost">Ajouté un billet</a></button>
</div>
<?php $content = ob_get_clean();
}
else{
	throw new NewException('Vous n\'avez pas accès à cette page');
}
?>
<?php require('view/template.php'); ?>
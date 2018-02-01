<!DOCTYPE html>

<?php ob_start(); ?>
<?php if (isset($_SESSION['password'])){
?>

    <header>
        <div>
            <a href="index.php">Accueil</a>
            <a href="index.php?action=admin">Administration</a>
            <a href="index.php?action=deco">Déconnexion</a>
        </div>
    </header>
<h1>Bienvenue sur votre Blog</h1>
<p>Voici les 5 commentaire les plus signaler :</p>
<p><a href="index.php?action=listSignalement">Rafraichir la page</a></p>

<?php
if ($delete == 1){ ?>
	<p>Commentaire supprimé avec succès</p>
<?php
}
elseif ($delete == 2){ ?>
	<p>Signalement supprimé avec succès</p>
<?php
}
while ($comment = $list->fetch())
{
?>
	<div class="comment">
    	<p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date'] ?></p>
    	<p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
    	<p>A été signaler <?= $comment['signalement'] ?> fois</p>
    	<a href="index.php?action=supprimerComment&amp;id=<?= $comment['id'] ?>">Supprimer le commentaire</a>
    	<a href="index.php?action=supprimerSignalement&amp;id=<?= $comment['id'] ?>">Enlever les signalements</a>
    </div>
<?php
}
$list->closeCursor();
}
else{
	throw new NewException('Vous n\'avez pas accès à cette page');
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
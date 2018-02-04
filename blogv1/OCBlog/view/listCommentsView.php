<!DOCTYPE html>

<?php ob_start(); ?>
<?php if (isset($_SESSION['password'])){
?>
<h1 class="titre">Bienvenue sur votre Blog</h1>
<p class="intro">Voici les commentaires les plus signalés :</p>
<p><a class="lienRaf" href="index.php?action=listReport">Rafraichir la page</a></p>

<?php
if ($delete == 1){ ?>
	<p class="info">Commentaire supprimé avec succès</p>
<?php
}
elseif ($delete == 2){ ?>
	<p class="info">Signalement supprimé avec succès</p>
<?php
}
while ($comment = $comments->fetch())
{
?>
	<div class="comment">
    	<p><strong class="author"><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_datefr'] ?></p>
    	<p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
    	<p>A été signaler <em class="report"><?= $comment['report'] ?></em> fois</p>
    	<a class="lienAdmin" href="index.php?action=deleteComment&amp;id=<?= $comment['id'] ?>">Supprimer le commentaire</a>
    	<a class="lienAdmin" href="index.php?action=deleteReport&amp;id=<?= $comment['id'] ?>">Enlever les signalements</a>
    </div>
<?php
}

echo '<p class="numberPages">Page : '; //Pour l'affichage, on centre la liste des pages
for($i=1; $i<=$numberPages; $i++) //On fait notre boucle
{
     //On va faire notre condition
     if($i==$currentPage) //Si il s'agit de la page actuelle...
     {
         echo ' [ '.$i.' ] '; 
     }  
     else //Sinon...
     {
          echo ' <a class="lienPage" href="index?action=listReport&amp;id='.$i.'">'.$i.'</a> ';
     }
}

$comments->closeCursor();
}
else{
	throw new NewException('Vous n\'avez pas accès à cette page');
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
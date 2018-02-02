<!DOCTYPE html>

<?php ob_start(); ?>
<?php if (isset($_SESSION['password'])){
?>
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
while ($comment = $comments->fetch())
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

echo '<p>Page : '; //Pour l'affichage, on centre la liste des pages
for($i=1; $i<=$nombreDePages; $i++) //On fait notre boucle
{
     //On va faire notre condition
     if($i==$pageActuelle) //Si il s'agit de la page actuelle...
     {
         echo ' [ '.$i.' ] '; 
     }  
     else //Sinon...
     {
          echo ' <a href="index?action=listSignalement&amp;id='.$i.'">'.$i.'</a> ';
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
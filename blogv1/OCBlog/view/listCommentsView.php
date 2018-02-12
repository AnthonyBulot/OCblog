<!DOCTYPE html>

<h1 class="titre">Bienvenue sur votre Blog</h1>
<p class="intro">Voici les commentaires les plus signalés :</p>
<p><a class="lienRaf" href="index.php?action=listReport">Rafraichir la page</a></p>

<?php
if (isset($_GET['delete']) && $_GET['delete'] == 1){ ?>
	<p class="info">Commentaire supprimé avec succès</p>
<?php
}
elseif (isset($_GET['delete']) && $_GET['delete'] == 2){ ?>
	<p class="info">Signalement supprimé avec succès</p>
<?php
}
while ($comment = $dataView['comments']->fetch())
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
for($i=1; $i<=$dataView['numberPages']; $i++) //On fait notre boucle
{
     //On va faire notre condition
     if($i==$dataView['currentPage']) //Si il s'agit de la page actuelle...
     {
         echo ' [ '.$i.' ] '; 
     }  
     else //Sinon...
     {
          echo ' <a class="lienPage" href="index?action=listReport&amp;id='.$i.'">'.$i.'</a> ';
     }
}


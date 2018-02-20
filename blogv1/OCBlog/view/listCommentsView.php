<?php $template = 'template'; ?>

<h1 class="titre">Bienvenue sur votre Blog</h1>
<p class="intro">Voici les commentaires les plus signalés :</p>
<p><a class="lienRaf" href="/OCBlog/blog/liste-signalement">Rafraichir la page</a></p>

<?php
if (isset($_GET['delete']) && $_GET['delete'] == 1){ ?>
	<p class="info">Commentaire supprimé avec succès</p>
<?php
}
elseif (isset($_GET['delete']) && $_GET['delete'] == 2){ ?>
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
    	<a class="lienAdmin" href="/OCBlog/blog/suprimer/comment-<?= $comment['id'] ?>">Supprimer le commentaire</a>
    	<a class="lienAdmin" href="/OCBlog/blog/suprimer-signalement/comment-<?= $comment['id'] ?>">Enlever les signalements</a>
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
          echo ' <a class="lienPage" href="/OCBlog/blog/liste-signalement/page-'.$i.'">'.$i.'</a> ';
     }
}


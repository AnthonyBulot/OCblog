<!DOCTYPE html>

<?php ob_start(); ?>

<h1>Bienvenue</h1>
<p>Tous les billets du blog :</p>


<?php
while ($data = $posts->fetch())
{
?>
    <div class="news">
        <h3>
            <?= htmlspecialchars($data['title']) ?>
            <em>le <?= $data['DATE_FORMAT'] ?></em>
        </h3>
        
        <p>
            <?= nl2br(htmlspecialchars($data['content'])) ?>
            <br />
            <em><a href="index.php?id=<?= $data['id'] ?>&amp;action=comments">Commentaires</a></em>
            <br/> 
            <?php if (isset($_SESSION['password'])){
            ?>
                <a href="index.php?id=<?= $data['id'] ?>&amp;action=modification">Modifier</a>
            <?php
            }
            ?>
        </p>
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
          echo ' <a href="index?action=listPost&amp;id='.$i.'">'.$i.'</a> ';
     }
}

$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
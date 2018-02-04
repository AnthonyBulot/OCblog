<!DOCTYPE html>

<?php ob_start(); ?>

<h1 class="titre">Billet simple pour l'Alaska</h1>
<p class="intro">Voici toutes les histoires déjà publiées de mon livres dans l'ordre décroissant :</p>

<div class="allNews">
<?php
while ($data = $posts->fetch())
{
    $content = substr($data['content'],0,100)
?>
    <div class="news">
        <h3 class="titreNews">
            <?= htmlspecialchars($data['title']) ?>
            <em class="dateNews">le <?= $data['DATE_FORMAT'] ?></em>
        </h3>
        
        <p class="textNews">
            <?php echo '' . nl2br($content) . '...'; ?>
            <br />
            <p class="pSuite"><a href="index.php?id=<?= $data['id'] ?>&amp;action=comments" class="lienSuite">Lire la suite</a></p>
            <br/>
            <em><a href="index.php?id=<?= $data['id'] ?>&amp;action=comments" class="lienNews">Commentaires</a></em>
            <br/> 
            <?php if (isset($_SESSION['password'])){
            ?>
                <em><a href="index.php?id=<?= $data['id'] ?>&amp;action=modification" class="lienNews">Modifier</a></em>
                <em><a href="index.php?id=<?= $data['id'] ?>&amp;action=deletePost" class="lienNews">Supprimer</a></em>
            <?php
            }
            ?>
        </p>
    </div>
<?php
} ?>
</div>
<?php
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
          echo ' <a class="lienPage" href="index?action=listPost&amp;id='.$i.'">'.$i.'</a> ';
     }
}

$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
<!DOCTYPE html>

<?php ob_start(); ?>

<h1 class="titre">Billet simple pour l'Alaska</h1>
<p class="intro">Voici les 5 dernières histoire publiées :</p>

<div class="allNews">
<?php
while ($data = $posts->fetch())
{
?>
    <div class="news">
        <h3 class="titreNews">
            <?= htmlspecialchars($data['title']) ?>
            <em class="dateNews">le <?= $data['DATE_FORMAT'] ?></em>
        </h3>
        
        <p class="textNews">
            <?= nl2br(htmlspecialchars($data['content'])) ?>
            <br />
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
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
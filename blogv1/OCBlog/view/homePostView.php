<!DOCTYPE html>

<h1 class="titre">Billet simple pour l'Alaska</h1>
<p class="intro">Voici les 5 dernières histoire publiées :</p>

<div class="allNews">
<?php
while ($data = $dataView['posts']->fetch())
{
?>
    <div class="news">
        <h3 class="titreNews">
            <?= htmlspecialchars($data['title']) ?>
            <em class="dateNews">le <?= $data['date_fr'] ?></em>
        </h3>
        
        <?php echo '<div class="textContent">' . nl2br(substr($data['content'],0,100)) . '...</div>'; ?>
        <br />
        <p class="pSuite"><a class="lienSuite" href="index.php?id=<?= $data['id'] ?>&amp;action=getPost">Lire la suite</a></p>
        <br />
        <em><a href="index.php?id=<?= $data['id'] ?>&amp;action=getPost" class="lienNews">Commentaires</a></em>
        <br/> 
        <?php if (isset($_SESSION['password'])){
        ?>
            <em><a href="index.php?id=<?= $data['id'] ?>&amp;action=updatePost" class="lienNews">Modifier</a></em>
            <em><a href="index.php?id=<?= $data['id'] ?>&amp;action=deletePost" class="lienNews">Supprimer</a></em>
        <?php
        }
        ?>
    </div>
<?php
} ?>
</div>

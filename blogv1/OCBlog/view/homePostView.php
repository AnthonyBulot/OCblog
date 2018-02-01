<!DOCTYPE html>

<?php ob_start(); ?>
<h1>Bienvenue</h1>
<p>Derniers billets du blog :</p>


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
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
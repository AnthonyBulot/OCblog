<!DOCTYPE html>

<?php ob_start(); ?>
    <h1 class="titre">Billet</h1>
    <?php $data = $post->fetch(); ?>
    <div class="allNews">
        <div class="news">
            <h3 class="titreNews">
                <?= htmlspecialchars($data['title']) ?>
                <em class="dateNews">le <?= $data['date_fr'] ?></em>
            </h3>
        
            <div class="textContent"><?= nl2br($data['content']) ?></div>
            <br />
            <?php if (isset($_SESSION['password'])){
            ?>
                <a href="index.php?id=<?= $data['id'] ?>&amp;action=modification" class="lienNews">Modifier</a>
                <em><a href="index.php?id=<?= $data['id'] ?>&amp;action=deletePost" class="lienNews">Supprimer</a></em>
            <?php
            }
            ?>
        </div>
    </div>
        <h2 class="titre2">Commentaires</h2>

        <?php
        if ($report == true){
            echo '<p class="info"> Le commentaire a bien été signalé ! </p>';
        }
        while ($comment = $comments->fetch())
        {
        ?>
            <div class="comment">            
                <p class="textComment"><strong class="author"><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_datefr'] ?></p>
                <p class="textComment"><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
                <p><a class="lienComment" href="index.php?id=<?= $comment['id'] ?>&amp;action=report&amp;postId=<?= $data['id'] ?>">Signaler</a></p>
            </div>

        <?php
        }
?>
        <form class="formComment" method="post" action="index.php?id=<?= $data['id'] ?>&amp;action=addComment">
            <p class="formCommentText">Ajouté un commentaire</p>
            <label for="Nom_commentaire">Nom</label><input type="text" name="author" id="Nom_commentaire" />
            <label for="comment">Commentaire</label><textarea rows="10" name="comment" id="comment"></textarea>
            <input class="formCommentSubmit" type="submit" name="submit" value="Envoyer"/>
        </form>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
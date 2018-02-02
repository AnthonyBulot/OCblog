<!DOCTYPE html>

<?php ob_start(); ?>
        <h1>Billet</h1>
        <?php $data = $post->fetch(); ?>
        <div class="news">
            <h3>
                <?= htmlspecialchars($data['title']) ?>
                <em>le <?= $data['DATE_FORMAT'] ?></em>
            </h3>
        
            <p>
                <?= nl2br(htmlspecialchars($data['content'])) ?>
                <br />
                <?php if (isset($_SESSION['password'])){
                ?>
                        <a href="index.php?id=<?= $data['id'] ?>&amp;action=modification">Modifier</a>
                <?php
                }
                ?>
            </p>
        </div>
        <h2>Commentaires</h2>

        <?php
        while ($comment = $comments->fetch())
        {
        ?>
            <div class="comment">            
                <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date'] ?></p>
                <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
                <p><a href="index.php?id=<?= $comment['id'] ?>&amp;action=report">Signaler</a></p>
            </div>

        <?php
        }
?>
        <form method="post" action="index.php?id=<?= $data['id'] ?>&amp;action=addComment">
            <label for="Nom_commentaire">Nom</label><input type="text" name="author" id="Nom_commentaire" />
            <label for="Nom_commentaire">Commentaire</label><textarea rows="10" name="comment"></textarea>
            <input type="submit" name="submit" value="Envoyer"/>
        </form>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
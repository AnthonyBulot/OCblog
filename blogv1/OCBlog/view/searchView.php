<?php ?>

<?php $template = 'template'; ?>

<p class="intro">Voici les résultats :</p>

<div class="allNews">
<?php
while ($data = $search->fetch())
{
?>
    <div class="news">
        <h3 class="titreNews">
            <?= htmlspecialchars($data['title']) ?>
            <em class="dateNews">le <?= $data['date_fr'] ?></em>
        </h3>
        
        <?php echo '<div class="textContent">' . nl2br(substr($data['content'],0,100)) . '...</div>'; ?>
        <br />
        <p class="pSuite"><a class="lienSuite" href="/OCBlog/blog/getPost/post-<?= $data['id'] ?>">Lire la suite</a></p>
        <br />
        <em><a href="/OCBlog/blog/getPost/post-<?= $data['id'] ?>" class="lienNews">Commentaires</a></em>
        <br/> 
        <?php if (isset($_SESSION['password'])){
        ?>
            <em><a href="/OCBlog/blog/updatePost/post-<?= $data['id'] ?>" class="lienNews">Modifier</a></em>
            <em><a href="/OCBlog/blog/deletePost/post-<?= $data['id'] ?>" class="lienNews">Supprimer</a></em>
        <?php
        }
        ?>
    </div>
<?php
} ?>
</div>
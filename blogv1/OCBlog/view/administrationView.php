<?php $template = 'template'?>

<h1 class="titre">Bonjour Jean Forteroche</h1>
<p class="adminNumber">Vous avez publié <em class="report"><?= $numberPosts ?></em> posts depuis le début ! </p>
<div class="admin">
	<p class="lienAdminReport"><a href="/blog/liste-signalement" class="lienAdminis">Les Billets les plus Signaler</a></p>
	<p class="lienAdminAdd"><a href="/blog/ajout-article" class="lienAdminis">Ajouté un billet</a></p>
</div>


<p class="adminNumber">Voici votre dernier post :</p>
<div class="news">
        <h3 class="titreNews">
            <?= htmlspecialchars($post['title']) ?>
            <em class="dateNews">le <?= $post['date_fr'] ?></em>
        </h3>
        
        <p class="textNews">
            <?php echo '<div class="textContent">' . nl2br(substr($post['content'],0,100)) . '...</div>'; ?>
            <br />
            <p class="pSuite"><a href="/blog/article-<?= $post['id'] ?>" class="lienSuite">Lire la suite</a></p>
            <br/>
            <em><a href="/blog/article-<?= $post['id'] ?>" class="lienNews">Commentaires</a></em>
            <br/> 
            <?php if (isset($_SESSION['password'])){
            ?>
                <em><a href="/blog/modification/article-<?= $post['id'] ?>" class="lienNews">Modifier</a></em>
                <em><a href="/blog/suprimer/article-<?= $post['id'] ?>" class="lienNews">Supprimer</a></em>
            <?php
            }
            ?>
        </p>
</div>

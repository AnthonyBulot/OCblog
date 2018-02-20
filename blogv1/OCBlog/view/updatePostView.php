<?php $template = 'template'; ?>

<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>    
<script src="/OCBlog/js/tinymce.js" type="text/javascript"></script>

<h1 class="titre">Billet simple pour l'Alaska</h1>
<p class="intro">Modifié un chapitre :</p>


<form method="post" action="/OCBlog/blog/modification-article/article-<?= $post['id'] ?>">
    <input type="text" name="title" value="<?= $post['title'] ?>" class="texteAddPost" />
    <textarea name="addPost">
        <?= $post['content'] ?>
    </textarea>
    <input type="submit" name="submit" value="Ajouté" class="buttonAddPost">
</form>

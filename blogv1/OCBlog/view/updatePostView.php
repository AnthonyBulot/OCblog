<!DOCTYPE html>

<?php ob_start(); ?>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>    
<script src="js/tinymce.js" type="text/javascript"></script>

<h1 class="titre">Billet simple pour l'Alaska</h1>
<p class="intro">Modifié un chapitre :</p>


<form method="post" action="index.php?action=updatedPost&amp;id=<?= $post['id'] ?>">
    <input type="text" name="title" value="<?= $post['title'] ?>" class="texteAddPost" />
    <textarea name="addPost">
        <?= $post['content'] ?>
    </textarea>
    <input type="submit" name="submit" value="Ajouté" class="buttonAddPost">
</form>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
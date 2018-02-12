<!DOCTYPE html>

<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>    
<script src="js/tinymce.js" type="text/javascript"></script>

<h1 class="titre">Billet simple pour l'Alaska</h1>
<p class="intro">Modifié un chapitre :</p>


<form method="post" action="index.php?id=<?= $dataView['id'] ?>&amp;action=updatedPost">
    <input type="text" name="title" value="<?= $dataView['title'] ?>" class="texteAddPost" />
    <textarea name="addPost">
        <?= $dataView['content'] ?>
    </textarea>
    <input type="submit" name="submit" value="Ajouté" class="buttonAddPost">
</form>

<!DOCTYPE html>

<?php ob_start(); ?>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>    

<h1 class="titre">Billet simple pour l'Alaska</h1>
<p class="intro">Ajouté un chapitre :</p>

<script type="text/javascript">
    tinymce.init({
  selector: 'textarea',
  height: 500,
  menubar: false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor textcolor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code help wordcount'
  ],
  toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css']
});
</script>
<form method="post" action="index.php?action=postWrite">
    <input type="text" name="titre" value="Votre Titre..." class="texteAddPost" />
    <textarea name="addPost">
        <p>Votre Texte...</p>
    </textarea>
    <input type="submit" name="submit" value="Ajouté" class="buttonAddPost">
</form>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
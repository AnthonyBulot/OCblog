<!DOCTYPE html>

<?php ob_start(); ?>  
    <form method="post" action="index.php?action=connect" class="form">
        <div>
            <label>Mot De Passe</label>
            <input type="password" name=password />
        </div>
        <input id="connectSubmit" type="submit" name="submit" />
    </form>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
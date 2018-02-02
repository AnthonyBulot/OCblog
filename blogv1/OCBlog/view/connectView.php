<!DOCTYPE html>

<?php ob_start(); ?>  
    <div>
        <form method="post" action="index.php?action=connect">
            <label>Mot De Passe</label>
            <input type="password" name=password />
            <input type="submit" name="submit" />
        </form>
    </div>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
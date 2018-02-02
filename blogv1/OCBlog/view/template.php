<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Blog</title>
        <link href="public/css/style.css" rel="stylesheet" /> 
    </head>
        
    <body>
        <header>
            <div>
                <a href="index.php">Accueil</a>
                <a href="index.php?action=listPost">Tout les Billets</a>                
                <?php if (isset($_SESSION['password'])){
                ?>
                <a href="index.php?action=admin">Administration</a>
                <a href="index.php?action=deco">Déconnexion</a>
                <?php } else {
                ?>
                <a href="index.php?action=formConnect">Indentifiez-vous</a>
                <?php                                   
                }
                ?>
            </div>
        </header>        
        <?= $content ?>
        <footer>
            <p>Ce blog a été fait dans le cadre de la formation Développeur Web Junior de OpenClassrooms</p>
        </footer>
    </body>
</html>
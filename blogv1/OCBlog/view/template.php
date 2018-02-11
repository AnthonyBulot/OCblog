<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Blog</title>
        <link href="css/style.css" rel="stylesheet" /> 
    </head>
        
    <body>
        <header>
            <p class="textMenu">Blog de Jean Forteroche</p>
            <div id="menu">
                <p><img src="css/image/logo_livre.png" alt="Logo livre"></p>
                <a href="index.php" class="lienMenu">Accueil</a>
                <a href="index.php?action=listPost" class="lienMenu">Chapitres</a>                
                <?php if (isset($_SESSION['password'])): ?>                
                <a href="index.php?action=admin" class="lienMenu">Administration</a>
                <a href="index.php?action=deco" class="lienMenu">Déconnexion</a>
                <?php else: ?>              
                <a href="index.php?action=formConnect" class="lienMenu">Indentifiez-vous</a>
                <?php                                   
                endif;
                ?>
            </div>
        </header>         
        <section>      
            <?= $content ?>
        </section> 
        <footer>
            <p>Ce blog a été fait dans le cadre de la formation Développeur Web Junior de OpenClassrooms</p>
        </footer>

    </body>
</html>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Blog</title>
        <link href="css/styles.css" rel="stylesheet" /> 
    </head>
        
    <body>
        <header>
            <p class="textMenu">Blog de Jean Forteroche</p>
            <div class="search">
                <form method="post" action="/blog/recherche">
                    <input class="searchText" type="search" name="search">
                    <input class="searchSubmit" type="submit" name="submit" value="Recherchez"> 
                </form>
            </div>
            <div id="menu">
                <p><img src="css/image/logo_livre.png" alt="Logo livre"></p>
                <a href="/blog" class="lienMenu">Accueil</a>
                <a href="/blog/liste-article" class="lienMenu">Chapitres</a>                
                <?php if (isset($_SESSION['password'])): ?>                
                <a href="/blog/administration" class="lienMenu">Administration</a>
                <a href="/blog/deconnect" class="lienMenu">Déconnexion</a>
                <?php else: ?>              
                <a href="/blog/formulaire-connexion" class="lienMenu">Indentifiez-vous</a>
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
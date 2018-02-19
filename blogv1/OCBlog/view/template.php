<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Blog</title>
        <link href="/OCBlog/css/styles.css" rel="stylesheet" /> 
    </head>
        
    <body>
        <header>
            <p class="textMenu">Blog de Jean Forteroche</p>
            <div class="search">
                <form method="post" action="/OCBlog/blog/search">
                    <input class="searchText" type="search" name="search">
                    <input class="searchSubmit" type="submit" name="submit" value="Recherchez"> 
                </form>
            </div>
            <div id="menu">
                <p><img src="/OCBlog/css/image/logo_livre.png" alt="Logo livre"></p>
                <a href="/OCBlog/blog" class="lienMenu">Accueil</a>
                <a href="/OCBlog/blog/listPost" class="lienMenu">Chapitres</a>                
                <?php if (isset($_SESSION['password'])): ?>                
                <a href="/OCBlog/blog/admin" class="lienMenu">Administration</a>
                <a href="/OCBlog/blog/deconnect" class="lienMenu">Déconnexion</a>
                <?php else: ?>              
                <a href="/OCBlog/blog/formConnect" class="lienMenu">Indentifiez-vous</a>
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
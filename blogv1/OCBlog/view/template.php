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
    			<?php if (isset($_SESSION['password'])){
    			?>
    			<a href="index.php?action=admin">Administration</a>
    			<?php } else {
    			?>
    			<a href="index.php?action=connection">Indentifiez-vous</a>
    			<?php    				    			
    			}
    			?>
    		</div>
    	</header>
        <?= $content ?>
    </body>
</html>
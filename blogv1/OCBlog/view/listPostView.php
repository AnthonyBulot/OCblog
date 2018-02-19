<?php $template = 'template'; ?>

<h1 class="titre">Billet simple pour l'Alaska</h1>
<p class="intro">Voici toutes les histoires déjà publiées de mon livres dans l'ordre décroissant :</p>

<div class="allNews">
<?php
while ($data = $posts->fetch())
{
?>
    <div class="news">
        <h3 class="titreNews">
            <?= htmlspecialchars($data['title']) ?>
            <em class="dateNews">le <?= $data['date_fr'] ?></em>
        </h3>
        
        <p class="textNews">
            <?php echo '<div class="textContent">' . nl2br(substr($data['content'],0,100)) . '...</div>'; ?>
            <br />
            <p class="pSuite"><a href="/OCBlog/blog/getPost/post-<?= $data['id'] ?>" class="lienSuite">Lire la suite</a></p>
            <br/>
            <em><a href="/OCBlog/blog/getPost/post-<?= $data['id'] ?>" class="lienNews">Commentaires</a></em>
            <br/> 
            <?php if (isset($_SESSION['password'])){
            ?>
                <em><a href="/OCBlog/blog/updatePost/post-<?= $data['id'] ?>" class="lienNews">Modifier</a></em>
                <em><a href="/OCBlog/blog/deletePost/post-<?= $data['id'] ?>" class="lienNews">Supprimer</a></em>
            <?php
            }
            ?>
        </p>
    </div>
<?php
} ?>
</div>
<?php
echo '<p class="numberPages">Page : '; //Pour l'affichage, on centre la liste des pages
for($i=1; $i<=$numberPages; $i++) //On fait notre boucle
{
     //On va faire notre condition
     if($i==$currentPage) //Si il s'agit de la page actuelle...
     {
         echo ' [ '.$i.' ] '; 
     }	
     else //Sinon...
     {
          echo ' <a class="lienPage" href="/OCBlog/blog/listPost/post-'.$i.'">'.$i.'</a> ';
     }
}


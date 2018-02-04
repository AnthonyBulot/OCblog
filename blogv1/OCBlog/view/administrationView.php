<!DOCTYPE html>

<?php ob_start(); ?>
<?php if (isset($_SESSION['password'])){
	$content = substr($data['content'],0,100)

?>
<h1 class="titre">Bonjour Jean Forteroche</h1>
<p class="adminNumber">Vous avez publié <em class="report"><?= $numberPosts ?></em> posts depuis le début ! </p>
<div class="admin">
	<p class="lienAdminReport"><a href="index.php?action=listReport" class="lienAdminis">Les Billets les plus Signaler</a></p>
	<p class="lienAdminAdd"><a href="index.php?action=addPost" class="lienAdminis">Ajouté un billet</a></p>
</div>


<p class="adminNumber">Voici votre dernier post :</p>
<div class="news">
        <h3 class="titreNews">
            <?= htmlspecialchars($data['title']) ?>
            <em class="dateNews">le <?= $data['date_fr'] ?></em>
        </h3>
        
        <p class="textNews">
            <?php echo '' . nl2br($content) . '...'; ?>
            <br />
            <p class="pSuite"><a class="lienSuite" href="index.php?id=<?= $data['id'] ?>&amp;action=comments">Lire la suite</a></p>
            <br />
            <em><a href="index.php?id=<?= $data['id'] ?>&amp;action=comments" class="lienNews">Commentaires</a></em>
            <br/> 
            <?php if (isset($_SESSION['password'])){
            ?>
                <em><a href="index.php?id=<?= $data['id'] ?>&amp;action=modification" class="lienNews">Modifier</a></em>
                <em><a href="index.php?id=<?= $data['id'] ?>&amp;action=deletePost" class="lienNews">Supprimer</a></em>
            <?php
            }
            ?>
        </p>
    </div>
<?php $content = ob_get_clean();
}
else{
	throw new NewException('Vous n\'avez pas accès à cette page');
}
?>
<?php require('view/template.php'); ?>
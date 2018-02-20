<?php

$routeur = [
	"#^/blog/article-([0-9]+)$#" => "ControlerFront@getPost",
	"#^/blog/article-([0-9]+)/report$#" => "ControlerFront@getPost",
	"#^/blog/ajout-commentaire/article-([0-9]+)$#" => "ControlerFront@addComment",
	"#^/blog/formulaire-connexion$#" => "ControlerFront@formConnect",
	"#^/blog/connexion$#" => "ControlerFront@connect",
	"#^/blog/administration$#" => "ControlerBack@admin",
	"#^/blog/deconnect$#" => "ControlerBack@deconnect",
	"#^/blog/signalement/article-([0-9]+)/commentaire-([0-9]+)$#" => "ControlerFront@report",
	"#^/blog/liste-signalement$#" => "ControlerBack@listReport",
	"#^/blog/liste-signalement/page-([0-9]+)$#" => "ControlerBack@listReport",
	"#^/blog/liste-signalement/delete-([0-9]+)$#" => "ControlerBack@listReport",
	"#^/blog/suprimer/comment-([0-9]+)$#" => "ControlerBack@deleteComment",
	"#^/blog/suprimer-signalement/comment-([0-9]+)$#" => "ControlerBack@deleteReport",
	"#^/blog/liste-article$#" => "ControlerFront@listPost",
	"#^/blog/liste-article/page-([0-9]+)$#" => "ControlerFront@listPost",
	"#^/blog/suprimer/article-([0-9]+)$#" => "ControlerBack@deletePost",
	"#^/blog/ajout-article$#" => "ControlerBack@addPost",
	"#^/blog/article-ecrit$#" => "ControlerBack@postWrite",
	"#^/blog/modification/article-([0-9]+)$#" => "ControlerBack@updatePost",
	"#^/blog/modification-article/article-([0-9]+)$#" => "ControlerBack@updatedPost",
	"#^/blog/recherche$#" => "ControlerFront@search",
	"#^/blog$#" => "ControlerFront@homePosts",
	"#^/$#" => "ControlerFront@homePosts"
];
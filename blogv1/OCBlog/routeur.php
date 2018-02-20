<?php

$routeur = [
	"#^/OCBlog/blog/article-([0-9]+)$#" => "ControlerFront@getPost",
	"#^/OCBlog/blog/article-([0-9]+)/report$#" => "ControlerFront@getPost",
	"#^/OCBlog/blog/ajout-commentaire/article-([0-9]+)$#" => "ControlerFront@addComment",
	"#^/OCBlog/blog/formulaire-connexion$#" => "ControlerFront@formConnect",
	"#^/OCBlog/blog/connexion$#" => "ControlerFront@connect",
	"#^/OCBlog/blog/administration$#" => "ControlerBack@admin",
	"#^/OCBlog/blog/deconnect$#" => "ControlerBack@deconnect",
	"#^/OCBlog/blog/signalement/article-([0-9]+)/commentaire-([0-9]+)$#" => "ControlerFront@report",
	"#^/OCBlog/blog/liste-signalement$#" => "ControlerBack@listReport",
	"#^/OCBlog/blog/liste-signalement/page-([0-9]+)$#" => "ControlerBack@listReport",
	"#^/OCBlog/blog/liste-signalement/delete-([0-9]+)$#" => "ControlerBack@listReport",
	"#^/OCBlog/blog/suprimer/comment-([0-9]+)$#" => "ControlerBack@deleteComment",
	"#^/OCBlog/blog/suprimer-signalement/comment-([0-9]+)$#" => "ControlerBack@deleteReport",
	"#^/OCBlog/blog/liste-article$#" => "ControlerFront@listPost",
	"#^/OCBlog/blog/liste-article/page-([0-9]+)$#" => "ControlerFront@listPost",
	"#^/OCBlog/blog/suprimer/article-([0-9]+)$#" => "ControlerBack@deletePost",
	"#^/OCBlog/blog/ajout-article$#" => "ControlerBack@addPost",
	"#^/OCBlog/blog/article-ecrit$#" => "ControlerBack@postWrite",
	"#^/OCBlog/blog/modification/article-([0-9]+)$#" => "ControlerBack@updatePost",
	"#^/OCBlog/blog/modification-article/article-([0-9]+)$#" => "ControlerBack@updatedPost",
	"#^/OCBlog/blog/recherche$#" => "ControlerFront@search",
	"#^/OCBlog/blog$#" => "ControlerFront@homePosts"
];
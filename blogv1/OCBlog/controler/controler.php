<?php

class Controler 
{	
	public function render($view, $dataView = [])
	{

		extract($dataView);

		ob_start();
		require('view/' . $view . '.php');
		$content = ob_get_clean();

		if (!isset($template)) {
			throw new NewException("Il manque une information", 400);
		}

		require('view/' . $template . '.php');
	}
}
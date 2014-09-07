<?php

class eBook {

	private $title = 'test';

	public function __construct ($pathToEbook) {

		// On lit le contenu du fichier ebook
		$ebook = simplexml_load_file($pathToEbook, null, LIBXML_NOCDATA);


		// Parcours des nœuds du fichier XML
		foreach ($noeuds as $noeud) {



		}
	}


	// Getters

	public function getTitle () {
		return $this->title;
	}


}

 ?>

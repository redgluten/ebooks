<?php 

class eBook {
	
	private $title = 'test';

	public function __construct ($pathToEbook) {

		// On lit le contenu du fichier ebook
		$ebook = simplexml_load_file($pathToEbook, null, LIBXML_NOCDATA);

		
		// Parcours des nœuds du fichier XML
		foreach ($ as $bien) {

			// On ne récupère pas la donnée nom Agence du XML
			// car on veut plus simple pour la base de données
			$aCor["codeAgence"]   = $agenceIdName;

			// Test du type de bien
			if (isset($bien->MAISON)) {
				$aCor["typeBien"] = "maison";

		}
	}


	// Getters
	
	public function getTitle () {
		return $this->title;
	}


}

 ?>
<?php 

	/**
	 * Charge les fichiers de classe
	 */
	function chargerClasse($classe) { 
		require_once 'classes/' . $classe . '.class.php';
	}

	spl_autoload_register('chargerClasse');


?>
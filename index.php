<?php

// Affichage des erreurs
@ini_set('display_errors', 'on');

// Appel des fonctions principales
require_once "functions.php";

if (isset($eBook)) {
	$pageTitle = $eBook->getTitle();
} else {
	$pageTitle = 'Home';
}

?>


<!DOCTYPE html>
<html lang="fr">

<?php include "head.php"; ?>

<body id="top">

	<div class="page-wrapper">
		<?php include "header.php"; ?>
		<?php include "content.php"; ?>
		<?php include "footer.php"; ?>
	</div>

</body>
</html>

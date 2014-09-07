<?php

// Affichage des erreurs
@ini_set('display_errors', 'on');

// Appel des fonctions principales
require_once "functions.php";

// Création d’un nouveau livre
$eBook = new eBook('ebooks/ebook_test/Ops/10.html');

?>


<!DOCTYPE html>
<html lang="fr">

<?php include "head.php"; ?>

<body>

	<div class="page-wrapper">
		<?php include "header.php"; ?>
		<?php include "content.php"; ?>
		<?php include "footer.php"; ?>
	</div>

</body>
</html>

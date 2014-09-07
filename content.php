<?php

// Display content from user input
if (isset($_GET['page']) AND ($_GET['page'] == 'home')) {
	include 'home.php';
} elseif (isset($_GET['page']) AND ($_GET['page'] == 'book')) {
	include 'book.php';
} else {
	include 'home.php';
}

?>

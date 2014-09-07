<?php

if (isset($_GET['book']) AND ($_GET['book'] == 1)) {
	$eBook = new eBook('ebooks/ebook_test/Ops/');
} elseif (isset($_GET['book']) AND ($_GET['book'] == 2)) {
	$eBook = new eBook('ebooks/ebook_test2/OPS/');
}

?>

<section class="content">
	<h1 class="content-title"><?= $eBook->getTitle(); ?></h1>
	<article class="ebook-content">
		<?= $eBook->getContent(); ?>
	</article>
</section>

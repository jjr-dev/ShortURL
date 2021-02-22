<?php
	include '../s/functions.php';

	if(!isset($_POST['customUrl'])) {
		$_POST['customUrl'] = false;
	}

	echo shortUrl($_POST['shortUrl'], $_POST['customUrl']);
	exit;
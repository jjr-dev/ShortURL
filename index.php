<?php
	include 'functions.php';

	// Criar URL encurtada
		shortUrl('https://google.com', 'google');

	// Abrir URL encurtada
		openShortUrl(clearShortUrl($_SERVER["REQUEST_URI"]));
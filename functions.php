<?php
	function shortUrl($url, $custom = false) {
		date_default_timezone_set('America/Sao_Paulo');
		
		if(file_exists('shorts.json')) {
			$shorts = (array) json_decode(file_get_contents('shorts.json'));
		} else {
			file_put_contents('shorts.json', null);
		}

		if(!$custom) {
			$random = random_bytes(4);
			$random = bin2hex($random);
			$short  = $random;
		} else {
			$short = $custom;
		}

		if(isset($shorts[$short])) {
			// echo 'URL Personalizada indisponível';
			return false;
			exit;
		} else {
			$shorts[$short] = array(
				'short'		=> $short,
				'date'		=> date('Y-m-d H:i'),
				'origin'	=> $url,
				'count'		=> 0
			);
		}

		$json = json_encode($shorts);
		if(file_put_contents('shorts.json', $json)) {
			// echo 'Encurtado com sucesso';
			return true;
		} else {
			// echo 'Erro ao encurtar';
			return false;
		}
	}

	function openShortUrl($short) {
		if(file_exists('shorts.json')) {
			$shorts = (array) json_decode(file_get_contents('shorts.json'));
		} else {
			// echo 'Nenhuma URL encontrada';
			return false;
			exit;
		}

		if(isset($shorts[$short])) {
			$shorts[$short]->count ++;

			$json = json_encode($shorts);
			if(file_put_contents('shorts.json', $json)) {
				// echo 'Atualizado Count';
				return true;
			} else {
				// echo 'Erro ao contabilizar';
				return false;
			}

			header("Location: " . $shorts[$short]->origin);
		} else {
			// echo 'URL encurtada não existente';
			return false;
		}
	}

	function clearShortUrl($url) {
		$split = explode('/',$url);
		return end($split);
	}
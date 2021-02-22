<?php
	function setErro($code) {
		$error['erro'] = true;
		switch ($code) {
			case 1:
				$error['code'] 	= 1;
				$error['msg'] 	= 'URL personalizada já em uso';
				break;
			case 2:
				$error['code'] 	= 2;
				$error['msg'] 	= 'Erro ao armazenar URL encurtada';
				break;
			case 3:
				$error['code'] 	= 3;
				$error['msg'] 	= 'Nenhuma URL encurtada';
				break;
			case 4:
				$error['code'] 	= 4;
				$error['msg'] 	= 'Erro ao armazenar a quantidade de acessos';
				break;
			case 5:
				$error['code'] 	= 5;
				$error['msg'] 	= 'URL informada não existente';
				break;
			default:
				$error['code']	= 0;
				$error['msg'] 	= 'Ocorreu um erro desconhecido';
				break;
		}
		return json_encode($error, JSON_UNESCAPED_UNICODE);
	}

	function shortUrl($url, $custom = false) {
		date_default_timezone_set('America/Sao_Paulo');
		
		if(file_exists('../s/shorts.json')) {
			$shorts = (array) json_decode(file_get_contents('../s/shorts.json'));
		} else {
			file_put_contents('../s/shorts.json', null);
		}

		if(!$custom) {
			$random = random_bytes(3);
			$random = bin2hex($random);
			$short  = $random;
		} else {
			$short = $custom;
		}

		if(isset($shorts[$short])) {
			return setErro(1);
		} else {
			$shorts[$short] = array(
				'short'		=> $short,
				'date'		=> date('Y-m-d H:i'),
				'origin'	=> $url,
				'count'		=> 0
			);
		}

		$json = json_encode($shorts);
		if(file_put_contents('../s/shorts.json', $json)) {
			$return = array(
				'short'		=> $short,
				'date'		=> date('Y-m-d H:i'),
				'origin'	=> $url
			);
			return json_encode($return);
		} else {
			return setErro(2);
		}
	}

	function openShortUrl($short) {
		if(file_exists('../s/shorts.json')) {
			$shorts = (array) json_decode(file_get_contents('../s/shorts.json'));
		} else {
			return setErro(3);
		}

		if(isset($shorts[$short])) {
			$shorts[$short]->count ++;

			$json = json_encode($shorts);
			if(file_put_contents('../s/shorts.json', $json)) {
				header("Location: " . $shorts[$short]->origin);
				// Realiza redirecionamento - Sucesso
			} else {
				return setErro(4);
			}

		} else {
			return setErro(5);
		}
	}

	function clearShortUrl($url) {
		$split = explode('/',$url);
		return end($split);
	}

	function infosUrl($short) {
		if(file_exists('../s/shorts.json')) {
			$shorts = (array) json_decode(file_get_contents('../s/shorts.json'));
			if(isset($shorts[$short])) {
				return json_encode($shorts[$short]);
			} else {
				return setErro(5);
			}
		} else {
			return setErro(3);
		}
	}
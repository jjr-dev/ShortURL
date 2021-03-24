<?php
	/* 
	Developed by Julimar Junior
	Version: 2.0
	GitHub: https://github.com/JulimarJunior/ShortURL
	*/

	class shortURL {
		var $url;
		var $custom;
		var $database 	= array();

		var $type 		= 'json';
		var $bytes 		= 3;
		var $redirect 	= false;

		function redirect($redirect) {
			$this->redirect = $redirect;
		}

		function type($type) {
			$this->type = $type;
		}

		function bytes($bytes) {
			$this->bytes = $bytes;
		}

		function url($url) {
			$this->url = $url;
		}

		function custom($custom) {
			$this->custom = $custom;
		}

		function random() {
			$random = random_bytes($this->bytes);
			$random = bin2hex($random);
			return $random;
		}

		function database($db) {
			$this->database['drive'] 	= $db['drive'];
			$this->database['host'] 	= $db['host'];
			$this->database['name'] 	= $db['name'];
			$this->database['user'] 	= $db['user'];
			$this->database['password'] = $db['password'];
		}

		function execute() {
			$result = array();

			$moment = date('Y-m-d H:i');

			try {
				if($this->type == 'mysql') {
					try {
					  	$conn = new PDO($this->database['drive'].':host='.$this->database['host'].';dbname='.$this->database['name'], $this->database['user'], $this->database['password']);
					    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

					    $short;
						if(!$this->custom) {
							$short = $this->random();
						} else {
							$short = $this->custom;
						}

					    $code = $conn->prepare("SELECT cd_short FROM tb_short WHERE ds_short = :short");
					    $code->bindParam(':short', $short);
					    $code->execute();
					    $verifyShort = $code->fetchColumn();

					    if($verifyShort) {
					    	throw new Exception('Custom URL already in use');
					    } else {
					    	$code = $conn->prepare("INSERT INTO tb_short(ds_short, ds_origin, dt_short) VALUES(:short, :origin, :date)");
						    $code->bindParam(':short', $short);
						    $code->bindParam(':origin', ($this->url));
						    $code->bindParam(':date', $moment);
						    $code->execute();

					    	$result = array(
								'short'		=> $short,
								'date'		=> $moment,
								'origin'	=> $this->url
							);
					    }
					} catch(PDOException $e) {
						throw new Exception($e->getMessage());
					}
				} elseif($this->type == 'json') {
					if(file_exists('shorts.json')) {
						$shorts = (array) json_decode(file_get_contents('shorts.json'));
					} else {
						file_put_contents('shorts.json', null);
					}

					$short;
					if(!$this->custom) {
						$short = $this->random();
					} else {
						$short = $this->custom;
					}

					if(isset($shorts[$short])) {
						throw new Exception('Custom URL already in use');
					} else {
						$shorts[$short] = array(
							'short'		=> $short,
							'date'		=> $moment,
							'origin'	=> $this->url,
							'count'		=> 0
						);
					}

					$json = json_encode($shorts);
					if(file_put_contents('shorts.json', $json)) {
						$result = array(
							'short'		=> $short,
							'date'		=> $moment,
							'origin'	=> $this->url
						);
					} else {
						throw new Exception('Error storing shortened URL');
					}
				} else {
					throw new Exception("Invalid Connection Type");
				}
			} catch (Exception $e) {
				return ((object) array('status' => 'error', 'data' => $e->getMessage()));
			}

			return (object) $result;
		}

		function open($short) {
			$result = array();

			try {
				if($this->type == 'mysql') {
					try {
					  	$conn = new PDO($this->database['drive'].':host='.$this->database['host'].';dbname='.$this->database['name'], $this->database['user'], $this->database['password']);
					    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

					    $code = $conn->prepare("SELECT cd_short, ds_origin, qt_open FROM tb_short WHERE ds_short = :short");
					    $code->bindParam(':short', $short);
					    $code->execute();
					    $infosShort = $code->fetch(PDO::FETCH_ASSOC);

					    if(!$infosShort) {
					    	throw new Exception('URL not found');
					    } else {
					    	$infosShort['qt_open'] ++;
					    	$code = $conn->prepare("UPDATE tb_short SET qt_open = :count WHERE cd_short = :code");
					    	$code->bindParam(':code', ($infosShort['cd_short']));
					    	$code->bindParam(':count', ($infosShort['qt_open']));
					    	$code->execute();

					    	if($this->redirect) {
								header("Location: " . $infosShort['ds_origin']);
							} else {
								$result['url'] = $infosShort['ds_origin'];
							}
					    }
					} catch(PDOException $e) {
						throw new Exception($e->getMessage());
					}
				} elseif($this->type == 'json') {
					if(file_exists('shorts.json')) {
						$shorts = (array) json_decode(file_get_contents('shorts.json'));
					} else {
						throw new Exception('No URL found');
					}

					if(isset($shorts[$short])) {
						$shorts[$short]->count ++;

						$json = json_encode($shorts);
						if(file_put_contents('shorts.json', $json)) {
							if($this->redirect) {
								header("Location: " . $shorts[$short]->origin);
							} else {
								$result['url'] = $shorts[$short]->origin;
							}
						} else {
							throw new Exception("Error storing quantity");
						}
					} else {
						throw new Exception("URL not found");
					}
				} else {
					throw new Exception("Invalid Connection Type");
				}
			} catch (Exception $e) {
				return ((object) array('status' => 'error', 'data' => $e->getMessage()));
			}

			return (object) $result;
		}

		function infos($short) {
			$result = array();

			try {
				if($this->type == 'mysql') {
					try {
					  	$conn = new PDO($this->database['drive'].':host='.$this->database['host'].';dbname='.$this->database['name'], $this->database['user'], $this->database['password']);
					    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

					    $code = $conn->prepare("SELECT ds_short AS short, ds_origin AS origin, qt_open AS count, dt_short AS date FROM tb_short WHERE ds_short = :short");
					    $code->bindParam(':short', $short);
					    $code->execute();
					    $infosShort = $code->fetch(PDO::FETCH_ASSOC);

					    if(!$infosShort) {
					    	throw new Exception('URL not found');
					    } else {
					    	$infosShort['count'] = intval($infosShort['count']);
					    	$result = (object) $infosShort;
					    }
					} catch(PDOException $e) {
						throw new Exception($e->getMessage());
					}
				} elseif($this->type == 'json') {
					if(file_exists('shorts.json')) {
						$shorts = (array) json_decode(file_get_contents('shorts.json'));
						if(isset($shorts[$short])) {
							$result = $shorts[$short];
						} else {
							throw new Exception("URL not found");
						}
					} else {
						throw new Exception('No URL found');
					}
				} else {
					throw new Exception("Invalid Connection Type");
				}
			} catch (Exception $e) {
				return ((object) array('status' => 'error', 'data' => $e->getMessage()));
			}

			return $result;
		}

		function clear($url) {
			$split = explode('/',$url);
			return end($split);
		}
	}
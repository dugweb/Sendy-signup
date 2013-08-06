<?php
function dd($var) {
	echo "<pre>";
	var_dump($var);
	echo "</pre>";
	return;
}

/*________________________________________ 
 |
 | Subscribe Email to Sendy installation
 | ---------------------------------------
*/
class SubmitEmail {
	
	var $ouput;
	var $url = "http://www.thedealio.org/sendy/subscribe"; // Sendy install url
	var $list = ''; // List hash
	var $postOptions;
	var $sendyparams;

	function SubmitEmail($args) {
		$this->sendyparams = 
			http_build_query(
				array(
					'name'	=> $args['name'],
					'email'	=> $args['email'],
					'list'	=> $this->list,
					'boolean' => 'true'
				)
			);

		$this->postOptions = array(
				'http' => array(
						'method' => 'POST',
						'header' => 'Content-type: application/x-www-form-urlencoded',
						'content' => $this->sendyparams
					)
			);
	}

	function pushEmail() {
		
		$context = stream_context_create($this->postOptions);
		$result = file_get_contents($this->url, false, $context);

		$resultcode = 4;

		switch ($result) {
			case "1":
				$resultcode = 1;
				break;
			case "Already subscribed.":
				$resultcode = 2;
				break;
			case "Invalid email address.":
				$resultcode = 3;
				break;
			default:
				break;
		}

		return $resultcode;
	}
}

if (isset($_POST['email']) && isset($_POST['name'])) { 
	$submitEmail = new SubmitEmail(array(
		'name' => $_POST['name'],
		'email' => $_POST['email']
	));
	
	$result = $submitEmail->pushEmail();

	$resulturl = "results.php?msg=";
	
	header("Location: " . $resulturl . $result);

} else {
	header("Location: results.php?msg=jdst");
}
?>
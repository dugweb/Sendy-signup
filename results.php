<?php

// Messages
// 1- Successfully inserted email (1)
// 2- "Already subscribed."
// 3- "Invalid email address."
// 4- Some other error

if (isset($_GET['msg'])) {
	switch ($_GET['msg']) {
		case "1":
			echo "successfully signed up";
			break;
		case "2":
			echo "You're already on our list";
			break;
		case "3":
			echo "The email address you entered is invalid";
			break;
		default: 
			echo "something went wrong, judist";
			break;
	}
}
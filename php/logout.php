<?php
	require_once 'utils.php';
	if(isset($_POST['csrf_token']) && validateToken($_POST['csrf_token'])) {
		session_destroy();
		echo 0;
	}
	else {
		echo 1;
	}

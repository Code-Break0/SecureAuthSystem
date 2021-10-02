<?php
	require_once 'utils.php';


	if(isset($_POST['csrf_token']) && validateToken($_POST['csrf_token'])) {
		if(isset($_SESSION['loggedin']) && isset($_SESSION['userID']) && $_SESSION['loggedin'] === true) {
			$C = connect();
			if($C) {
				if(sqlUpdate($C, 'DELETE FROM users WHERE id=?', 'i', $_SESSION['userID'])) {
					sqlUpdate($C, 'DELETE FROM requests WHERE user=?', 'i', $_SESSION['userID']);
					sqlUpdate($C, 'DELETE FROM loginattempts WHERE user=?', 'i', $_SESSION['userID']);
					session_destroy();
					echo 0;
				}
				else {
					echo 1;
				}
				$C->close();
			}
			else {
				echo 2;
			}
		}
		else {
			echo 3;
		}
	}
	else {
		echo 4;
	}


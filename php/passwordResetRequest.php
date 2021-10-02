<?php
	require_once 'utils.php';

	// Validate post variables & CSRF token
	if(!empty($_POST['email'])) {
		if(!empty($_POST['csrf_token']) && validateToken($_POST['csrf_token'])) {
			// Connect to database
			$C = connect();
			if($C) {
				// Select id & name from users database and count requests
				$dayago = time() - 60 * 60 * 24;
				$res = sqlSelect($C, 'SELECT users.id,name,COUNT(requests.id) FROM users LEFT JOIN requests ON users.id = user AND type=1 AND timestamp>? WHERE email=? GROUP BY users.id', 'is', $dayago, $_POST['email']);
				if($res && $res->num_rows === 1) {
					$user = $res->fetch_assoc();

					// Check if # of requests per day is valid
					if($user['COUNT(requests.id)'] < MAX_PASSWORD_RESET_REQUESTS_PER_DAY) {
						// create code & insert into requests database
						$code = random_bytes(32); # 256 bit code 
						$hash = password_hash($code, PASSWORD_DEFAULT);
						$insertID = sqlInsert($C, 'INSERT INTO requests VALUES (NULL, ?, ?, ?, 1)', 'isi', $user['id'], $hash, time());
						if($insertID !== -1) {
							// Send email with link to user
							$msg = '<a href="'. RESET_PASSWORD_ENDPOINT . '/' . $insertID . '/' . urlSafeEncode($code) .'">Click Here to Reset your Password</a>';
							if(sendEmail($_POST['email'], $user['name'], 'Password Reset', $msg)) {
								// echo 'An email has been sent if an account with that email exists';
								echo 0;
							}
							else {
								// echo 'Failed to send email';
								echo 1;
							}
						}
						else {
							// echo 'Failed to create request in database';
							echo 2;
						}
					}
					else {
						// echo 'Too many requests in the last 24 hours... try again later';
						echo 3;
					}

					$res->free_result();
				}
				else {
					// echo 'An email has been sent if an account with that email exists';
					echo 0;
				}
				$C->close();
			}
			else {
				// echo 'Failed to connect to database';
				echo 4;
			}
		}
		else {
			// echo 'Invalid CSRF token';
			echo 5;
		}
	}
	else {
		// echo 'You must enter an email';
		echo 6;
	}
	
	
	
	
	

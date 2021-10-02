<?php
	require_once 'utils.php';

	function sendValidationEmail($email) {
		$C = connect();
		if($C) {
			$oneDayAgo = time() - 60 * 60 * 24;
			$res = sqlSelect($C, 'SELECT users.id,name,verified,COUNT(requests.id) FROM users LEFT JOIN requests ON users.id = requests.user AND type=0 AND timestamp>? WHERE email=? GROUP BY users.id ', 'is', $oneDayAgo, $email);
			if($res && $res->num_rows === 1) {
				$user = $res->fetch_assoc();
				if($user['verified'] === 0) {
					if($user['COUNT(requests.id)'] <= MAX_EMAIL_VERIFICATION_REQUESTS_PER_DAY) {
						//Send validation request
						$verifyCode = random_bytes(32);
						$hash = password_hash($verifyCode, PASSWORD_DEFAULT);
						$requestID = sqlInsert($C, 'INSERT INTO requests VALUES (NULL, ?, ?, ?, 0)', 'isi', $user['id'], $hash, time());
						if($requestID !== -1) {
							if(sendEmail($email, $user['name'], 'Email Verification', '<a href="' . VALIDATE_EMAIL_ENDPOINT . '/' . $requestID . '/' . urlSafeEncode($verifyCode). '" />Click this link to verify your email</a>')) {
								return 0;
							}
							else {
								// return 'failed to send email';
								return 1;
							}
						}
						else {
							// return 'failed to insert request';
							return 2;
						}
					}
					else {
						return 3;
					}
				}
				else {
					return 4;
				}
				$res->free_result();
			}
			else {
				return 5;
			}
			$C->close();
		}
		else {
			return 6;
		}
		return -1;
	}
	

	if(isset($_POST['validateEmail']) && isset($_POST['csrf_token']) && validateToken($_POST['csrf_token'])) {
		echo sendValidationEmail($_POST['validateEmail']);
	}

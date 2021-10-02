<?php
	require_once 'utils.php';


	// Validate post variables & CSRF token
	$errors = [];

	if(empty($_POST['id'])) {
		// $errors[] = 'No ID';
		$errors[] = 1;
	}
	if(empty($_POST['hash'])) {
		// $errors[] = 'No hash';
		$errors[] = 2;
	}
	if(!isset($_POST['password']) || !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\~?!@#\$%\^&\*])(?=.{8,})/', $_POST['password'])) {
		// $errors[] = 'Password must have upper & lower letters + at least one number + at least one symbol and be 8 or more chars long';
		$errors[] = 3;
	}
	else if(!isset($_POST['confirm-password']) || $_POST['confirm-password'] !== $_POST['password']) {
		// $errors[] = 'Passwords do not match';
		$errors[] = 4;
	}

	if(count($errors) === 0) {
		if(isset($_POST['csrf_token']) && validateToken($_POST['csrf_token'])) {
			// Connect to Database
			$C = connect();
			if($C) {
				// Get user, hash, & timestamp from requests
				$res = sqlSelect($C, 'SELECT user,hash,timestamp FROM requests WHERE id=? LIMIT 1', 'i', $_POST['id']);
				if($res && $res->num_rows === 1) {
					$request = $res->fetch_assoc();

					// password_verify hash
					if(password_verify(urlSafeDecode($_POST['hash']), $request['hash'])) {
						// check if request is expired
						if($request['timestamp'] >= time() - PASSWORD_RESET_REQUEST_EXPIRY_TIME) {
							// update password
							$hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
							if(sqlUpdate($C, 'UPDATE users SET password=? WHERE id=?', 'si', $hash, $request['user'])) {
								// delete all password reset requests for user
								sqlUpdate($C, 'DELETE FROM requests WHERE user=? AND type=1', 'i', $request['user']);
								$errors[] = 0;
							}
							else {
								// $errors[] = 'Failed to update password';
								$errors[] = 5;
							}
							
						}
						else {
							// $errors[] = 'This reset request has expired';
							$errors[] = 6;
						}
					}
					else {
						// $errors[] = 'Invalid password reset request';
						$errors[] = 7;
					}

					$res->free_result();
				}
				else {
					// $errors[] = 'Invalid password reset request';
					$errors[] = 7;
				}
				$C->close();
			}
			else {
				// $errors[] = 'Failed to connect to database';
				$errors[] = 8;
			}
		}
		else {
			// $errors[] = 'Invalid CSRF token';
			$errors[] = 9;
		}
	}

	echo json_encode($errors);
	
	
	
	


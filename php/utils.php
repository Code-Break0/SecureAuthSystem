<?php
	require_once 'config.php';


	function connect() {
		$C = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
		if($C->connect_error) {
			return false;
		}
		return $C;
	}



	function sqlSelect($C, $query, $format = false, ...$vars) {
		$stmt = $C->prepare($query);
		if($format) {
			$stmt->bind_param($format, ...$vars);
		}
		if($stmt->execute()) {
			$res = $stmt->get_result();
			$stmt->close();
			return $res;
		}
		$stmt->close();
		return false;
	}

	function sqlInsert($C, $query, $format = false, ...$vars) {
		$stmt = $C->prepare($query);
		if($format) {
			$stmt->bind_param($format, ...$vars);
		}
		if($stmt->execute()) {
			$id = $stmt->insert_id;
			$stmt->close();
			return $id;
		}
		$stmt->close();
		return -1;
	}
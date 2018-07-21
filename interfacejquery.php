<?php
if(!empty($_POST['action'])) {
	$db = @new MySQLi('localhost', 'root', '', 'vuemysql1');
	if($db->connect_error) {
		exit(json_encode([false, 'Connect error']));
	}
	if($_POST['action']=='retrieve_all') {
		$sql = "SELECT `car_id`, `brand`, `model`, `engine`, `gearbox` FROM `car`";
		$result = $db->query($sql);
		if($result) {
			if($result->num_rows===0) {
				// no row retrieved
				echo json_encode([false, 'no row retrieved']);
			} else {
				while($each_row = $result->fetch_assoc()) {
					$all_rows[] = $each_row;
				}
				echo json_encode([true, $all_rows]); 
			}
			$result ->free();
		} else {
			// sql query error
			echo json_encode([false, 'SQL Query error']);
		}
		$db->close();
	} elseif($_POST['action']=='delete_item') {
		if(!empty($_POST['car_id'])) {
			$_POST['car_id'] = $db->real_escape_string($_POST['car_id']);
			$sql = "DELETE FROM `car` WHERE `car_id` = '{$_POST['car_id']}' LIMIT 1";
			$result = $db->query($sql);
			if($result) {
				echo json_encode([true, 'delete successfull']);
			} else {
				echo json_encode([false, 'delete failed']);
			}
		} else {
			echo json_encode([false, 'need car id to delete...']);
		}
		$db->close();
	} elseif($_POST['action']=='create_item') {
		//Sanitize the data
		if(!empty($_POST['new_item'])) {
			if(!empty($_POST['new_item']['brand']) && !empty($_POST['new_item']['model']) && !empty($_POST['new_item']['engine']) && !empty($_POST['new_item']['gearbox'])) {
				// Chekc brand, model, engine and gearbox
				// translate engine and gearbox code...
				// echo ("Data to be checked");
				$brand = $db->real_escape_string($_POST['new_item']['brand']);
				$model = $db->real_escape_string($_POST['new_item']['model']);
				$engine = $db->real_escape_string($_POST['new_item']['engine']);
				$gearbox = $db->real_escape_string($_POST['new_item']['gearbox']);

				switch($engine) {
					case 1:
						$engine = "Petrol";
					break;
					case 2:
						$engine = "Diesel";
					break;
					case 3:
						$engine = "Electric";
					break;
					case 4:
						$engine = "Hybrid";
					break;
					case 5:
						$engine = "Hydrogen";
					break;
					default:
						$engine = false;
				}
				if($gearbox == 1) {
					$gearbox = "Automatic";
				} elseif($gearbox == 2) {
					$gearbox = "Manual";
				} else {
					$gearbox = false;
				}

				if($engine == false || $gearbox == false) {
					echo json_encode([false, 'data is not in right format']);
				} else {
					$sql = "INSERT INTO `car` SET `brand` = '{$brand}', `model` = '{$model}', `engine` = '{$engine}', `gearbox` = '{$gearbox}' ";
					$result = $db->query($sql);
					if($result) {
						echo json_encode([true, 'data was inserted successfully']);
					} else {
						echo json_encode([false, 'error when inserting into database...']);
					}
				}

			} else {
				echo json_encode([false, 'not all input fields are filled, cannot create new row']);
			}

		} else {
			echo json_encode([false, 'no data sent, cannot create new row...']);
		}
		$db->close();
	} elseif($_POST['action'] == 'update_item') {
		//  Update table row here
		//  check to see if all five fields are here
		// sanitize all five field values 
		// Same process as in create_item
		if(!empty($_POST['edited_item'])) {
			if(!empty($_POST['edited_item']['car_id']) && !empty($_POST['edited_item']['brand']) && !empty($_POST['edited_item']['model']) && !empty($_POST['edited_item']['engine']) && !empty($_POST['edited_item']['gearbox'])) {
				$car_id = $db->real_escape_string($_POST['edited_item']['car_id']);
				$brand = $db->real_escape_string($_POST['edited_item']['brand']);
				$model = $db->real_escape_string($_POST['edited_item']['model']);
				$engine = $db->real_escape_string($_POST['edited_item']['engine']);
				$gearbox = $db->real_escape_string($_POST['edited_item']['gearbox']); 
				$sql = "UPDATE `car` SET `brand` = '{$brand}', `model` = '{$model}', `engine` = '{$engine}', `gearbox` = '{$gearbox}' WHERE car_id = '{$car_id}' ";
				$result = $db->query($sql);
				if($result) {
					echo json_encode([true, 'Row was updated succesfully']);
				} else {
					echo json_encode([false, 'Query failed...']);
				}
			} else {
				echo json_encode([false, 'not all fields were filled, cannot update exisiting row...']);
			}
		} else {
			echo json_encode([false, 'no data sent, cannot create new row...']);
		}
		$db->close();
	}
} 
?>
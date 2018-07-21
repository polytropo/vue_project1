<?php
if(!empty($_POST['range'])) {
	if($_POST['range']=='all') {
		$db = new MySQLi('localhost', 'root', '', 'vuemysql1');
		if($db->connect_error) {
			exit(json_encode([false, 'Connect error']));
		}
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
	}
} 
?>
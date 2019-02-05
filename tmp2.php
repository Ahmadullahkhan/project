

<?php
	function get_by($table,$cols,$col_value){
		$name = "kaisar,mukhtiar,ahmad,hassam,harron";
		$query = "SELECT * FROM $table WHERE ";
		foreach($cols as $key => $key_value){
			$query .= $key ."=".$key_value."AND ";
		}
		explode(
	}


?>
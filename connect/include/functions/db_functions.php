<?php

function get_users($criteria=array()) {
	$id = $criteria['id'];
	$fb_user_id = $criteria['fb_user_id'];
	$login = $criteria['login'];
	$password = $criteria['password'];
	
	$u1 = new MySqlTable();
	$sql = "SELECT * FROM ".$GLOBALS['db_table']['users']." WHERE 1";
	
	if($id!='') $sql .= " AND id='".$u1->escape($id)."'";
	if($fb_user_id!='') $sql .= " AND fb_user_id='".$u1->escape($fb_user_id)."'";
	if($login!='') $sql .= " AND login='".$u1->escape($login)."'";
	if($password!='') $sql .= " AND password='".$u1->escape($password)."'";
	
	$result = $u1->customQuery($sql);
	
	if($GLOBALS['demo_mode']==1) {
		for($i=0; $i<count($result); $i++) {
			$result[$i]['first_name'] = 'Hidden in demo mode';
			$result[$i]['last_name'] = 'Hidden in demo mode';
			$result[$i]['email'] = 'Hidden in demo mode';
		}
	}
	
	return $result;
}

/*
START Default add/update functions
*/

function save_posted_data($data, $table_name) {
	
	$s1 = new MySqlTable();
	
	$fields='';
	$fields_values='';
	if(count($data)>0) {
		foreach($data as $ind => $value) {
			$fields .= $s1->escape($ind).',';
			$fields_values .= "'".$s1->escape($value)."',";
		}
	}
	
	$fields = substr($fields,0,-1);
	$fields_values = substr($fields_values,0,-1);
	
	$sql = "INSERT INTO $table_name ($fields) VALUES ($fields_values)";
	$s1->executeQuery($sql);
	$result = mysqli_insert_id($s1->link);
	
	return $result;
}

function update_posted_data($data, $id, $table_name) {
	
	$s1 = new MySqlTable();
	
	$fields='';
	if(count($data)>0) {
		foreach($data as $ind => $value) {
			$fields .= $s1->escape($ind)."='".$s1->escape($value)."',";
		}
	}
	
	$fields = substr($fields,0,-1);
	$fields_values = substr($fields_values,0,-1);
	
	$sql = "UPDATE $table_name SET $fields WHERE id='".$s1->escape($id)."'";
	
	$s1->executeQuery($sql);
}

?>
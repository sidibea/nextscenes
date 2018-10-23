<?php
class DBController {
	private $host = "og21315-001.privatesql";
	private $user = "nextscendidb";
	private $password = "Sidere852";
	private $database = "nextscendidb";
	private $conn;
	
	function __construct() {
		$this->conn = $this->connectDB();
		$this->conn->set_charset("utf8");
	}
	
	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database,35357);
		return $conn;
	}
	
	function runQuery($query) {
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
}
?>
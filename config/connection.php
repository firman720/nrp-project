<?php
//This script to connect to database
class Connection{
	public function get_connection(){
	    $host     = "localhost";     // your server
	    $database = "autonumber";  // your db name
	    $username = "root";          // username of phpmyadmin
	    $password = "";              // password of phpmyadmin
	    $connect  = new mysqli($host, $username, $password, $database);
	    return $connect;
	 }

	//Construct
    public function __construct(){
          $this->conn = $this->get_connection();
    }

	public function real_escape($val){
		return $this->conn->real_escape_string($val);
	}

	//To Generate date system If needed
	public function date_sistem($var){
		$date = date('Y-m-d', strtotime($var));
		return $date;
	}

	public function base_url(){
		return "http://localhost/nrp/";
	}

}
?>

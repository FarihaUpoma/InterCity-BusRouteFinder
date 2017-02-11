<?php
$servername = "localhost";
$username = "root";
$password = "root";
$db = "Route_finder";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE $db";
$conn->query($sql); //ignore if database already exist

// update connection
$conn = new mysqli($servername, $username, $password, $db);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

// create vehicle table
$sql = "CREATE TABLE Vehicle (
		name VARCHAR(50) NOT NULL,
		src VARCHAR(50) NOT NULL,
		des VARCHAR(50) NOT NULL,
		start_time VARCHAR(50),
		arrival_time VARCHAR(50),
		cost DOUBLE,
		distance DOUBLE,
		CONSTRAINT pk_vehicle PRIMARY KEY (name, src, des)
		)";

//echo $sql . "</br>";
if($conn->query($sql) == FALSE){
	//echo("DB CREATE Vehicle Vehicle FAIL");
}

//Drop table
// $sql = "Drop TABLE Vehicle";
// if($conn->query($sql) == FALSE){
// 	echo("DROP Vehicle FAIL");
// }


function runSql($sql){
	global $conn;
	//echo $sql;
	if ($conn->query($sql) === TRUE) {
	    echo "sql run successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}
	//echo "DONE";
}

function find_vehicles($src){
	global $conn;
	$sql = "SELECT * FROM Vehicle Where src = '$src' ORDER BY distance DESC";
	//echo $sql . "</br>";
	$result = $conn->query($sql);
	//echo $result->num_rows;
	
	if ($result->num_rows > 0) {
		return convert($result);
	} else {
		//echo "Error: " . $sql . "<br>" . $conn->error;
		return false;
	}
}

function convert($result)
{
	$ret = array();
	while($row = $result->fetch_assoc()) {
		array_push($ret, $row);
		//print_r($row);
	}
	return $ret;
}



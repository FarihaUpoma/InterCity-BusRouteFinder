<?php
include_once 'db.php';

class Vehicle{
	public $name, $src, $des, $start_time, $arrival_time, $cost, $distance;

	public function __construct($name, $src, $des, $start_time, $arrival_time, $cost, $distance){
		$this->name = $name;
		$this->src = $src;
		$this->des = $des;
		$this->start_time = $start_time;
		$this->arrival_time = $arrival_time;
		$this->cost = $cost;
		$this->distance = $distance;
		$this->insertVehicle();
	}

	private function insertVehicle() {
		$sql = "INSERT INTO Vehicle (name, src, des, start_time, arrival_time, cost, distance)
		VALUES ('$this->name', '$this->src', '$this->des', '$this->start_time',
		'$this->arrival_time', $this->cost, $this->distance)";
		
		//echo $sql;
		
		runSql($sql);
	}
}

$vehicle = new Vehicle($_POST["name"], $_POST["src"], $_POST["des"], $_POST["start_time"], $_POST["arrival_time"], 
		$_POST["cost"], $_POST["distance"]);

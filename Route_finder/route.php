<?php

include_once 'db.php';

class Route{
	public $src, $end, $src_time, $tot_time=0, $distance=0, $cost=0;
	public $vehicle = [];
	public $path = [];
	
	public function __construct($start, $end, $time){
		$this->src = $start;
		$this->end = $end;
		$this->src_time = $time;
	}
	
	public function  isvehicleUsed($vehicle){
		return isset($this->vehicle[$vehicle]);
	}
	
	public function usevehicle($vehicle) {
		$this->vehicle[$vehicle] = true;
		array_push($vehicle, $vehicle);
		
		
// 		$this->src = $vehicle->;
// 		$this->src_time = ;
	}
}


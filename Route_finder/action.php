<?php
session_start();
include_once 'db.php';

$route = new Route($_GET["source"], $_GET["destination"], $_GET["start_time"]);

$ret = find_route($route);
if($ret){
	$_SESSION["src"] = $_GET["source"];
	$_SESSION["des"] = $_GET["destination"];
	$_SESSION["start_time"] = $_GET["start_time"];
	$_SESSION["arrival_time"] = $ret["start_time"];
	
	print_r($ret);
	
	$_SESSION["result"] = json_encode($ret);
}
else{
	$_SESSION["result"] = json_encode(["fail" => "NO route found"]);
}

header("Location: http://localhost/Route_finder/view.php");
exit;


$conn->close();



function find_route($route){
	$q = new SplQueue();
	$q->push($route);
	$ret = array();
	$i=0;
	while(!$q->isEmpty()){
// 		$i++;
// 		if($i>2) break;
		$route = $q->top();
		$q->pop();
		
		
		if($route->src != $route->des){
			$vehicles = find_vehicles($route->src);
// 			print_r($vehicles);
// 			echo "</br>";
			
			$routes = addRoutes($route, $vehicles);
			
			foreach ($routes as $rut){
				$q->push($rut);
			}
		}
		else{
			array_push($ret, $route);
// 			echo "route found : ";
// 			$route->printVehicles();
// 			echo "</br>";
		}		
	}
	return $ret;
}

function addRoutes($route, $vehicles){
	$ret = array();
	foreach ($vehicles as $vcl){
		$tmpRoute = clone $route;
		if(!$tmpRoute->isVehicleUsed($vcl)){
			$tmpRoute->useVehicle($vcl);
			
			array_push($ret, $tmpRoute);
		}
	}
	//print_r($ret);
	return $ret;
}


class Route{
	public $src, $des, $src_time, $tot_time=0, $distance=0, $cost=0;
	public $vehicle_name = [];
	public $vehicle = [];

	public function __construct($start, $des, $time){
		$this->src = $start;
		$this->des = $des;
		$this->src_time = $time;
		//echo "start: " . $this->src . " destination: " . $this->des .  " time: " . $this->src_time . "</br>";
	}

	public function  isVehicleUsed($vcl){
		return isset($this->vehicle_name[$vcl["name"]]);
	}

	public function useVehicle($vcl) {
		$this->vehicle_name[$vcl["name"]] = true;
		array_push($this->vehicle, $vcl);
		$this->tot_time += $this->time_diff($this->src_time, $vcl["arrival_time"]);

		$this->src = $vcl["des"];
		$this->src_time = $vcl["start_time"];
		$this->distance += $vcl["distance"];
		$this->cost += $vcl["cost"];
	}
	
	private function time_diff($pres, $end){
		$pres = strtotime($pres);
		$end = strtotime($end);
		$diff = $end - $pres;
		if($diff < 0) return $diff + 24*3600;
		else $diff;
	}
	
	public function printVehicles() {
		echo "</br> </br> </br> printing result </br>";
// 		foreach ($this->vehicle_name as $key => $val){
// 			echo "$key </br>";
// 		}
		
		foreach ($this->vehicle as $vcl){
			print_r($vcl);
		}
		echo "</br> print vehicle finish </br>";
	}
}



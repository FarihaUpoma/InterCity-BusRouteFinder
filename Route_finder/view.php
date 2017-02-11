<!-- <html head> -->

<?php
session_start();

function convert_time($time){
	//echo $time;
	$ret = "";
	if($time / 86400 >= 1){
		$ret = $ret . $time / 86400 ." day ";
		$time %= 86400;
	}
	if($time / 3600 >= 1){
		$ret = $ret . $time / 3600 ." hour ";
		$time %= 3600;
	}
	if($time / 60 >= 1){
		$ret = $ret . $time / 60 ." minute ";
		$time %= 60;
	}
	//echo ": $ret </br>";

	return $ret;
}


$ret = json_decode($_SESSION["result"], true);
if(isset($ret["fail"])){
	echo $ret["fail"];
	unset($ret["fail"]);
}

?>

<?php foreach ($ret as $val){ ?>
	<p> Tot Time:  <?php echo convert_time($val["tot_time"]);  ?> </p>
	<p> Tot Cost: <?php echo $val["cost"]; ?> </p>
	<p> Tot Distance: <?php echo $val["distance"]; ?> </p>
	<?php foreach ($val["vehicle"] as $key => $vcl){?>
		
		<p> vechicle_num:  <?php echo $key+1;  ?> </p>
		<p> Name:  <?php echo $vcl["name"];  ?> </p>
		<p> Source:  <?php echo $vcl["src"];  ?> </p>
		<p> Destination:  <?php echo $vcl["des"];  ?> </p>
		<p> Start Time:  <?php echo $vcl["start_time"];  ?> </p>
		<p> Arrival Time:  <?php echo $vcl["arrival_time"];  ?> </p>
		<p> Cost:  <?php echo $vcl["cost"];  ?> </p>
		<p> Distance:  <?php echo $vcl["distance"];  ?> </p>
	<?php }?>
<?php } ?>

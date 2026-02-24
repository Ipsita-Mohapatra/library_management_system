<?php
session_start();

include("data_class.php");

$userid = isset($_GET['userid']) ? intval($_GET['userid']) : 0;
$bookid = isset($_GET['bookid']) ? intval($_GET['bookid']) : 0;

if($userid <= 0 || $bookid <= 0){
	header("Location:otheruser_dashboard.php?userlogid={$userid}&msg=Invalid+request");
	exit();
}

$obj = new data();
$obj->setconnection();
$obj->requestbook($userid,$bookid);

?>
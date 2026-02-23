<?php

include("data_class.php");

// Validate POST data
if(empty($_POST['book']) || empty($_POST['userselect']) || empty($_POST['days'])){
    header("Location: admin_service_dashboard.php?msg=Missing required fields");
    exit();
}

$book = trim($_POST['book']);
$userselect = trim($_POST['userselect']);
$days = trim($_POST['days']);
$getdate = date("d/m/Y");

// Validate days is numeric
if(!is_numeric($days) || $days <= 0){
    header("Location: admin_service_dashboard.php?msg=Invalid days value");
    exit();
}

$returnDate = Date('d/m/Y', strtotime('+'.$days.' days'));

try {
    $obj = new data();
    $obj->setconnection();
    $obj->issuebook($book, $userselect, $days, $getdate, $returnDate);
} catch(Exception $e) {
    header("Location: admin_service_dashboard.php?msg=Issue: " . urlencode($e->getMessage()));
    exit();
}


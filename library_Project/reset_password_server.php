<?php
include("data_class.php");

// Accept POST: email, newpass, role
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$newpass = isset($_POST['newpass']) ? trim($_POST['newpass']) : '';
$role = isset($_POST['role']) && $_POST['role']==='admin' ? 'admin' : 'user';

if(empty($email) || empty($newpass)){
    if($role === 'admin') header("Location:admin-login.php?msg=All+fields+are+required");
    else header("Location:student-login.php?msg=All+fields+are+required");
    exit();
}

$obj = new data();
$obj->setconnection();
$obj->resetPassword($email, $newpass, $role);

?>
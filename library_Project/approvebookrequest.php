<?php
session_start();

include("data_class.php");

// Handle POST approval (from approve_request_form.php)
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $request = isset($_POST['reqid']) ? intval($_POST['reqid']) : 0;
    $book = '';
    if(isset($_POST['bookid']) && intval($_POST['bookid'])>0){
        $book = intval($_POST['bookid']);
    } else {
        $book = isset($_POST['book']) ? trim($_POST['book']) : '';
    }
    $userselect = isset($_POST['userselect']) ? trim($_POST['userselect']) : '';
    $days = isset($_POST['days']) ? intval($_POST['days']) : 0;
    $proof_type = isset($_POST['proof_type']) ? trim($_POST['proof_type']) : '';

    if($request <= 0 || empty($book) || empty($userselect) || $days <= 0 || empty($proof_type)){
        header("Location:admin_service_dashboard.php?msg=Please+provide+valid+proof+before+approving");
        exit();
    }

    // optional file upload
    if(isset($_FILES['proof_file']) && $_FILES['proof_file']['error'] === UPLOAD_ERR_OK){
        $uploadDir = __DIR__ . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'proofs';
        if(!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
        $orig = $_FILES['proof_file']['name'];
        $ext = pathinfo($orig, PATHINFO_EXTENSION);
        $safe = 'proof_' . $request . '_' . time() . '.' . $ext;
        $target = $uploadDir . DIRECTORY_SEPARATOR . $safe;
        move_uploaded_file($_FILES['proof_file']['tmp_name'], $target);
    }

    $getdate = date("d/m/Y");
    $returnDate = date('d/m/Y', strtotime('+'. $days .' days'));

    $obj = new data();
    $obj->setconnection();
    $obj->issuebookapprove($book, $userselect, $days, $getdate, $returnDate, $request);
    exit();
}

// For GET requests redirect to the approval form (to collect proof)
$reqid = isset($_GET['reqid']) ? intval($_GET['reqid']) : 0;
if($reqid <= 0){
    header("Location:admin_service_dashboard.php?msg=fail");
    exit();
}
header("Location:approve_request_form.php?reqid={$reqid}");
exit();

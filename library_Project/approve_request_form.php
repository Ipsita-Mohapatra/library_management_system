<?php
include("data_class.php");

$reqid = isset($_GET['reqid']) ? intval($_GET['reqid']) : 0;
if($reqid <= 0){
    header("Location:admin_service_dashboard.php?msg=fail");
    exit();
}

$obj = new data();
$obj->setconnection();

// fetch request details via data class method
$request = $obj->getRequestById($reqid);
if(!$request){
    header("Location:admin_service_dashboard.php?msg=fail");
    exit();
}

// sanitize display values
$bookname = htmlspecialchars($request['bookname']);
$username = htmlspecialchars($request['username']);
$usertype = htmlspecialchars($request['usertype']);
$issuedays = intval($request['issuedays']);
$bookid = intval($request['bookid']);

?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Approve Request</title>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
<style>
body{background:#071033;color:#e6eef8;font-family:Arial,Helvetica,sans-serif;padding:2rem}
.card{background:linear-gradient(180deg,#0f172a,#061025);border:1px solid rgba(255,255,255,0.04);padding:1.5rem;border-radius:8px;max-width:760px;margin:0 auto}
.label{color:#9aa7bf}
.note{font-size:.9rem;color:#94a3b8}
</style>
</head>
<body>
<div class="card">
    <h3>Approve Book Request</h3>
    <p class="note">Admin must collect valid proof before approving. If the student later fails to return books, they will be blocked from exams/TC/admissions until fines/returns are cleared.</p>
    <hr />
    <dl class="row">
      <dt class="col-sm-3 label">Student</dt>
      <dd class="col-sm-9"><?php echo $username; ?></dd>

      <dt class="col-sm-3 label">Type</dt>
      <dd class="col-sm-9"><?php echo $usertype; ?></dd>

      <dt class="col-sm-3 label">Book</dt>
      <dd class="col-sm-9"><?php echo $bookname; ?></dd>

      <dt class="col-sm-3 label">Requested Days</dt>
      <dd class="col-sm-9"><?php echo $issuedays; ?></dd>
    </dl>

    <form action="approvebookrequest.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="reqid" value="<?php echo $reqid; ?>">
        <input type="hidden" name="book" value="<?php echo htmlspecialchars($bookname, ENT_QUOTES); ?>">
        <input type="hidden" name="bookid" value="<?php echo $bookid; ?>">
        <input type="hidden" name="userselect" value="<?php echo htmlspecialchars($username, ENT_QUOTES); ?>">
        <input type="hidden" name="days" value="<?php echo $issuedays; ?>">

        <div class="form-group">
            <label class="label">Proof type (select)</label>
            <select name="proof_type" class="form-control" required>
                <option value="">-- Select proof collected --</option>
                <option value="id_card">Government ID / Student ID</option>
                <option value="guardian_signature">Guardian signature</option>
                <option value="fee_receipt">Security deposit / Fee receipt</option>
                <option value="other">Other (note below)</option>
            </select>
        </div>

        <div class="form-group">
            <label class="label">Proof file (optional but recommended)</label>
            <input type="file" name="proof_file" class="form-control-file" accept="image/*,application/pdf">
            <small class="note">Upload ID scan or signed receipt (jpg/png/pdf).</small>
        </div>

        <div class="form-group">
            <label class="label">Notes</label>
            <textarea name="notes" class="form-control" rows="3" placeholder="Optional notes about collected proof"></textarea>
        </div>

        <div style="display:flex;gap:.5rem">
            <button type="submit" class="btn btn-primary">Confirm & Approve</button>
            <a href="admin_service_dashboard.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
</body>
</html>
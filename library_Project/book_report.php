<?php
session_start();

// Determine the current user id: prefer GET, fall back to session
$userloginid = 0;
if (isset($_GET['userlogid']) && is_numeric($_GET['userlogid'])) {
    $userloginid = intval($_GET['userlogid']);
    $_SESSION['userid'] = $userloginid;
} elseif (!empty($_SESSION['userid'])) {
    $userloginid = intval($_SESSION['userid']);
} else {
    // No user id available - redirect to login
    header("Location: student-login.php?msg=Please+login");
    exit();
}

include("data_class.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Book Report - Library Management</title>
        <meta name="description" content="Book Report - Library Management System">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="student-dashboard.css">
        <link rel="stylesheet" href="advanced-animations.css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    <body class="dashboard-page">
    <!-- NAVBAR -->
    <div class="navbar-student">
        <div class="navbar-brand">
            <img src="images/logo1.png" alt="Library" class="nav-logo" />
            <span class="brand-text">Book Report</span>
        </div>
        <a href="otheruser_dashboard.php?userlogid=<?php echo $userloginid; ?>" class="navbar-logout">BACK</a>
    </div>

    <!-- SIDEBAR -->
    <nav class="sidebar">
        <ul class="sidebar-nav">
            <li class="sidebar-nav-item">
                <a href="otheruser_dashboard.php?userlogid=<?php echo $userloginid; ?>" class="sidebar-btn">
                    <img src="images/icon/profile.png" alt="Dashboard"/> Dashboard
                </a>
            </li>
            <li class="sidebar-nav-item">
                <button class="sidebar-btn active">
                    <img src="images/icon/monitoring.png" alt="Book Report"/> Book Report
                </button>
            </li>
        </ul>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="main-content">   
        <!-- BOOK REPORT SECTION -->
        <div class="content-section active">
            <h2 class="section-title">📖 My Book Report</h2>
            
            <?php
            $u = new data;
            $u->setconnection();
            $records = $u->getissuebook($userloginid);

            if(!empty($records) && count($records) > 0) {
                $table = "<div class='table-responsive'><table><thead><tr><th>Book Name</th><th>Type</th><th>Issue Date</th><th>Return Date</th><th>Fine</th><th>Action</th></tr></thead><tbody>";

                foreach($records as $row){
                    $table .= "<tr>";
                    $table .= "<td><strong>".(isset($row['issuebook']) ? $row['issuebook'] : $row[3])."</strong></td>";
                    $table .= "<td><span class='tag-type'>".(isset($row['issuetype']) ? $row['issuetype'] : $row[4])."</span></td>";
                    $table .= "<td>".(isset($row['issuedate']) ? $row['issuedate'] : $row[6])."</td>";
                    $table .= "<td>".(isset($row['issuereturn']) ? $row['issuereturn'] : $row[7])."</td>";
                    $table .= "<td><span class='fine-badge'>".(isset($row['fine']) ? $row['fine'] : $row[8])."</span></td>";
                    $table .= "<td><a href='otheruser_dashboard.php?returnid=".$row['id']."&userlogid=".$userloginid."'><button type='button' class='btn-action'>Return Book</button></a></td>";
                    $table .= "</tr>";
                }
                
                $table .= "</tbody></table></div>";

                echo $table;
            } else {
                echo "<div class='empty-state'>";
                echo "<p>No books currently issued.</p>";
                echo "</div>";
            }
            ?>
        </div>

        <!-- RETURN CONFIRMATION SECTION -->
        <?php if(!empty($_REQUEST['returnid'])) { ?>
        <div class="content-section active" style="margin-top: 2rem;">
            <div class="success-box">
                <p class="success-text">✅ Book returned successfully!</p>
                <a href="book_report.php?userlogid=<?php echo $userloginid; ?>" class="mt-link">
                    <button type="button" class="btn-action">View Updated Report</button>
                </a>
            </div>
        </div>
        <?php } ?>
    </main>

    <!-- Three.js Canvas -->
    <canvas id="canvas-3d-dashboard"></canvas>
    <script src="animations.js"></script>
</body>
</html>

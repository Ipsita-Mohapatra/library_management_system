<?php
session_start();

$userloginid = $_SESSION["userid"] = $_GET['userlogid'];
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
            $u->getissuebook($userloginid);
            $recordset = $u->getissuebook($userloginid);

            if(count($recordset) > 0) {
                $table = "<div class='table-responsive'><table><thead><tr><th>Book Name</th><th>Branch</th><th>Issue Date</th><th>Return Date</th><th>Fine</th><th>Action</th></tr></thead><tbody>";

                foreach($recordset as $row){
                    $table .= "<tr>";
                    $table .= "<td><strong>".$row[2]."</strong></td>";
                    $table .= "<td><span style='background: rgba(129, 140, 248, 0.2); color: #818cf8; padding: 0.3rem 0.6rem; border-radius: 6px; font-size: 0.8rem; font-weight: 600;'>".$row[8]."</span></td>";
                    $table .= "<td>".$row[3]."</td>";
                    $table .= "<td>".$row[6]."</td>";
                    $table .= "<td><span class='badge' style='background: rgba(248, 113, 113, 0.2); color: #fca5a5;'>".$row[7]."</span></td>";
                    $table .= "<td><a href='otheruser_dashboard.php?returnid=".$row[0]."&userlogid=".$userloginid."'><button type='button' class='btn-action'>Return Book</button></a></td>";
                    $table .= "</tr>";
                }
                }
                $table .= "</tbody></table></div>";

                echo $table;
            } else {
                echo "<div style='padding: 2rem; text-align: center; color: var(--text-secondary);'>";
                echo "<p style='font-size: 1.1rem;'>No books currently issued.</p>";
                echo "</div>";
            }
            ?>
        </div>

        <!-- RETURN CONFIRMATION SECTION -->
        <?php if(!empty($_REQUEST['returnid'])) { ?>
        <div class="content-section active" style="margin-top: 2rem;">
            <div style="padding: 2rem; text-align: center; background: rgba(34, 197, 94, 0.1); border-radius: 12px; border: 1px solid rgba(34, 197, 94, 0.3);">
                <p style="font-size: 1.2rem; color: #86efac; font-weight: 600;">✅ Book returned successfully!</p>
                <a href="book_report.php?userlogid=<?php echo $userloginid; ?>" style="margin-top: 1rem; display: inline-block;">
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

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
        <title>Student Portal - Library Management</title>
        <meta name="description" content="Student Dashboard - Library Management System">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="student-dashboard.css">
        <link rel="stylesheet" href="advanced-animations.css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    <body class="dashboard-page">
    <body>
    <!-- NAVBAR -->
    <div class="navbar-student">
        <div class="navbar-brand">
            <img src="images/logo1.png" alt="Library" class="nav-logo" />
            <span class="brand-text">Student Portal</span>
        </div>
        <a href="index.php" class="navbar-logout">LOGOUT</a>
    </div>

    <!-- SIDEBAR -->
    <nav class="sidebar">
        <ul class="sidebar-nav">
            <li class="sidebar-nav-item">
                <button class="sidebar-btn" onclick="openpart('myaccount')">
                    <img src="images/icon/profile.png" alt="My Account"/> My Account
                </button>
            </li>
            <li class="sidebar-nav-item">
                <button class="sidebar-btn" onclick="openpart('requestbook')">
                    <img src="images/icon/book.png" alt="Request Book"/> Request Book
                </button>
            </li>
            <li class="sidebar-nav-item">
                <a href="book_report.php?userlogid=<?php echo $userloginid; ?>" class="sidebar-btn">
                    <img src="images/icon/monitoring.png" alt="Book Report"/> Book Report
                </a>
            </li>
        </ul>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="main-content">   
        <!-- MY ACCOUNT SECTION -->
        <div id="myaccount" class="content-section active">
            <h2 class="section-title">My Account</h2>
            <?php
            $u = new data;
            $u->setconnection();
            $u->userdetail($userloginid);
            $recordset = $u->userdetail($userloginid);
            foreach($recordset as $row){
                $id = $row[0];
                $name = $row[1];
                $email = $row[2];
                $pass = $row[3];
                $type = $row[4];
            }               
            ?>
            <div class="profile-card">
                <div class="profile-info">
                    <div class="profile-info-item">
                        <span class="profile-label">Name</span>
                        <span class="profile-value"><?php echo $name ?></span>
                    </div>
                    <div class="profile-info-item">
                        <span class="profile-label">Email</span>
                        <span class="profile-value"><?php echo $email ?></span>
                    </div>
                    <div class="profile-info-item">
                        <span class="profile-label">Account Type</span>
                        <span class="profile-value" style="text-transform: capitalize;"><?php echo $type ?></span>
                    </div>
                </div>
            </div>
        </div>


            



            <div class="rightinnerdiv">   
        <!-- REQUEST BOOK SECTION -->
        <div id="requestbook" class="content-section">
            <h2 class="section-title">Request Book</h2>
            <?php
            $u = new data;
            $u->setconnection();
            $u->getbookissue();
            $recordset = $u->getbookissue();

            $table = "<div class='table-responsive'><table><thead><tr><th>Book Image</th><th>Book Name</th><th>Author</th><th>Branch</th><th>Price</th><th>Action</th></tr></thead><tbody>";

            foreach($recordset as $row){
                $table .= "<tr>";
                $table .= "<td><img src='uploads/".$row[1]."' style='width: 60px; height: 80px; border-radius: 8px;'></td>";
                $table .= "<td>".$row[2]."</td>";
                $table .= "<td>".$row[4]."</td>";
                $table .= "<td>".$row[6]."</td>";
                $table .= "<td>".$row[7]."</td>";
                $table .= "<td><a href='requestbook.php?bookid=".$row[0]."&userid=".$userloginid."'><button type='button' class='btn-action'>Request</button></a></td>";
                $table .= "</tr>";
            }
            $table .= "</tbody></table></div>";

            echo $table;
            ?>
        </div>

    </main>


    <script>
        function openpart(portion) {
            // Hide all sections
            var sections = document.querySelectorAll('.content-section');
            sections.forEach(function(section) {
                section.classList.remove('active');
            });
            
            // Show the selected section
            var selectedSection = document.getElementById(portion);
            if (selectedSection) {
                selectedSection.classList.add('active');
            }
            
            // Update sidebar button active state
            var buttons = document.querySelectorAll('.sidebar-btn');
            buttons.forEach(function(btn) {
                btn.classList.remove('active');
            });
            
            event.target.closest('.sidebar-btn').classList.add('active');
        }
        
        // Set the default active button on page load
        window.addEventListener('load', function() {
            var accountBtn = document.querySelector('.sidebar-btn');
            if (accountBtn) {
                accountBtn.classList.add('active');
            }
        });
    </script>

    <!-- Three.js Canvas -->
    <canvas id="canvas-3d-dashboard"></canvas>
    <script src="animations.js"></script>
</body>
</html>
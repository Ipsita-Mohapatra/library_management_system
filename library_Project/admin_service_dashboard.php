<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Admin Dashboard</title>
        <meta name="description" content="Library Management System - Admin Dashboard">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet" href="admin-dashboard.css">
        <link rel="stylesheet" href="advanced-animations.css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    <body class="dashboard-page">

    <?php
    include("data_class.php");

    $msg = "";
    if(!empty($_REQUEST['msg'])){
        $msg = $_REQUEST['msg'];
    }

    if($msg == "done"){
        echo "<div class='alert alert-success' role='alert'>Successfully Done</div>";
    } elseif($msg == "fail"){
        echo "<div class='alert alert-danger' role='alert'>Failed</div>";
    }
    ?>

    <!-- NAVBAR -->
    <div class="navbar-admin">
        <div class="navbar-brand">
            <img src="images/logo1.png" alt="Library" class="nav-logo" />
            <span class="brand-text"></span>
        </div>
        <a href="index.php" class="navbar-logout">LOGOUT</a>
    </div>

    <!-- SIDEBAR -->
    <nav class="sidebar">
        <ul class="sidebar-nav">
            <li class="sidebar-nav-item">
                <button class="sidebar-btn" onclick="openpart('addbook')">
                    <img src="images/icon/book.png" alt="Add Book"/> ADD BOOK
                </button>
            </li>
            <li class="sidebar-nav-item">
                <button class="sidebar-btn" onclick="openpart('bookreport')">
                    <img src="images/icon/open-book.png" alt="Book Report"/> BOOK REPORT
                </button>
            </li>
            <li class="sidebar-nav-item">
                <button class="sidebar-btn" onclick="openpart('bookrequestapprove')">
                    <img src="images/icon/interview.png" alt="Book Requests"/> BOOK REQUESTS
                </button>
            </li>
            <li class="sidebar-nav-item">
                <button class="sidebar-btn" onclick="openpart('addperson')">
                    <img src="images/icon/add-user.png" alt="Add Student"/> ADD STUDENT
                </button>
            </li>
            <li class="sidebar-nav-item">
                <button class="sidebar-btn" onclick="openpart('studentrecord')">
                    <img src="images/icon/monitoring.png" alt="Student Report"/> STUDENT REPORT
                </button>
            </li>
            <li class="sidebar-nav-item">
                <button class="sidebar-btn" onclick="openpart('issuebook')">
                    <img src="images/icon/test.png" alt="Issue Book"/> ISSUE BOOK
                </button>
            </li>
            <li class="sidebar-nav-item">
                <button class="sidebar-btn" onclick="openpart('issuebookreport')">
                    <img src="images/icon/checklist.png" alt="Issue Report"/> ISSUE REPORT
                </button>
            </li>
        </ul>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="main-content">   
        <!-- BOOK REQUEST APPROVE SECTION -->
        <div id="bookrequestapprove" class="content-section">
            <h2 class="section-title">Book Request Approve</h2>
            <?php
            $u = new data;
            $u->setconnection();
            $u->requestbookdata();
            $recordset = $u->requestbookdata();

            $table = "<div class='table-responsive'><table><thead><tr><th>Person Name</th><th>Person Type</th><th>Book Name</th><th>Days</th><th>Action</th></tr></thead><tbody>";
            foreach($recordset as $row){
                $table .= "<tr>";
                $table .= "<td>".$row[0]."</td>";
                $table .= "<td>".$row[1]."</td>";
                $table .= "<td>".$row[2]."</td>";
                $table .= "<td>".$row[3]."</td>";
                $table .= "<td><a href='approvebookrequest.php?reqid=".$row[0]."&book=".$row[5]."&userselect=".$row[3]."&days=".$row[6]."'><button type='button' class='btn btn-primary'>Approve</button></a></td>";
                $table .= "</tr>";
            }
            $table .= "</tbody></table></div>";
            echo $table;
            ?>
        </div>

        <!-- ADD BOOK SECTION -->
        <div id="addbook" class="content-section active">
            <h2 class="section-title">Add New Book</h2>
            <form action="addbookserver_page.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="form-label">Book Name:</label>
                    <input type="text" name="bookname" class="form-control" required/>
                </div>
                <div class="form-group">
                    <label class="form-label">Detail:</label>
                    <input type="text" name="bookdetail" class="form-control" required/>
                </div>
                <div class="form-group">
                    <label class="form-label">Author:</label>
                    <input type="text" name="bookauthor" class="form-control" required/>
                </div>
                <div class="form-group">
                    <label class="form-label">Publication:</label>
                    <input type="text" name="bookpub" class="form-control" required/>
                </div>
                <div class="form-group">
                    <label class="form-label">Branch:</label>
                    <div class="radio-group">
                        <div>
                            <input type="radio" name="branch" value="other" id="branch-other"/>
                            <label for="branch-other">Other</label>
                        </div>
                        <div>
                            <input type="radio" name="branch" value="BSIT" id="branch-bsit"/>
                            <label for="branch-bsit">BSIT</label>
                        </div>
                        <div>
                            <input type="radio" name="branch" value="BSCS" id="branch-bscs"/>
                            <label for="branch-bscs">BSCS</label>
                        </div>
                        <div>
                            <input type="radio" name="branch" value="BSSE" id="branch-bsse"/>
                            <label for="branch-bsse">BSSE</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Price:</label>
                    <input type="number" name="bookprice" class="form-control" required/>
                </div>
                <div class="form-group">
                    <label class="form-label">Quantity:</label>
                    <input type="number" name="bookquantity" class="form-control" required/>
                </div>
                <div class="form-group">
                    <label class="form-label">Book Photo:</label>
                    <input type="file" name="bookphoto" class="form-control"/>
                </div>
                <input type="submit" value="SUBMIT" class="btn-submit"/>
            </form>
        </div>


        <!-- ADD PERSON SECTION -->
        <div id="addperson" class="content-section">
            <h2 class="section-title">Add Person</h2>
            <form action="addpersonserver_page.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="form-label">Name:</label>
                    <input type="text" name="addname" class="form-control" required/>
                </div>
                <div class="form-group">
                    <label class="form-label">Password:</label>
                    <input type="password" name="addpass" class="form-control" required/>
                </div>
                <div class="form-group">
                    <label class="form-label">Email:</label>
                    <input type="email" name="addemail" class="form-control" required/>
                </div>
                <div class="form-group">
                    <label class="form-label">Choose Type:</label>
                    <select name="type" class="form-control" required>
                        <option value="">Select Type</option>
                        <option value="student">Student</option>
                        <option value="teacher">Teacher</option>
                    </select>
                </div>
                <input type="submit" value="SUBMIT" class="btn-submit"/>
            </form>
        </div>

        <!-- STUDENT RECORD SECTION -->
        <div id="studentrecord" class="content-section">
            <h2 class="section-title">Student Record</h2>
            <?php
            $u = new data;
            $u->setconnection();
            $u->userdata();
            $recordset = $u->userdata();

            $table = "<div class='table-responsive'><table><thead><tr><th>Name</th><th>Email</th><th>Type</th></tr></thead><tbody>";
            foreach($recordset as $row){
                $table .= "<tr>";
                $table .= "<td>".$row[1]."</td>";
                $table .= "<td>".$row[2]."</td>";
                $table .= "<td>".$row[4]."</td>";
                $table .= "</tr>";
            }
            $table .= "</tbody></table></div>";
            echo $table;
            ?>
        </div>

        <!-- ISSUE BOOK REPORT SECTION -->
        <div id="issuebookreport" class="content-section">
            <h2 class="section-title">Issue Book Record</h2>
            <?php
            $u = new data;    
            $u->setconnection();
            $u->issuereport();
            $recordset = $u->issuereport();

            $table = "<div class='table-responsive'><table><thead><tr><th>Issue Name</th><th>Book Name</th><th>Issue Date</th><th>Return Date</th><th>Fine</th><th>Issue Type</th></tr></thead><tbody>";

            foreach($recordset as $row){
                $table .= "<tr>";
                $table .= "<td>".$row[2]."</td>";
                $table .= "<td>".$row[3]."</td>";
                $table .= "<td>".$row[6]."</td>";
                $table .= "<td>".$row[7]."</td>";
                $table .= "<td>".$row[8]."</td>";
                $table .= "<td>".$row[4]."</td>";
                $table .= "</tr>";
            }
            $table .= "</tbody></table></div>";
            echo $table;
            ?>
        </div>

<!--             

issue book -->
        <!-- ISSUE BOOK SECTION -->
        <div id="issuebook" class="content-section">
            <h2 class="section-title">Issue Book</h2>
            <form action="issuebook_server.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="form-label">Choose Book:</label>
                    <select name="book" class="form-control" required>
                        <option value="">Select a Book</option>
                        <?php
                        $u = new data;
                        $u->setconnection();
                        $u->getbookissue();
                        $recordset = $u->getbookissue();
                        foreach($recordset as $row){
                            echo "<option value='".$row[2]."'>".$row[2]."</option>";
                        }            
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Select Student:</label>
                    <select name="userselect" class="form-control" required>
                        <option value="">Select a Student</option>
                        <?php
                        $u = new data;
                        $u->setconnection();
                        $u->userdata();
                        $recordset = $u->userdata();
                        foreach($recordset as $row){
                            echo "<option value='".$row[1]."'>".$row[1]."</option>";
                        }            
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Days:</label>
                    <input type="number" name="days" class="form-control" required/>
                </div>
                <input type="submit" value="SUBMIT" class="btn-submit"/>
            </form>
        </div>

        <!-- BOOK DETAIL SECTION -->


        <!-- BOOK REPORT SECTION -->
        <div id="bookreport" class="content-section">
            <h2 class="section-title">Book Record</h2>
            <?php
            $u = new data;
            $u->setconnection();
            $u->getbook();
            $recordset = $u->getbook();

            $table = "<div class='table-responsive'><table><thead><tr><th>Book Name</th><th>Price</th><th>Quantity</th><th>Available</th><th>Rent</th><th>Action</th></tr></thead><tbody>";
            foreach($recordset as $row){
                $table .= "<tr>";
                $table .= "<td>".$row[2]."</td>";
                $table .= "<td>".$row[7]."</td>";
                $table .= "<td>".$row[8]."</td>";
                $table .= "<td>".$row[9]."</td>";
                $table .= "<td>".$row[10]."</td>";
                $table .= "<td><a href='viewbook.php?viewid=".$row[0]."'><button type='button' class='btn-action'>View Book</button></a></td>";
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
            var addBookBtn = document.querySelector('.sidebar-btn');
            if (addBookBtn) {
                addBookBtn.classList.add('active');
            }
        });
    </script>

    <!-- Three.js Canvas -->
    <canvas id="canvas-3d-dashboard"></canvas>
    <script src="animations.js"></script>
</body>
</html> 
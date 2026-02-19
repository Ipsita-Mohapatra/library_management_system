<?php
include("data_class.php");

if(empty($_REQUEST['viewid'])){
    header("Location: admin_service_dashboard.php");
    exit();
}

$viewid = $_REQUEST['viewid'];
$u = new data;
$u->setconnection();
$u->getbookdetail($viewid);
$recordset = $u->getbookdetail($viewid);

$bookid = "";
$bookimg = "";
$bookname = "";
$bookdetail = "";
$bookauthour = "";
$bookpub = "";
$branch = "";
$bookprice = "";
$bookquantity = "";
$bookava = "";
$bookrent = "";

foreach($recordset as $row){
    $bookid = $row[0];
    $bookimg = $row[1];
    $bookname = $row[2];
    $bookdetail = $row[3];
    $bookauthour = $row[4];
    $bookpub = $row[5];
    $branch = $row[6];
    $bookprice = $row[7];
    $bookquantity = $row[8];
    $bookava = $row[9];
    $bookrent = $row[10];
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $bookname; ?> - Book Details</title>
        <meta name="description" content="Book Details - Library Management System">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="admin-dashboard.css">
        <link rel="stylesheet" href="advanced-animations.css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    <body class="dashboard-page">
    <!-- NAVBAR -->
    <div class="navbar-admin">
        <div class="navbar-brand">
            <img src="images/logo1.png" alt="Library" class="nav-logo" />
            <span class="brand-text">Book Details</span>
        </div>
        <a href="admin_service_dashboard.php" class="navbar-logout">BACK TO DASHBOARD</a>
    </div>

    <!-- SIDEBAR -->
    <nav class="sidebar">
        <ul class="sidebar-nav">
            <li class="sidebar-nav-item">
                <a href="admin_service_dashboard.php" class="sidebar-btn">
                    <img src="images/icon/book.png" alt="Dashboard"/> Dashboard
                </a>
            </li>
            <li class="sidebar-nav-item">
                <button class="sidebar-btn active">
                    <img src="images/icon/open-book.png" alt="Book Details"/> Book Details
                </button>
            </li>
        </ul>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="main-content">   
        <!-- BOOK DETAIL SECTION -->
        <div class="content-section active">
            <h2 class="section-title">📖 <?php echo htmlspecialchars($bookname); ?></h2>
            
            <div class="book-detail-container">
                <div class="book-image">
                    <img src="uploads/<?php echo htmlspecialchars($bookimg); ?>" alt="<?php echo htmlspecialchars($bookname); ?>"/>
                </div>
                <div class="book-info">
                    <div class="book-info-box">
                        <p><strong>Book Name:</strong><br/><span><?php echo htmlspecialchars($bookname); ?></span></p>
                    </div>
                    
                    <div class="book-info-box">
                        <p><strong>Description:</strong><br/><span><?php echo htmlspecialchars($bookdetail); ?></span></p>
                    </div>
                    
                    <div class="book-info-box">
                        <p><strong>Author:</strong><br/><span><?php echo htmlspecialchars($bookauthour); ?></span></p>
                    </div>
                    
                    <div class="book-info-box">
                        <p><strong>Publisher:</strong><br/><span><?php echo htmlspecialchars($bookpub); ?></span></p>
                    </div>
                    
                    <div class="book-info-box">
                        <p><strong>Branch:</strong><br/><span style="background: rgba(129, 140, 248, 0.2); padding: 0.4rem 0.8rem; border-radius: 6px; display: inline-block;"><?php echo htmlspecialchars($branch); ?></span></p>
                    </div>
                    
                    <div class="book-info-box">
                        <p><strong>Price:</strong><br/><span style="color: #86efac; font-size: 1.1rem; font-weight: 600;">Rs. <?php echo htmlspecialchars($bookprice); ?></span></p>
                    </div>
                    
                    <div class="book-info-box">
                        <p><strong>Total Quantity:</strong><br/><span><?php echo htmlspecialchars($bookquantity); ?></span></p>
                    </div>
                    
                    <div class="book-info-box">
                        <p><strong>Available:</strong><br/>
                        <span style="background: <?php echo ($bookava > 0) ? 'rgba(34, 197, 94, 0.2)' : 'rgba(239, 68, 68, 0.2)'; ?>; color: <?php echo ($bookava > 0) ? '#86efac' : '#fca5a5'; ?>; padding: 0.4rem 0.8rem; border-radius: 6px; display: inline-block; font-weight: 600;">
                            <?php echo ($bookava > 0) ? '✓ ' . htmlspecialchars($bookava) . ' Available' : '✗ Not Available'; ?>
                        </span></p>
                    </div>
                </div>
            </div>

            <div style="margin-top: 2rem; text-align: center;">
                <a href="admin_service_dashboard.php" style="display: inline-block;">
                    <button type="button" class="btn-action">← Back to Dashboard</button>
                </a>
            </div>
        </div>
    </main>

    <!-- Three.js Canvas -->
    <canvas id="canvas-3d-dashboard"></canvas>
    <script src="animations.js"></script>
</body>
</html>

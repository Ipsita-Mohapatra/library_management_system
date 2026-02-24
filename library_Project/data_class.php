<?php include("db.php");

class data extends db {

    private $bookpic;
    private $bookname;
    private $bookdetail;
    private $bookauthor;
    private $bookpub;
    private $branch;
    private $bookprice;
    private $bookquantity;
    private $type;
    private $name;
    private $pasword;
    private $email;

    private $book;
    private $userselect;
    private $days;
    private $getdate;
    private $returnDate;





    function __construct() {
        // echo " constructor ";
        echo "</br></br>";
    }


    function addnewuser($name,$pasword,$email,$type){
        $this->name=$name;
        $this->pasword=$pasword;
        $this->email=$email;
        $this->type=$type;

        // Use prepared statements to prevent SQL injection
        try {
            $q="INSERT INTO userdata(id, name, email, pass, type)VALUES('','$name','$email','$pasword','$type')";
            
            if($this->connection->exec($q)) {
                header("Location:student-signup.php?msg=Account created successfully! Please login now.");
                exit();
            } else {
                header("Location:student-signup.php?error=Failed to create account. Please try again.");
                exit();
            }
        } catch(Exception $e) {
            header("Location:student-signup.php?error=An error occurred: " . urlencode($e->getMessage()));
            exit();
        }
    }
    /**
     * Reset password for a user or admin.
     * $role should be 'user' or 'admin'
     */
    function resetPassword($email, $newpass, $role = 'user'){
        try{
            if($role === 'admin'){
                $stmt = $this->connection->prepare("UPDATE admin SET pass = :pass WHERE email = :email");
            } else {
                $stmt = $this->connection->prepare("UPDATE userdata SET pass = :pass WHERE email = :email");
            }
            $stmt->bindParam(':pass', $newpass);
            $stmt->bindParam(':email', $email);
            if($stmt->execute()){
                if($stmt->rowCount() > 0){
                    if($role === 'admin') header("Location:admin-login.php?msg=Password+updated+successfully");
                    else header("Location:student-login.php?msg=Password+updated+successfully");
                    exit();
                } else {
                    if($role === 'admin') header("Location:admin-login.php?msg=Email+not+found");
                    else header("Location:student-login.php?msg=Email+not+found");
                    exit();
                }
            } else {
                if($role === 'admin') header("Location:admin-login.php?msg=Failed+to+update+password");
                else header("Location:student-login.php?msg=Failed+to+update+password");
                exit();
            }
        }catch(Exception $e){
            if($role === 'admin') header("Location:admin-login.php?msg=Error");
            else header("Location:student-login.php?msg=Error");
            exit();
        }
    }

    // Ensure userdata has columns for blocking a user (adds columns if missing)
    private function ensureUserBlockColumns(){
        try{
            $check = $this->connection->query("SHOW COLUMNS FROM userdata LIKE 'blocked'");
            if($check->rowCount() == 0){
                $this->connection->exec("ALTER TABLE userdata ADD COLUMN blocked TINYINT(1) NOT NULL DEFAULT 0");
            }
            $check2 = $this->connection->query("SHOW COLUMNS FROM userdata LIKE 'blocked_reason'");
            if($check2->rowCount() == 0){
                $this->connection->exec("ALTER TABLE userdata ADD COLUMN blocked_reason VARCHAR(255) NULL");
            }
        }catch(Exception $e){
            // silently continue; not critical for reset flow
        }
    }
    function userLogin($t1, $t2) {
        try {
            $q="SELECT * FROM userdata where email='$t1' and pass='$t2'";
            $recordSet=$this->connection->query($q);
            $result=$recordSet->rowCount();
            
            if ($result > 0) {
                foreach($recordSet->fetchAll() as $row) {
                    $logid=$row['id'];
                    header("Location: otheruser_dashboard.php?userlogid=$logid");
                    exit();
                }
            } else {
                header("Location: student-login.php?msg=Invalid email or password. Please try again.");
                exit();
            }
        } catch(Exception $e) {
            header("Location: student-login.php?msg=An error occurred during login.");
            exit();
        }
    }

    function adminLogin($t1, $t2) {
        try {
            $q="SELECT * FROM admin where email='$t1' and pass='$t2'";
            $recordSet=$this->connection->query($q);
            $result=$recordSet->rowCount();

            if ($result > 0) {
                foreach($recordSet->fetchAll() as $row) {
                    $logid=$row['id'];
                    header("Location: admin_service_dashboard.php?logid=$logid");
                    exit();
                }
            } else {
                header("Location: admin-login.php?msg=Invalid email or password. Please try again.");
                exit();
            }
        } catch(Exception $e) {
            header("Location: admin-login.php?msg=An error occurred during login.");
            exit();
        }
    }



    function addbook($bookpic, $bookname, $bookdetail, $bookauthor, $bookpub, $branch, $bookprice, $bookquantity) {
        $this->bookpic=$bookpic;
        $this->bookname=$bookname;
        $this->bookdetail=$bookdetail;
        $this->bookauthor=$bookauthor;
        $this->bookpub=$bookpub;
        $this->branch=$branch;
        $this->bookprice=$bookprice;
        $this->bookquantity=$bookquantity;

       $q="INSERT INTO book (id,bookpic,bookname, bookdetail, bookauthor, bookpub, branch, bookprice,bookquantity,bookava,bookrent)VALUES('','$bookpic', '$bookname', '$bookdetail', '$bookauthor', '$bookpub', '$branch', '$bookprice', '$bookquantity','$bookquantity',0)";

        if($this->connection->exec($q)) {
            header("Location:admin_service_dashboard.php?msg=done");
        }

        else {
            header("Location:admin_service_dashboard.php?msg=fail");
        }

    }


    private $id;



    function getissuebook($userloginid) {

        // Return approved issuebook rows for the user from admin using a prepared statement
        $uid = intval($userloginid);
        $stmt = $this->connection->prepare("SELECT * FROM issuebook WHERE userid = :uid ORDER BY issuedate DESC");
        $stmt->bindParam(':uid', $uid, PDO::PARAM_INT);
        $stmt->execute();
        // return as associative array for easier consumption
        return $stmt->fetchAll(PDO::FETCH_ASSOC);






    }

    function getbook() {
        $q="SELECT * FROM book ";
        $data=$this->connection->query($q);
        return $data;
    }
    function getbookissue(){
        // Show ALL books for students to request (all books regardless of availability)
        $q="SELECT * FROM book ORDER BY bookname ASC";
        $data=$this->connection->query($q);
        return $data;
    }

    function getavailablebooks(){
        // Show only available books (inventory > 0)
        $q="SELECT * FROM book WHERE bookava > 0 ORDER BY bookname ASC";
        $data=$this->connection->query($q);
        return $data;
    }

    function userdata() {
        $q="SELECT * FROM userdata ";
        $data=$this->connection->query($q);
        return $data;
    }


    function getbookdetail($id){
        $q="SELECT * FROM book where id ='$id'";
        $data=$this->connection->query($q);
        return $data;
    }

    function userdetail($id){
        $q="SELECT * FROM userdata where id ='$id'";
        $data=$this->connection->query($q);
        return $data;
    }



    function requestbook($userid,$bookid){
        try {
            // Get user details
            $q="SELECT * FROM userdata WHERE id='$userid'";
            $recordSet=$this->connection->query($q);
            
            if($recordSet->rowCount() == 0) {
                header("Location:otheruser_dashboard.php?userlogid=$userid&msg=User not found");
                exit();
            }
            
            $userrow = $recordSet->fetch(PDO::FETCH_ASSOC);
            $username = $userrow['name'];
            $usertype = $userrow['type'];

            // Get book details
            $q="SELECT * FROM book WHERE id='$bookid'";
            $recordSetss=$this->connection->query($q);
            
            if($recordSetss->rowCount() == 0) {
                header("Location:otheruser_dashboard.php?userlogid=$userid&msg=Book not found");
                exit();
            }
            
            $bookrow = $recordSetss->fetch(PDO::FETCH_ASSOC);
            $bookname = $bookrow['bookname'];
            $available = intval($bookrow['bookava']);
            
            // Check availability: if no available copies, prevent request
            if($available <= 0){
                $_SESSION['msg'] = "Book is not available";
                header("Location:otheruser_dashboard.php?userlogid=$userid");
                exit();
            }

            // Check if book is already requested by this user
            $checkQ="SELECT * FROM requestbook WHERE userid='$userid' AND bookid='$bookid'";
            $checkResult=$this->connection->query($checkQ);
            if($checkResult->rowCount() > 0) {
                header("Location:otheruser_dashboard.php?userlogid=$userid&msg=You have already requested this book");
                exit();
            }

            // Set issue days based on user type
            $days = ($usertype=="teacher") ? 21 : 7;

            // Insert request
            $q="INSERT INTO requestbook (userid, bookid, username, usertype, bookname, issuedays) VALUES('$userid', '$bookid', '$username', '$usertype', '$bookname', '$days')";

            if($this->connection->exec($q)) {
                header("Location:otheruser_dashboard.php?userlogid=$userid&msg=Book request submitted successfully");
                exit();
            } else {
                header("Location:otheruser_dashboard.php?userlogid=$userid&msg=Failed to request book. Please try again.");
                exit();
            }
        } catch(Exception $e) {
            header("Location:otheruser_dashboard.php?userlogid=$userid&msg=An error occurred: " . urlencode($e->getMessage()));
            exit();
        }
    }


    function returnbook($id){
        $fine="";
        $bookava="";
        $issuebook="";
        $bookrentel="";

        $q="SELECT * FROM issuebook where id='$id'";
        $recordSet=$this->connection->query($q);

        foreach($recordSet->fetchAll() as $row) {
            $userid=$row['userid'];
            $issuebook=$row['issuebook'];
            $fine=$row['fine'];

        }
        if($fine==0){

        $q="SELECT * FROM book where bookname='$issuebook'";
        $recordSet=$this->connection->query($q);   

        foreach($recordSet->fetchAll() as $row) {
            $bookava=$row['bookava']+1;
            $bookrentel=$row['bookrent']-1;
        }
        $q="UPDATE book SET bookava='$bookava', bookrent='$bookrentel' where bookname='$issuebook'";
        $this->connection->exec($q);

        $q="DELETE from issuebook where id=$id and issuebook='$issuebook' and fine='0' ";
        if($this->connection->exec($q)){
    
            header("Location:otheruser_dashboard.php?userlogid=$userid");
         }
        //  else{
        //     header("Location:otheruser_dashboard.php?msg=fail");
        //  }
        }
        if($fine!=0){
            header("Location:otheruser_dashboard.php?userlogid=$userid&msg=Outstanding+fine+of+".urlencode($fine));
            exit();
        }
       

    }

    function delteuserdata($id){
        $q="DELETE from userdata where id='$id'";
        if($this->connection->exec($q)){
    
            
           header("Location:admin_service_dashboard.php?msg=done");
        }
        else{
           header("Location:admin_service_dashboard.php?msg=fail");
        }
    }

    function deletebook($id){
        $q="DELETE from book where id='$id'";
        if($this->connection->exec($q)){
    
            
           header("Location:admin_service_dashboard.php?msg=done");
        }
        else{
           header("Location:admin_service_dashboard.php?msg=fail");
        }
    }

        function issuereport(){
            $q="SELECT * FROM issuebook ";
            $data=$this->connection->query($q);
            return $data;
            
        }

        function requestbookdata(){
            $q="SELECT * FROM requestbook ";
            $data=$this->connection->query($q);
            return $data;
        }

        // Return single request row by id
        public function getRequestById($id){
            $stmt = $this->connection->prepare("SELECT * FROM requestbook WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

      // issue issuebookapprove
      function issuebookapprove($book,$userselect,$days,$getdate,$returnDate,$redid){
        $this->book= $book;
        $this->userselect=$userselect;
        $this->days=$days;
        $this->getdate=$getdate;
        $this->returnDate=$returnDate;


        // allow $book to be either id (int) or name (string)
        if(is_numeric($book)){
            $q="SELECT * FROM book WHERE id='".intval($book)."'";
        } else {
            $q="SELECT * FROM book WHERE bookname='".str_replace("'","''",$book)."'";
        }
        $recordSetss=$this->connection->query($q);

        $q="SELECT * FROM userdata where name='$userselect'";
        $recordSet=$this->connection->query($q);
        $result=$recordSet->rowCount();

        if ($result > 0) {

            foreach($recordSet->fetchAll() as $row) {
                $issueid=$row['id'];
                $issuetype=$row['type'];

                // header("location: admin_service_dashboard.php?logid=$logid");
            }
            // Ensure block columns exist
            $this->ensureUserBlockColumns();

            // Check for any overdue (past issuereturn) issuebook entries for this user
            $overdueQ = "SELECT id, issuereturn FROM issuebook WHERE userid='$issueid' AND (fine = 0 OR fine IS NULL)";
            $overdueRs = $this->connection->query($overdueQ);
            if($overdueRs){
                $now = new DateTime();
                $totalFine = 0;
                foreach($overdueRs->fetchAll() as $orow){
                    $dueStr = $orow['issuereturn'];
                    $dueDate = DateTime::createFromFormat('d/m/Y', $dueStr);
                    if($dueDate && $now > $dueDate){
                        $daysOver = (int)$now->diff($dueDate)->format('%a');
                        $fine = $daysOver * 100; // rate: 100 per day
                        $iid = $orow['id'];
                        $uq = $this->connection->prepare("UPDATE issuebook SET fine = :fine WHERE id = :id");
                        $uq->bindParam(':fine', $fine);
                        $uq->bindParam(':id', $iid);
                        $uq->execute();
                        $totalFine += $fine;
                    }
                }
                // Only block if fines were actually calculated
                if($totalFine > 0){
                    $blockReason = 'Overdue fines: ' . $totalFine;
                    $bu = $this->connection->prepare("UPDATE userdata SET blocked = 1, blocked_reason = :reason WHERE id = :uid");
                    $bu->bindParam(':reason', $blockReason);
                    $bu->bindParam(':uid', $issueid);
                    $bu->execute();

                    header("Location:admin_service_dashboard.php?msg=User+has+overdue+books+and+fines");
                    exit();
                }
            }
            $bookname = '';
            $bookid = 0;
            foreach($recordSetss->fetchAll() as $row) {
                $bookid=$row['id'];
                $bookname=$row['bookname'];
                $newbookava=$row['bookava']-1;
                $newbookrent=$row['bookrent']+1;
            }

        
            $q="UPDATE book SET bookava='$newbookava', bookrent='$newbookrent' where id='$bookid'";
            if($this->connection->exec($q)){

            $q="INSERT INTO issuebook (userid,issuename,issuebook,issuetype,issuedays,issuedate,issuereturn,fine)VALUES('$issueid','$userselect','$bookname','$issuetype','$days','$getdate','$returnDate','0')";

            if($this->connection->exec($q)) {

                $q="DELETE from requestbook where id='$redid'";
                $this->connection->exec($q);
                header("Location:admin_service_dashboard.php?msg=done");
            }
    
            else {
                header("Location:admin_service_dashboard.php?msg=fail");
            }
            }
            else{
               header("Location:admin_service_dashboard.php?msg=fail");
            }




        }

        else {
            header("location: index.php?msg=Invalid Credentials");
        }


    }
    
    // issue book
    function issuebook($book,$userselect,$days,$getdate,$returnDate){
        $this->book = $book;
        $this->userselect = $userselect;
        $this->days = $days;
        $this->getdate = $getdate;
        $this->returnDate = $returnDate;


        // allow $book to be either id (int) or name (string)
        if(is_numeric($book)){
            $q="SELECT * FROM book WHERE id='".intval($book)."'";
        } else {
            $q="SELECT * FROM book WHERE bookname='".str_replace("'","''",$book)."'";
        }
        $recordSetss=$this->connection->query($q);

        $q="SELECT * FROM userdata where name='$userselect'";
        $recordSet=$this->connection->query($q);
        $result=$recordSet->rowCount();

        if ($result > 0) {

            foreach($recordSet->fetchAll() as $row) {
                $issueid=$row['id'];
                $issuetype=$row['type'];

                // header("location: admin_service_dashboard.php?logid=$logid");
            }
            foreach($recordSetss->fetchAll() as $row) {
                $bookid=$row['id'];
                $bookname=$row['bookname'];
                $currentAva = intval($row['bookava']);
                $newbookava = $currentAva - 1;
                $newbookrent = $row['bookrent']+1;
            }

            // If no available copies, do not allow approval/issue
            if($currentAva <= 0){
                header("Location:admin_service_dashboard.php?msg=Book+not+available+for+issue");
                exit();
            }

            $q="UPDATE book SET bookava='$newbookava', bookrent='$newbookrent' where id='$bookid'";
            if($this->connection->exec($q)){

            $q="INSERT INTO issuebook (userid,issuename,issuebook,issuetype,issuedays,issuedate,issuereturn,fine)VALUES('$issueid','$userselect','$bookname','$issuetype','$days','$getdate','$returnDate','0')";

            if($this->connection->exec($q)) {
                header("Location:admin_service_dashboard.php?msg=done");
            }
    
            else {
                header("Location:admin_service_dashboard.php?msg=fail");
            }
            }
            else{
               header("Location:admin_service_dashboard.php?msg=fail");
            }


        }

        else {
            header("location: index.php?msg=Invalid Credentials");
        }


    }
}
<?php
session_start();
include("service/dbconnect.php");
include("service/functions.php");
if(!$_SESSION['login']){
    header("location:index.php");
    die;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<!--    <link rel="stylesheet" href="design/bootstrap-3.3.6-dist/css/bootstrap.css">-->
<!--    <script type="text/javascript" src="design/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>-->
<!--    <link rel="stylesheet" href="sytle.css">-->
    <title>My Request</title>
</head>
<body>

<?php include 'design/layout/_header.php'; ?>
<!-- Latest Books -->
<div class="container">
<legend style="text-align: center">My Requests</legend>

<?php

 {
        global $con;
        $userId=$_SESSION['user'];

        $get_ureq = "select * from request where user_id='$userId'";

        $run_ureq = mysqli_query($con, $get_ureq);

        while ($row_ureq = mysqli_fetch_array($run_ureq)) {
            $book_id = $row_ureq['book_id'];
            $book_title = $row_ureq['book_title'];
            $book_author = $row_ureq['book_author'];
            $book_image = $row_ureq['img'];

            echo "
            <div class=\"col-md-3 \">                <div class=\"thumbnail\" style='text-align: center;'>
                <h3>$book_title</h3>
                <img src='admin_area/req_images/$book_image' style='position: relative; width: 100%;height:290px;'/>
                <b>Author: $book_author</b>


</div>
            </div>
        ";
        }

}
?>




<!-- /Request -->
<!--<legend style="text-align: center">Request</legend>
<div class="col-md-3 " style="text-align: center;"><div class="thumbnail"><?php /*getRequest();*/?></div></div>
<div class="col-md-3"  style="text-align: center;"><div class="thumbnail">Book1</div></div>
<div class="col-md-3" style="text-align: center;"><div class="thumbnail">Book2</div></div>
<div class="col-md-3" style="text-align: center;"><div class="thumbnail">Book3</div></div>-->
</div>
</body>
</html>
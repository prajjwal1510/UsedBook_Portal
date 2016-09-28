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
    <link rel="stylesheet" href="design/bootstrap-3.3.6-dist/css/bootstrap.css">
    <script type="text/javascript" src="design/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="sytle.css">
    <title>All reqs</title>
</head>
<body>

<?php include 'design/layout/_header.php'; ?>
<!-- Latest reqs -->
<legend style="text-align: center">All Requests</legend>




<div class="container">
    <?php

    $get_req = "select * from request";

    $run_req = mysqli_query($con, $get_req);

    while ($row_req = mysqli_fetch_array($run_req)) {
        $req_id = $row_req['book_id'];
        $req_title = $row_req['book_title'];
        $req_author = $row_req['book_author'];
        $req_image = $row_req['img'];

        echo "
                            <div class=\"col-md-3 \">
                <div class=\"thumbnail\" style='text-align: center;'>
                                <h3>$req_title</h3>
                                <img src='admin_area/product_images/$req_image'  style='position: relative; width: 100%;height:290px;'/>
                                <b>$req_author</b>


                                </div>

                            </div>
                        ";

    }

    ?>

</div>
</body>
</html>
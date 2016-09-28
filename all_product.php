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
    <title>All Books</title>
</head>
<body>

<?php include 'design/layout/_header.php'; ?>
<!-- Latest Books -->
<legend style="text-align: center">All Books</legend>




<div class="container">
<?php

$get_book = "select * from book";

$run_book = mysqli_query($con, $get_book);

while ($row_book = mysqli_fetch_array($run_book)) {
    $book_id = $row_book['book_id'];
    $book_category = $row_book['book_category'];
    $book_subject = $row_book['book_subject'];
    $book_title = $row_book['book_title'];
    $book_price = $row_book['book_price'];
    $book_image = $row_book['book_image'];
    $book_status = $row_book['status'];

    echo "
                            <div class=\"col-md-3 \">
                <div class=\"thumbnail\" style='text-align: center;'>
                                <h3>$book_title</h3>
                                <img src='admin_area/product_images/$book_image'  style='position: relative; width: 100%;height:290px;'/>
                                <b>Rs. $book_price</b><br>
                                <b>$book_status</b>
                                <a class='btn btn-primary btn-block' href='detail.php?book_id=$book_id'>Details</a>

                                </div>

                            </div>
                        ";

}

?>

</div>
</body>
</html>
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
    <title>Result</title>
</head>
<body>

<?php include 'design/layout/_header.php'; ?>
<!-- Latest Books -->
<legend style="text-align: center">Books</legend>
<div class="container">
<div class='row'>
<?php

if(isset($_GET['search'])) {

    $search_query = $_GET['user_query'];

    $get_book = "select * from book where book_title like '%$search_query%' OR book_author LIKE '%$search_query%' ";

    $run_book = mysqli_query($con, $get_book);

    while ($row_book = mysqli_fetch_array($run_book)) {
        $book_id = $row_book['book_id'];
        $book_category = $row_book['book_category'];
        $book_subject = $row_book['book_subject'];
        $book_title = $row_book['book_title'];
        $book_price = $row_book['book_price'];
        $book_image = $row_book['book_image'];
        $book_status= $row_book['status'];

        echo "
    <div class='col-md-3'>
                <div class='card'>
                        <img class='card-img-top' src='admin_area/product_images/$book_image' height='267' width='100%' alt='Book'>
                        <div class='card-block'>
                         <h4 class='card-title'>$book_title</h4>
                        <p class='card-text'>Price : Rs. $book_price </p>
                        <p class='card-text'>$book_status </p>
                         <a href='detail.php?book_id=$book_id' class='btn btn-primary'>View Details</a>
                </div>
            </div>
            </div>
              ";

    }

}

?>
</div>
</div>
</div></div>



<!-- /Request -->
<!--<legend style="text-align: center">Request</legend>
<div class="col-md-3 " style="text-align: center;"><div class="thumbnail"></div></div>
<div class="col-md-3"  style="text-align: center;"><div class="thumbnail">Book1</div></div>
<div class="col-md-3" style="text-align: center;"><div class="thumbnail">Book2</div></div>
<div class="col-md-3" style="text-align: center;"><div class="thumbnail">Book3</div></div>-->
</div>
</body>
</html>
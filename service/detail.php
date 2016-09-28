<?php
session_start();
include("service/dbconnect.php");
include("service/functions.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="design/bootstrap-3.3.6-dist/css/bootstrap.min.css">
    <script type="text/javascript" src="design/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="sytle.css">
    <title>Book Detail</title>
</head>
<body>
<?php include 'design/layout/_header.php'; ?>
<div class="container">
    <!-- /side bar -->
    <div class="col-md-2">
        <legend style="text-align: center">Category</legend>
        <?php getCats(); ?>
        <legend style="text-align: center">Subjects</legend>
        <?php getSubjects(); ?>
    </div>


    <!-- /detail main -->
    <div class="col-md-10">
        <legend style="text-align: center"><h2>Book Detail</h2></legend>
        <?php
        if(isset($_GET['book_id'])) {
            $book_id = $_GET['book_id'];

            $get_book = "select * from book where book_id = '$book_id'";

            $run_book = mysqli_query($con, $get_book);

            while ($row_book = mysqli_fetch_array($run_book)) {
                $book_id = $row_book['book_id'];
                $book_title = $row_book['book_title'];
                $book_price = $row_book['book_price'];
                $book_image = $row_book['book_image'];
                $book_desc = $row_book['book_desc'];
                $book_author = $row_book['book_author'];
                $book_status = $row_book['status'];

                echo "

                    <div class='row'>
                    <div class='col-md-6'>

                            <h3>$book_title</h3>
                            <img src='admin_area/product_images/$book_image' width='400' height='400'/>
</div>
                        <div id = 'product'>

                    <div class='col-md-6'>
                    <div class='card card-inverse card-success text-md-center'>
  <div class='card-block'>
          <h2> Book Details </h2>
          <p> <strong>Price :</strong>Rs. $book_price</p>
          <p> <strong>Description :</strong> $book_desc </p>
          <p> <strong>Author :</strong> $book_author </p>
          <p> <strong>$book_status</strong> </p>
  </div>
</div>


                    ";

                echo "<hr>";
                $user_id=$_SESSION['user'];
                $info = "SELECT users.user_name, users.fname, users.address, users.contact, book.user_id FROM users INNER JOIN book ON book.user_id=users.user_id limit 0,1";
                $run_info=mysqli_query($con,$info);

                while ($row_info = mysqli_fetch_array($run_info)) {
                    $uploader_id=$row_info['user_id'];
                    $user_name=$row_info['user_name'];
                    $address=$row_info['address'];
                    $contact=$row_info['contact'];
                    $fname=$row_info['fname'];
                    echo "
<div class='card card-inverse card-success text-md-center'>
  <div class='card-block'>
          <h2> Uploader Details </h2>
          <p> <strong>Username :</strong> $user_name</p>
          <p> <strong>Address :</strong> $address </p>
          <p> <strong>Contact :</strong> $contact </p>
  </div>
</div>
							";

                }

            }
        }        if($uploader_id!=$user_id){
            echo "<form method='post'>

         <button type='submit'  id='interest' name='interest' class=\"btn btn-primary\"  value='interest'>Interested</button>

         <input type='hidden' id='BookId' value='$book_id'>
         </form>";
            if(isset($_POST['interest'])){
                $insert_interest= "update book set interested_id=''$user_id values('$user_id')";
                $insert_int= mysqli_query($con,$insert_interest);
            }
        }
        else{
            echo "<form method='post'>
         <button type='submit'  id='status' name='status' class=\"btn btn-primary\" >Sold</button>

         <input type='hidden' id='BookId' value='$book_id'>
         </form>";
            if(isset($_POST['status'])){
                $insert_status= "update book set status='SOLD' WHERE book_id='$book_id'";
                $insert_stat= mysqli_query($con,$insert_status);
            }
        }


        ?>
    </div>
</div>







<!-- Recommendation Books -->
<legend style="text-align: center">Other Books</legend>
<div class="container">
    <?php

    {

        if (!isset($_GET['cat'])) {

            if (!isset($_GET['subject'])) {
                global $con;
                $books_id = $_GET['book_id'];
                $get_reco = "select * from book ORDER BY RAND() LIMIT 0,4";

                $run_reco = mysqli_query($con, $get_reco);

                while ($row_reco = mysqli_fetch_array($run_reco)) {
                    $book_id = $row_reco['book_id'];
                    $book_category = $row_reco['book_category'];
                    $book_subject = $row_reco['book_subject'];
                    $book_title = $row_reco['book_title'];
                    $book_price = $row_reco['book_price'];
                    $book_image = $row_reco['book_image'];
                    echo "

    <div class='col-md-3'>
        <div class='card'>
            <img class='card-img-top' src='admin_area/product_images/$book_image' height='267' width='100%' alt='Book'>
            <div class='card-block'>
                <h4 class='card-title'>$book_title</h4>
                <p class='card-text'>Price : Rs. $book_price </p>
                <a href='detail.php?book_id=$book_id' class='btn btn-primary'>View Details</a>
            </div>
        </div>
    </div>

    ";

                }
            }
        }
    }


    ?>
</div>


</body>
</html>
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
    <title>Insert Book</title>
</head>
<body>
<?php include 'design/layout/_header.php'; ?>
<div class="container">
    <legend style="text-align: center"><h2>Insert Book</h2></legend>
    <form method="post" action="insert%20book.php" enctype="multipart/form-data">
        <div class="form-group">
            <label>Book Title</label>
            <input type="text" name="book_title" class="form-control" id="title" aria-describedby="booktitle" placeholder="Enter Book Name" required>
        </div>
        <div class="form-group">
            <label>Book Author</label>
            <input type="text" class="form-control" name="book_author" id="author" placeholder="Enter Book Author" required>
        </div>
        <div class="form-group">
            <label>Select Category</label>
            <select class="form-control" name="book_cat" id="category">
                <option>Select a Category</option>

                <?php
                $get_cats = "select * from categories";

                $run_cats = mysqli_query($con, $get_cats);

                while ($row_cats = mysqli_fetch_array($run_cats)) {
                    $cat_id = $row_cats['cat_id'];
                    $cat_title = $row_cats['cat_title'];

                    echo "<option value='$cat_title'>$cat_title</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Select Subject</label>
            <select class="form-control" name = "book_subject" id="subject">
                <option>Select a Subject</option>
                <?php
                $get_subjects = "select * from subject";

                $run_subjects = mysqli_query($con, $get_subjects);

                while ($row_subjects = mysqli_fetch_array($run_subjects)){

                    $subject_id= $row_subjects['sub_id'];
                    $subject_title = $row_subjects['sub_name'];

                    echo "<option value='$subject_title'>$subject_title</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Book Details</label>
            <textarea class="form-control"  name="book_desc" id="detail" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label>Book Price</label>
            <input type="number" class="form-control" name="book_price" id="price"  placeholder="Enter Price" maxlength="4" required>
        </div>

        <div class="form-group">
            <label for="exampleInputFile">Book Image</label>
            <input type="file" class="form-control-file" name="book_image"  id="image" aria-describedby="fileHelp" required>
            <small id="fileHelp" class="form-text text-muted">Insert latest book image.</small>
        </div>
        <button type="submit" name="insert_post" value="Insert Now" class="btn btn-primary">Submit</button>
    </form>



</div>
</body>
</html>
<?php

if(isset($_POST['insert_post'])){
    $book_title = $_POST['book_title'];
    $book_category = $_POST['book_cat'];
    $book_subject = $_POST['book_subject'];
    $book_author=$_POST['book_author'];
    $book_price = $_POST['book_price'];
    $book_desc = $_POST['book_desc'];


    $book_image = $_FILES['book_image']['name'];
    $book_image_tmp = $_FILES['book_image']['tmp_name'];

    move_uploaded_file($book_image_tmp,"admin_area/product_images/$book_image");

    $userId=$_SESSION['user'];
    $insert_product = "insert into book(book_title,book_subject,book_category,book_author,book_desc,book_price,book_image,user_id) values ('$book_title','$book_subject','$book_category','$book_author','$book_desc','$book_price','$book_image','$userId')";


    $insert_info= "insert into upload_info(book_name,user_id) values('$book_title','$userId')";
    $insert_pro = mysqli_query($con,$insert_product);
    $insert_ad= mysqli_query($con,$insert_info);

    if($insert_pro){
        echo "<script>alert('Book has been inserted!')</script>";
        echo "<script>window.open('insert%20book.php','_self')</script>";
    }


}

?>
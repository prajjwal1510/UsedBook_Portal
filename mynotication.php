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
    <title>My Notification</title>
</head>
<body>

<?php include 'design/layout/_header.php'; ?>
<!-- Latest Books -->
<div class="container">
    <legend style="text-align: center">My Notification</legend>

    <?php

    global $con;
    $user_id = $_SESSION['user'];

    //retrieving all entries where user_id equals uploader_id
    $get_uID = "select *from book where user_id = '$user_id'";

    $run_uID = mysqli_query($con, $get_uID);


    while ($row_uID = mysqli_fetch_array($run_uID)) {
        $upID = $row_uID['user_id'];
            }

    if($upID==$user_id)
    {
     $get_not="select DISTINCT book_title, book_author, int_name,int_fname, int_contact from (select book_title,book_author, int_name, interest.int_contact, int_fname from book INNER JOIN interest on book.book_id=interest.book_id where uploader_id='$user_id') as x";
        $run_not=mysqli_query($con,$get_not);

        while($row_not= mysqli_fetch_array($run_not))
        {
            $book_title=$row_not['book_title'];
            $book_author=$row_not['book_author'];
            $int_name=$row_not['int_name'];
            $int_fname=$row_not['int_fname'];
            $int_contact=$row_not['int_contact'];
            if($upID==$user_id){
echo "

             <div class=\"col-md-3\">                <div class=\"thumbnail\" style='text-align: center;'>
                <h4>$book_title</h4>
                <br><b>Author: $book_author</b>
                <br>Username: $int_name;
                <br>Full Name: $int_fname;
                <br>Contact Info: $int_contact;


</div>
            </div>




";
            }
        }
    }


?>
</div>
</div>


</body>
</html>
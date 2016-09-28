<?php
session_start();
include("service/dbconnect.php");
include("service/functions.php");
global $con;
$user_id=$_SESSION['user'];
if(!$_SESSION['login']){
    header("location:index.php");
    die;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="design/bootstrap-4.0.0-alpha.3/dist/js/jquery-1.8.3.min.js"></script>
    <script src="design/bootstrap-4.0.0-alpha.3/dist/js/bootstrap.js"></script>
    <link rel="stylesheet" href="design/bootstrap-4.0.0-alpha.3/dist/css/bootstrap.css">
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
                $up_id = $row_book['user_id'];
                $book_status = $row_book['status'];
                $book_cat = $row_book['book_category'];
                $book_sub= $row_book['book_subject'];

                echo "

                    <div class='row'>
                    <div class='col-md-6'>

                            <h3>$book_title</h3>
                            <img src='admin_area/product_images/$book_image' style='position: relative; width: 350px;height:290px;'/>
</div>
                        <div id = 'product'>

                    <div class='col-md-6'>
                      <legend>Book Detail</legend>
                    <b><p>Price:</b>Rs. $book_price</p>
                            <b><p>Description:</b> $book_desc</p>
							<b><p>Author:</b> $book_author</p>
							<b><p> $book_status</p></b>


                    ";

                $user_id = $_SESSION['user'];
                $info = "SELECT users.user_name, users.fname, users.address, users.contact, book.user_id, book.status FROM users INNER JOIN book ON book.user_id=users.user_id where book.user_id='$up_id' AND book_id='$book_id'";

                $run_info = mysqli_query($con, $info);

                while ($row_info = mysqli_fetch_array($run_info)) {
                    $uploader_id = $row_info['user_id'];
                    $user_name = $row_info['user_name'];
                    $address = $row_info['address'];
                    $contact = $row_info['contact'];
                    $fname = $row_info['fname'];
                    $status= $row_info['status'];

//                    interest

                    echo "

                     <table>
                    <legend>Uploader Detail</legend>
					 <tr>
					 <td><strong>User Name:</strong></td>
					 <td>$user_name</td>
					 </tr>
					 <tr>
					 <td><strong>Address: </strong></td>
					 <td>$address</td>
					 </tr>
					 <tr>
					 <td><strong>Contact: </strong></td>
					 <td>$contact</td>
					 </tr>
					 </table>
							";

                    $get_det = "select * from users WHERE user_id='$user_id'";

                    $run_det = mysqli_query($con, $get_det);

                    while ($row_det = mysqli_fetch_array($run_det)) {
                        $int_name = $row_det['user_name'];
                        $user_fname = $row_det['fname'];
                        $user_contact = $row_det['contact'];

                    }

                }
            }


            if ($uploader_id != $user_id) {
                if($status!='SOLD'){
                echo "<form method='post'>
         <button type='submit'  id='interest' name='interest' class=\"btn btn-primary\"  '>Interested</button>

         <input type='hidden' id='BookId' value='$book_id'>
         </form>";
                if (isset($_POST['interest'])) {
                    $insert_interest = "insert into interest(book_id,interest_id,int_name,int_fname,int_contact,uploader_id) values('$book_id','$user_id','$int_name','$user_fname','$user_contact','$uploader_id')";
                    $insert_int = mysqli_query($con, $insert_interest);
                }}
            } else {
                echo "<form method='post'>
         <button type='submit'  id='status' name='status' class=\"btn btn-primary\" >Sold</button>

         <input type='hidden' id='BookId' value='$book_id'>
         </form>";
                if (isset($_POST['status'])) {
                    $insert_status = "update book set status='SOLD' WHERE book_id='$book_id'";
                    $insert_stat = mysqli_query($con, $insert_status);
                }
            }
        }


        ?>
    </div>
</div>

<div class="row"></div>
<br>
<br><br><br><br>


<legend style="text-align: center">Other Books</legend>
<!--<validation>-->



    <!-- Recommendation Books -->

<?php

/**
 * PHP item based filtering
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * @package   PHP item based filtering
 */

require_once 'service/recommend/recommend.php';
require_once 'service/recommend/content_based.php';

$con = mysqli_connect("localhost", "root", "", "ecommerce");

$books = mysqli_query($con, "SELECT book_title, book_category, book_subject FROM book");

$objects = [];
$books_titles = [];
$i = 0;
while($book_row = $books->fetch_assoc()){

    //$category_result = mysqli_query($con, "SELECT cat_title FROM categories WHERE cat_id = " . $book_row["book_category"]);
    //$category_row = $category_result->fetch_assoc();
    $objects[$book_row["book_title"]] = array($book_row['book_category'], $book_row['book_subject']);
    $books_titles[$i++] = $book_row["book_title"];
}

/*$objects = [
	'The Matrix' => ['Action', 'Sci-Fi'],
	'Lord of The Rings' => ['Adventure', 'Drama', 'Fantasy'],
	'Batman' => ['Action', 'Drama', 'Crime'],
	'Fight Club' => ['Drama'],
	'Pulp Fiction' => ['Drama', 'Crime'],
	'Django' => ['Drama', 'Western'],
];*/


$user = [$book_cat, $book_sub];

$engine = new ContentBasedRecommend($user, $objects);

$recom_books = $engine->getRecommendation();
//echo var_dump($recom_books);

for($i = 0; $i < count($recom_books); $i++){

    if($recom_books[$books_titles[$i]] > 0) {
//        echo $books_titles[$i]. "<br>";
        $str = $books_titles[$i];


        $get_reco = "select * from book WHERE book_title='$str'";

        $run_reco = mysqli_query($con, $get_reco);

        while ($row_reco = mysqli_fetch_array($run_reco)) {
            $books_id = $row_reco['book_id'];
            $book_category = $row_reco['book_category'];
            $book_subject = $row_reco['book_subject'];
            $book_title = $row_reco['book_title'];
            $book_price = $row_reco['book_price'];
            $book_image = $row_reco['book_image'];
            if($book_id!=$books_id){
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

            //echo $recom_books[$books_titles[$i]];
        }
        }
    }
}
?>

<!--
<div>
    <?php /* if (!isset($_GET['cat'])) {

        if (!isset($_GET['subject'])) {
            global $con;

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
    */?>
</div>-->
</body>
</html>
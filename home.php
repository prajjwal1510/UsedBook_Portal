<?php
session_start();

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
    <title>Used Book Portal</title>
</head>
<body>

<?php include 'design/layout/_header.php'; ?>
    <!-- Latest Books -->
<div class="container">
    <legend style="text-align: center">Books</legend>

            <?php getBook();?>
            <?php getCatbook();?>
            <?php getSubjectBook();?>



<div class="row"></div>
    <!-- /Request -->
    <legend style="text-align: center">Requests</legend>
        <?php getRequest();?>

</div>
</body>
</html>
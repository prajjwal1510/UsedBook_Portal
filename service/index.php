<?php
session_start();
include_once 'service/dbconnect.php';

if(isset($_SESSION['user'])!="")
{
    header("Location: home.php");
}

if(isset($_POST['btn-login']))
{
    $uname = mysql_real_escape_string($_POST['uname']);
    $upass = mysql_real_escape_string($_POST['pass']);

    $uname = trim($uname);
    $upass = trim($upass);

    $res=mysql_query("SELECT user_id, user_name, user_pass FROM users WHERE user_name='$uname'");
    $row=mysql_fetch_array($res);

    $count = mysql_num_rows($res); // if uname/pass correct it returns must be 1 row

    if($count == 1 && $row['user_pass']==md5($upass))
    {
        $_SESSION['user'] = $row['user_id'];
        header("Location: home.php");
    }
    else
    {
        ?>
        <script>alert('Username / Password Seems Wrong !');</script>
        <?php
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="design/bootstrap-3.3.6-dist/css/bootstrap.css">
    <script type="text/javascript" src="design/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="design/flexslider.js"></script>
    <link rel="stylesheet" href="sytle.css">
    <link rel="stylesheet" href="design/css/style.css">

<!--    Modal-->
    <script type="text/javascript">
        $(document).ready(function(){
            $("#myModal").modal('show');
        });
    </script>
<!--slider-->
<!--    <script type="text/javascript">

    </script>-->
<!--    style-->
    <style type="text/css">
        .flex-caption {
            width: 96%;
            padding: 2%;
            left: 0;
            bottom: 0;
            background: rgba(0,0,0,.5);
            color: #fff;
            text-shadow: 0 -1px 0 rgba(0,0,0,.3);
            font-size: 14px;
            line-height: 18px;
        }
    </style>
<!--    style end-->

    <title>Log In</title>
</head>
<body style="background-color: #dbdbdb">

<!--modal-->
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>
                <h2 class="modal-title" style="text-align: center">Welcome to Used Book Portal</h2>
            </div>
            <div class="modal-body" style="text-align: center;">
                <p>Used Book Portal is a platform to find and sell Used Book. You can post the books you are willing to sell. You can also find books that you are in need of.</p>
                <div class="modal-footer">
                    <form method="post" action="register.php" id="login_form" name="login_form">

                        <INPUT TYPE="submit" class="btn btn-primary" VALUE="Get Started">


                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<!--modal end-->



</div>
<!--//login-->
<div id="custom-Bar">
    <div id="custom-Frame">
        <div id="logo"> <a href="#">Used Book Portal </a> </div>
        <div id="header-main-right">
            <div id="header-main-right-nav">
                <form method="post" id="login_form" name="login_form">
                    <table border="0" style="border:none">
                        <tr>
                            <td ><input type="text" id="username" placeholder="Username" aria-describedby="uname" name="uname" class="inputtext radius1" placeholder="Enter Username"required=""></td>
                            <td ><input type="password"  id="password" placeholder="Password" name="pass" class="inputtext radius1 "placeholder="Enter Password" required=""></td>
                            <td ><input type="submit" class="loginbutton" name="btn-login" value="Login" /></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>


<!--main-->
<div class="container">

    <h2 style="text-align: center">Welcome to Used Book Portal</h2>
</div>
<div  style="text-align: center;">
    <p>Used Book Portal is a platform to find and sell Used Book. You can post the books you are willing to sell. You can also find books that you are in need of.</p>


</div>
<div class="Wslider">

</div>

</body>
</html>
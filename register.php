<?php
session_start();
if(isset($_SESSION['user'])!="")
{
    header("Location: home.php");
}
include 'service/dbconnect.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="design/bootstrap-4.0.0-alpha.3/dist/js/jquery-1.8.3.min.js"></script>
    <script src="design/bootstrap-4.0.0-alpha.3/dist/js/bootstrap.js"></script>
    <link rel="stylesheet" href="design/bootstrap-4.0.0-alpha.3/dist/css/bootstrap.css">
    <link rel="stylesheet" href="sytle.css">
    <link rel="stylesheet" href="design/css/style.css">
    <title>Register to Used Book</title>
</head>
<body style="background-color: #dbdbdb">
<!--login menu-->

<div id="custom-Bar">
    <div id="custom-Frame">
        <div id="logo"> <a href="#">Used Book Portal </a> </div>
        <div id="header-main-right">
            <div id="header-main-right-nav">
                <form method="post" action="index.php" id="login_form" name="login_form">

                    <INPUT TYPE="submit" class="btn btn-primary" VALUE="Log In">


                </form>
            </div>
        </div>
    </div>
</div>




<div class="container">
    <div style="height: 20px;"></div>
    <div class="customForm" style="margin: 0 auto;width:40%;border:2px solid #3573a3;border-radius:5px;box-shadow: 2px 2px 2px 2px #3c763d;padding:10px">
    <legend style="text-align: center"><h2>Register To The Site</h2></legend>
    <form method="post">
        <div class="form-group row">
            <label class="col-xs-2 col-form-label">Username</label>
            <div class="col-xs-10">
                <input class="form-control" type="text" name="uname" placeholder="Username" id="username" onblur="checkUsername();" required="">
                <div class="error" id="usernameerror"><span class="glyphicons glyphicons-alert"></span>&nbsp;Username already taken</div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-xs-2 col-form-label">Email</label>
            <div class="col-xs-10">
                <input class="form-control" type="email" name="email" placeholder="example@email.com" id="email" onchange="checkEmail();" required>
                <div class="error" id="Emailerror"><span class="glyphicons glyphicons-alert"></span>&nbsp;Email already taken</div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-xs-2 col-form-label">Full Name</label>
            <div class="col-xs-10">
                <input class="form-control" type="text" name="fname" placeholder="Full Name" id="fname" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-xs-2 col-form-label">Contact Number</label>
            <div class="col-xs-10">
                <input class="form-control" type="tel" name="contact" pattern="^\d{10}$" placeholder="XXXXXXXXXX" id="tel" onchange="checkContact();" required>
                <div class="error" id="Telerror"><span class="glyphicons glyphicons-alert"></span>&nbsp;Contact Info already taken</div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-xs-2 col-form-label">Password</label>
            <div class="col-xs-10">
                <input class="form-control" type="password" name="pass" placeholder="Password" id="password" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-xs-2 col-form-label">Address</label>
            <div class="col-xs-10">
                <input class="form-control" type="text" name="address" placeholder="Address" id="address" required>
            </div>
        </div>
        <button type="submit" name="btn-signup" id="registerButton" class="btn btn-primary">Submit</button>



</div>
    </div>
<!--validatation-->
<script type="text/javascript">
    function checkUsername() {

        var username = $("#username").val();
        var data = {
            username : username
        }
//        alert(username);

        $.ajax({
            url:'service/validate/usernameExists.php',
            type:'POST',
            data:data,
            success:function(data){

                var data = JSON.parse(data);

                if(data.message == "fail"){
//                    alert("s");
                    $("#username").attr('style', 'border: 1px solid blue');
                    $("#usernameerror").attr('style', 'display: none;');
                    $("#registerButton").prop('disabled', false);
                }else{
//                    alert("b");

                    $("#username").attr('style', 'border: 2px solid red');
                    $("#usernameerror").attr('style', 'display: block;');
                    $("#registerButton").prop('disabled', true);
                }
            }
        })
    }

//

    function checkEmail() {

        var email = $("#email").val();
        var data1= {
            email : email
        }
//        alert(email);

        $.ajax({
            url:'service/validate/emailExists.php',
            type:'POST',
            data:data1,
            success:function(data1){

                var data1 = JSON.parse(data1);

                if(data1.message == "fail"){

                    $("#email").attr('style', 'border: 1px solid blue');
                    $("#Emailerror").attr('style', 'display: none;');
                    $("#registerButton").prop('disabled', false);
                }else{


                    $("#email").attr('style', 'border: 2px solid red');
                    $("#Emailerror").attr('style', 'display: block;');
                    $("#registerButton").prop('disabled', true);
                }
            }
        })
    }
//
    function checkContact() {

        var tel = $("#tel").val();
        var data2= {
            tel : tel
        }
//        alert(email);

        $.ajax({
            url:'service/validate/telExists.php',
            type:'POST',
            data:data2,
            success:function(data2){

                var data2 = JSON.parse(data2);

                if(data2.message == "fail"){

                    $("#tel").attr('style', 'border: 1px solid blue');
                    $("#Telerror").attr('style', 'display: none;');
                    $("#registerButton").prop('disabled', false);
                }else{


                    $("#tel").attr('style', 'border: 2px solid red');
                    $("#Telerror").attr('style', 'display: block;');
                    $("#registerButton").prop('disabled', true);
                }
            }
        })
    }


</script>

</body>
</html>


<?php
if(isset($_POST['btn-signup']))
{
    $uname = mysql_real_escape_string($_POST['uname']);
    $email = mysql_real_escape_string($_POST['email']);
    $upass = md5(mysql_real_escape_string($_POST['pass']));
    $add = mysql_real_escape_string($_POST['address']);
    $contact = mysql_real_escape_string($_POST['contact']);
    $fname= mysql_real_escape_string($_POST['fname']);


    $uname = trim($uname);
    $email = trim($email);
    $upass = trim($upass);
    $add = trim($add);
    $contact = trim($contact);
    $fname=trim($fname);
//// email exist or not
//    $query = "SELECT user_email FROM users WHERE user_email='$email'";
//    $result = mysql_query($query);
//
//    $count = mysql_num_rows($result); // if email not found then register
//
//    if($count == 0){

        if(mysql_query("INSERT INTO users(user_name,user_email,user_pass,fname,address,contact) VALUES('$uname','$email','$upass','$fname','$add','$contact')"))
        {
            ?>
            <script>alert('successfully registered ');</script>
            <?php
        }
        else
        {
            ?>
            <script>alert('error while registering you...');</script>
            <?php
        }
    }
?>



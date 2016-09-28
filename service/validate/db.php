<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 5/31/2016
 * Time: 9:45 AM
 */


$serverName = "localhost";
$dbUserName = "root";
$dbPassword = "";
$dbName = "ecommerce";

$connection = mysqli_connect($serverName,$dbUserName,$dbPassword,$dbName);

// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

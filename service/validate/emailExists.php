<?php
/**
 * Created by PhpStorm.
 * User: forteen inches
 * Date: 4/09/2016
 * Time: 8:53 PM
 */

include '../dbconnect.php';
include 'service.php';

echo validateEmail($_POST["email"]);


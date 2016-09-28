<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 7/26/2016
 * Time: 2:55 PM
 */
include("db.php");

function validateUsername($username){

    global $connection;
    $query_select = "select *from users WHERE user_name='$username'" ;

    $result = mysqli_query($connection,$query_select);

    $data =array();

    if(mysqli_num_rows($result)>0){
        $data['message']='success';
    }
    else{
        $data['message']='fail';
    }


    return json_encode($data);
}
//
function validateEmail($email){

    global $connection;
    $query_select3 = "select *from users WHERE user_email='$email'" ;

    $result3 = mysqli_query($connection,$query_select3);

    $data =array();

    if(mysqli_num_rows($result3)>0){
        $data['message']='success';
    }
    else{
        $data['message']='fail';
    }


    return json_encode($data);
}

//
function validateTel($tel){

    global $connection;
    $query_select4 = "select *from users WHERE contact='$tel'" ;

    $result4 = mysqli_query($connection,$query_select4);

    $data =array();

    if(mysqli_num_rows($result4)>0){
        $data['message']='success';
    }
    else{
        $data['message']='fail';
    }


    return json_encode($data);
}

//
function validateProject($conn, $projectName){

    $query_select = "SELECT * FROM request WHERE name = '$projectName'";

    $result = mysqli_query($conn,$query_select);

    $data =array();

    if(mysqli_num_rows($result)>0){
        $data['message']='success';
    }
    else{
        $data['message']='fail';
    }

    return json_encode($data);
}

function validateRequest($conn, $project_id, $user_id){

    $query_select1 = "SELECT * FROM `request` WHERE `project_id` = '$project_id' and `user_id` = '$user_id'";
    $query_select2 = "SELECT * FROM `userproject` WHERE `project_id` = '$project_id' and `user_id` = '$user_id'";

    $result1 = mysqli_query($conn,$query_select1);
    $result2 = mysqli_query($conn,$query_select2);

    $data =array();

    if(mysqli_num_rows($result1)>0 || mysqli_num_rows($result2)>0){
        $data['message']='success';
    }
    else{
        $data['message']='fail';
    }

    return json_encode($data);
}

?>
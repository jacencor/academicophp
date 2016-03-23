<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once $_SERVER["DOCUMENT_ROOT"].'/academicophp/app/connection/userPdo.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/academicophp/app/data/root/indexView.php';

$flag=false;
$json['suscess']='false';
$json['error']= alertAddFail();
if (isset($_POST['user_name']) && isset($_POST['password'])){
    $array['user_name']=$_POST['user_name'];
    $array['password']=$_POST['password'];
    $flag = singIn($array);
}
if($flag){
        $json['suscess']='true';
        $json['error']='';
}
echo json_encode($json);
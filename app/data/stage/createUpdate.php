<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once $_SERVER["DOCUMENT_ROOT"].'/academicophp/app/connection/stagePdo.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/academicophp/app/data/root/indexView.php';

$flag=false;
$json['suscess']='false';
$json['error']= alertAddFail();
if (isset($_POST['name'])){
    $array['name']=$_POST['name'];
    if (isset($_POST['id']) && $_POST['id']!='' ){
        $array['id']=$_POST['id'];
        $flag = updateStage($array);
    }else{
        $flag = addStage($array);
    }
}
if($flag){
        $json['suscess']='true';
        $json['error']='';
}
error_log(print_r($json),0);
echo json_encode($json);	
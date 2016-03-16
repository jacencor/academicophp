<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once $_SERVER["DOCUMENT_ROOT"].'/academicophp/app/connection/institutionPdo.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/academicophp/app/data/root/indexView.php';

$flag=false;
$json['suscess']='false';
$json['error']= alertAddFail();
if (isset($_POST['name']) && isset($_POST['code'])){
    $array['name']=$_POST['name'];
    $array['code']=$_POST['code'];
    if (isset($_POST['id']) && $_POST['id']!=''){
        $array['id']=$_POST['id'];
        error_log('id: '.$_POST['id'],0);
        $flag = updateInstitution($array);
    }else{
        $flag = addInstitution($array);
    }
}
if($flag){
        $json['suscess']='true';
        $json['error']='';
}
echo json_encode($json);	
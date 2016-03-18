<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once $_SERVER["DOCUMENT_ROOT"].'/academicophp/app/connection/levelPdo.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/academicophp/app/data/root/indexView.php';

$flag=false;
$json['suscess']='false';
$json['error']= alertAddFail();
if (isset($_POST['name']) && isset($_POST['stages_id'])){
    $array['name']=$_POST['name'];
    $array['stages_id']=$_POST['stages_id'];
    if (isset($_POST['id']) && $_POST['id']!='' ){
        $array['id']=$_POST['id'];
        $flag = updateLevel($array);
    }else{
        $flag = addLevel($array);
    }
}
if($flag){
        $json['suscess']='true';
        $json['error']='';
}
echo json_encode($json);	
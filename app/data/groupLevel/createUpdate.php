<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once $_SERVER["DOCUMENT_ROOT"].'/academicophp/app/connection/groupLevelPdo.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/academicophp/app/data/root/indexView.php';

$flag=false;
$json['suscess']='false';
$json['error']= alertAddFail();
if (isset($_POST['name']) && isset($_POST['levels_id'])&& isset($_POST['quota'])){
    $array['name']=$_POST['name'];
    $array['levels_id']=$_POST['levels_id'];
     $array['quota']=$_POST['quota'];
    if (isset($_POST['id']) && $_POST['id']!='' ){
        $array['id']=$_POST['id'];
        $flag = updateGroupLevel($array);
    }else{
        $flag = addGroupLevel($array);
    }
}
if($flag){
        $json['suscess']='true';
        $json['error']='';
}
echo json_encode($json);	
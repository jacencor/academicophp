<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once $_SERVER["DOCUMENT_ROOT"].'/academicophp/app/connection/institutionPdo.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/academicophp/app/view/root/indexView.php';

$json['suscess']='false';
$json['error']= alertDeleteFail();
if (isset($_POST['id'])){
    $array['id']=$_POST['id'];
    if(inactiveInstitution($array)){
        $json['suscess']='true';
        $json['error']='';
    }
}
echo json_encode($json);	
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once $_SERVER["DOCUMENT_ROOT"].'/academicophp/app/connection/groupLevelPdo.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/academicophp/app/data/root/indexView.php';

$json['suscess']='false';
$json['error']= alertDeleteFail();
if (isset($_POST['id'])){
    $array['id']=$_POST['id'];
    if(inactiveGroupLevel($array)){
        $json['suscess']='true';
        $json['error']='';
    }
}
echo json_encode($json);	
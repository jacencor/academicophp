<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once $_SERVER["DOCUMENT_ROOT"].'/academicophp/app/connection/institutionPdo.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/academicophp/app/view/root/indexView.php';

$json['suscess']='false';
$json['error']= alertReadFail();
if (isset($_POST['id'])){
    $array['id']=$_POST['id'];
    $output=findInstitution($array);
    if($output['flag']){
        $json['suscess']='true';
        $json['error']='';
        $json['name']=$output['output']['name'];
        $json['code']=$output['output']['code'];
        $json['id']=$output['output']['id'];
        $json['state']=$output['output']['state'];
        $json['created_at']=$output['output']['created_at'];
        $json['updated_at']=$output['output']['updated_at'];
    }
}
echo json_encode($json);
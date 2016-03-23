<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once $_SERVER["DOCUMENT_ROOT"].'/academicophp/app/connection/userPdo.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/academicophp/app/data/root/indexView.php';

$json['suscess']='false';
$json['error']= alertReadFail();
if (isset($_POST['id'])){
    $array['id']=$_POST['id'];
    $output=findUser($array);
    if($output['flag']){
        $json['suscess']='true';
        $json['error']='';
        $json['user_name']=$output['output']['user_name'];
        $json['id']=$output['output']['id'];
        $json['state']=$output['output']['state'];
        $json['created_at']=$output['output']['created_at'];
        $json['updated_at']=$output['output']['updated_at'];
        $json['names']=$output['output']['names'];
        $json['last_names']=$output['output']['last_names'];
        $json['email']=$output['output']['email'];
    }
}
echo json_encode($json);
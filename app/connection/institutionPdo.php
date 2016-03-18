<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once $_SERVER["DOCUMENT_ROOT"].'/academicophp/app/connection/connection.php';

function listInstitutions(){
    $sql = 'SELECT 
                id AS id
                ,name AS name
                ,code AS code
                ,state AS state
                ,created_at AS created_at
                ,updated_at AS updated_at
            FROM institutions
            ORDER BY name';
    $connection = new connectionDb;
    $output = $connection->executeSelectArray($sql);
    return ($output);
}

function listInstitutionsActive(){
    $sql = "SELECT 
                id AS id
                ,name AS name
                ,code AS code
                ,state AS state
                ,created_at AS created_at
                ,updated_at AS updated_at
            FROM institutions
            WHERE state = 'ACTIVO'
            ORDER BY name";
    $connection = new connectionDb;
    $output = $connection->executeSelectArray($sql);
    return ($output);
}

function countInstitutionsActive(){
    $output['flag']=false;
    $sql = "SELECT 
                COUNT(id) AS total
            FROM institutions
            WHERE state in (:activo)";
    $input['activo']='ACTIVO';
    $connection = new connectionDb;
    $output = $connection->executeSelect($sql, $input);
    if($output['flag']){
        return ($output);
    }else{
        return ($output);
    }
}

function addInstitution($input){
    if (!preg_match("/^[a-zA-Z0-9\s]{3,}+$/",$input['name'])){
        return false;
    }
    if (!preg_match("/^[a-zA-Z0-9]{3,}+$/",$input['code'])){
        return false;
    }
    $input['name']=strtoupper(preg_replace('/\s+/', ' ', trim($input['name'])));
    $input['code']=trim($input['code']);
    $input['state']="ACTIVO";
    $input['created_at']=date("Y-m-d H:i:s");
    $input['updated_at']=date("Y-m-d H:i:s");
    $sql = 'INSERT 
                INTO institutions (name, code, state, created_at, updated_at)
                VALUES (:name, :code, :state, :created_at, :updated_at)';
    $connection = new connectionDb;
    $output = $connection->executeSQL($sql,$input);
    if($output['flag']){
        return true;
    }else{
        return false;
    }
}

function deleteInstitution($id){
    if (!preg_match("/^[0-9]+$/",$id['id'])){
        return false;
    }
    $sql = 'DELETE FROM institutions WHERE id IN (:id)';
    $connection = new connectionDb;
    $output = $connection->executeSQL($sql,$id);
    if($output['flag']){
        return true;
    }else{
        return false;
    }
}

function findInstitution($id){
    $output['flag']=false;
    if (!preg_match("/^[0-9]+$/",$id['id'])){
        return $output;
    }
    $sql = "SELECT 
                id AS id
                ,name AS name
                ,code AS code
                ,state AS state
                ,created_at AS created_at
                ,updated_at AS updated_at
            FROM institutions
            WHERE id in (:id)
            AND state = 'ACTIVO'
            ORDER BY name";
    $connection = new connectionDb;
    $output = $connection->executeSelect($sql, $id);
    if($output['flag']){
        return ($output);
    }else{
        return ($output);
    }
}

function updateInstitution($input){
    if (!preg_match("/^[a-zA-Z0-9\s]{3,}+$/",$input['name'])){
        return false;
    }
    if (!preg_match("/^[a-zA-Z0-9]{3,}+$/",$input['code'])){
        return false;
    }
    if (!preg_match("/^[0-9]+$/",$input['id'])){
        return false;
    }
    $input['name']=strtoupper(preg_replace('/\s+/', ' ', trim($input['name'])));
    $input['code']=trim($input['code']);
    $input['updated_at']=date("Y-m-d H:i:s");
    $sql = 'UPDATE institutions
                SET name=:name, code=:code, updated_at=:updated_at
                WHERE id IN (:id)';
    $connection = new connectionDb;
    $output = $connection->executeSQL($sql,$input);
    if($output['flag']){
        return true;
    }else{
        return false;
    }
}

function inactiveInstitution($id){
    if (!preg_match("/^[0-9]+$/",$id['id'])){
        return false;
    }
    $id['state']='INACTIVO';
    $id['updated_at']=date("Y-m-d H:i:s");
    $sql = 'UPDATE institutions
                SET state=:state, updated_at=:updated_at
                WHERE id IN (:id)';
    $connection = new connectionDb;
    $output = $connection->executeSQL($sql,$id);
    if($output['flag']){
        return true;
    }else{
        return false;
    }
}
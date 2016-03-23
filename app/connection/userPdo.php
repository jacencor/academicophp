<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once $_SERVER["DOCUMENT_ROOT"].'/academicophp/app/connection/connection.php';

function listUsers(){
    $sql = 'SELECT 
                id AS id
                ,user_name AS user_name
                ,names AS names
                ,last_names AS last_names
                ,email AS email
                ,state AS state
                ,created_at AS created_at
                ,updated_at AS updated_at
            FROM users
            ORDER BY user_name';
    $connection = new connectionDb;
    $output = $connection->executeSelectArray($sql);
    return ($output);
}

function listUsersActive(){
    $sql = "SELECT 
                id AS id
                ,user_name AS user_name
                ,names AS names
                ,last_names AS last_names
                ,email AS email
                ,state AS state
                ,created_at AS created_at
                ,updated_at AS updated_at
            FROM users
            WHERE state = 'ACTIVO'
            ORDER BY user_name";
    $connection = new connectionDb;
    $output = $connection->executeSelectArray($sql);
    return ($output);
}

function countUsersActive(){
    $output['flag']=false;
    $sql = "SELECT 
                COUNT (id) AS total
            FROM users
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

function addUser($input){
    if (!preg_match("/^[0-9]{10,13}+$/",$input['user_name'])){
        return false;
    }
    if (!(filter_var($input['email'], FILTER_VALIDATE_EMAIL))){
        return false;
    }
    if (!preg_match("/^[a-zA-Z\s]{2,64}+$/",$input['names'])){
        return false;
    }
    if (!preg_match("/^[a-zA-Z\s]{2,64}+$/",$input['last_names'])){
        return false;
    }
    if (!preg_match("/^[a-zA-Z]\w{4,16}$/",$input['password'])){
        return false;
    }
    $input['state']="ACTIVO";
    $input['created_at']=date("Y-m-d H:i:s");
    $input['updated_at']=date("Y-m-d H:i:s");
    $input['user_name']=trim($input['user_name']);
    $input['email']=strtolower(trim($input['email']));
    $input['names']=strtoupper(preg_replace('/\s+/', ' ', trim($input['names'])));
    $input['last_names']=strtoupper(preg_replace('/\s+/', ' ', trim($input['last_names'])));
    $input['password']=password_hash($input['password'], PASSWORD_DEFAULT, ['cost'=>12]);
    $sql = 'INSERT 
            INTO users (user_name
                ,email
                ,state
                ,created_at
                ,updated_at
                ,names
                ,last_names
                ,password)
            VALUES (:user_name
                ,:email
                ,:state
                ,:created_at
                ,:updated_at
                ,:names
                ,:last_names
                ,:password)';
    $connection = new connectionDb;
    $output = $connection->executeSQL($sql,$input);
    if($output['flag']){
        return true;
    }else{
        return false;
    }
}

function deleteUser($id){
    if (!preg_match("/^[0-9]+$/",$id['id'])){
        return false;
    }
    $sql = 'DELETE FROM users WHERE id IN (:id)';
    $connection = new connectionDb;
    $output = $connection->executeSQL($sql,$id);
    if($output['flag']){
        return true;
    }else{
        return false;
    }
}

function findUser($id){
    $output['flag']=false;
    if (!preg_match("/^[0-9]+$/",$id['id'])){
        return $output;
    }
    $sql = "SELECT 
                id AS id
                ,user_name AS user_name
                ,names AS names
                ,last_names AS last_names
                ,email AS email
                ,state AS state
                ,created_at AS created_at
                ,updated_at AS updated_at
            FROM users
            WHERE id IN (:id)
            AND state = 'ACTIVO'
            ORDER BY user_name";
    $connection = new connectionDb;
    $output = $connection->executeSelect($sql, $id);
    if($output['flag']){
        return ($output);
    }else{
        return ($output);
    }
}

function inactiveUser($id){
    if (!preg_match("/^[0-9]+$/",$id['id'])){
        return false;
    }
    $id['state']='INACTIVO';
    $id['updated_at']=date("Y-m-d H:i:s");
    $sql = 'UPDATE users
            SET state=:state
                ,updated_at=:updated_at
            WHERE id IN (:id)';
    $connection = new connectionDb;
    $output = $connection->executeSQL($sql,$id);
    if($output['flag']){
        return true;
    }else{
        return false;
    }
}

function updateUser($input){
    if (!(filter_var($input['email'], FILTER_VALIDATE_EMAIL))){
        return false;
    }
    if (!preg_match("/^[a-zA-Z0-9\s]{2,64}+$/",$input['names'])){
        return false;
    }
    if (!preg_match("/^[a-zA-Z0-9\s]{2,64}+$/",$input['last_names'])){
        return false;
    }
    $input['names']=strtoupper(preg_replace('/\s+/', ' ', trim($input['names'])));
    $input['last_names']=strtoupper(preg_replace('/\s+/', ' ', trim($input['last_names'])));
    $input['email']=trim($input['email']);
    $input['updated_at']=date("Y-m-d H:i:s");
    $sql = 'UPDATE users
            SET names=:names
                ,last_names=:last_names
                ,email=:email
                ,updated_at=:updated_at
            WHERE id IN (:id)';
    $connection = new connectionDb;
    $output = $connection->executeSQL($sql,$input);
    if($output['flag']){
        return true;
    }else{
        return false;
    }
}

function singIn($input){
    if (!preg_match("/^[0-9]{10,13}+$/",$input['user_name'])){
        return false;
    }
    if (!preg_match("/^[a-zA-Z]\w{4,16}$/",$input['password'])){
        return false;
    }
    $user['user_name']=$input['user_name'];
    $sql = 'SELECT password AS password
                ,id AS id
            FROM users
            WHERE user_name IN (:user_name)';
    $connection = new connectionDb;
    $output = $connection->executeSelect($sql,$user);
    if (count($output['output'])>0){
        if (password_verify($input['password'], $output['output']['password'])){
            session_start();
            $_SESSION['user_id']= $output['output']['id'];
            $_SESSION['start']= true;
            error_log($_SESSION['user_id'], 0);
            return true;
        }
    }
    return false;
}
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once $_SERVER["DOCUMENT_ROOT"].'/academicophp/app/connection/connection.php';

function listLevels(){
    $sql = 'SELECT 
                levels.id AS id
                ,levels.name AS name
                ,levels.state AS state
                ,levels.created_at AS created_at
                ,levels.updated_at AS updated_at
                ,stages.name AS stage
                ,stages.id AS stages_id
            FROM levels
            INNER JOIN stages
            ON levels.stages_id=stages.id 
            ORDER BY name';
    $connection = new connectionDb;
    $output = $connection->executeSelectArray($sql);
    return ($output);
}

function listLevelsActive(){
    $sql = "SELECT 
                levels.id AS id
                ,levels.name AS name
                ,levels.state AS state
                ,levels.created_at AS created_at
                ,levels.updated_at AS updated_at
                ,stages.name AS stage
                ,stages.id AS stages_id
            FROM levels
            INNER JOIN stages
            ON levels.stages_id=stages.id 
            WHERE levels.state = 'ACTIVO'
            ORDER BY stage,name";
    $connection = new connectionDb;
    $output = $connection->executeSelectArray($sql);
    return ($output);
}

function addLevel($input){
    if (!preg_match("/^[a-zA-Z0-9\s]{3,}+$/",$input['name'])){
        return false;
    }
    if (!preg_match("/^[0-9]+$/",$input['stages_id'])){
        return false;
    }
    $input['name']=strtoupper(preg_replace('/\s+/', ' ', trim($input['name'])));
    $input['state']="ACTIVO";
    $input['created_at']=date("Y-m-d H:i:s");
    $input['updated_at']=date("Y-m-d H:i:s");
    $sql = 'INSERT 
                INTO levels (name, state, created_at, updated_at,stages_id)
                VALUES (:name, :state, :created_at, :updated_at, :stages_id)';
    $connection = new connectionDb;
    $output = $connection->executeSQL($sql,$input);
    if($output['flag']){
        return true;
    }else{
        return false;
    }
}

function updateLevel($input){
    if (!preg_match("/^[a-zA-Z0-9\s]{3,}+$/",$input['name'])){
        return false;
    }
    if (!preg_match("/^[0-9]+$/",$input['stages_id'])){
        return false;
    }
    if (!preg_match("/^[0-9]+$/",$input['id'])){
        return false;
    }
    $input['name']=strtoupper(preg_replace('/\s+/', ' ', trim($input['name'])));
    $input['updated_at']=date("Y-m-d H:i:s");
    $sql = 'UPDATE levels
                SET name=:name, updated_at=:updated_at, stages_id=:stages_id
                WHERE id IN (:id)';
    $connection = new connectionDb;
    $output = $connection->executeSQL($sql,$input);
    if($output['flag']){
        return true;
    }else{
        return false;
    }
}

function inactiveLevel($id){
    if (!preg_match("/^[0-9]+$/",$id['id'])){
        return false;
    }
    $id['state']='INACTIVO';
    $id['updated_at']=date("Y-m-d H:i:s");
    $sql = 'UPDATE levels
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

function findLevel($id){
    $output['flag']=false;
    if (!preg_match("/^[0-9]+$/",$id['id'])){
        return $output;
    }
    $sql = "SELECT 
                id AS id
                ,name AS name
                ,state AS state
                ,created_at AS created_at
                ,updated_at AS updated_at
                ,stages_id as stages_id
            FROM levels
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
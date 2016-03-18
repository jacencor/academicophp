<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once $_SERVER["DOCUMENT_ROOT"].'/academicophp/app/connection/connection.php';

function listStages(){
    $sql = 'SELECT 
                stages.id AS id
                ,stages.name AS name
                ,stages.state AS state
                ,stages.created_at AS created_at
                ,stages.updated_at AS updated_at
                ,institutions.name AS institution
                ,institutions.id AS institutions_id
            FROM Stages
            INNER JOIN institutions
            ON stages.institutions_id=institutions.id 
            ORDER BY name';
    $connection = new connectionDb;
    $output = $connection->executeSelectArray($sql);
    return ($output);
}

function listStagesActive(){
    $sql = "SELECT 
                stages.id AS id
                ,stages.name AS name
                ,stages.state AS state
                ,stages.created_at AS created_at
                ,stages.updated_at AS updated_at
                ,institutions.name AS institution
                ,institutions.id AS institutions_id
            FROM Stages
            INNER JOIN institutions
            ON stages.institutions_id=institutions.id 
            WHERE stages.state = 'ACTIVO'
            ORDER BY name";
    $connection = new connectionDb;
    $output = $connection->executeSelectArray($sql);
    return ($output);
}

function addStage($input){
    if (!preg_match("/^[a-zA-Z0-9\s]{3,}+$/",$input['name'])){
        return false;
    }
    if (!preg_match("/^[0-9]+$/",$input['institutions_id'])){
        return false;
    }
    $input['name']=strtoupper(preg_replace('/\s+/', ' ', trim($input['name'])));
    $input['state']="ACTIVO";
    $input['created_at']=date("Y-m-d H:i:s");
    $input['updated_at']=date("Y-m-d H:i:s");
    $sql = 'INSERT 
                INTO stages (name, state, created_at, updated_at,institutions_id)
                VALUES (:name, :state, :created_at, :updated_at, :institutions_id)';
    $connection = new connectionDb;
    $output = $connection->executeSQL($sql,$input);
    if($output['flag']){
        return true;
    }else{
        return false;
    }
}

function updateStage($input){
    if (!preg_match("/^[a-zA-Z0-9\s]{3,}+$/",$input['name'])){
        return false;
    }
    if (!preg_match("/^[0-9]+$/",$input['institutions_id'])){
        return false;
    }
    if (!preg_match("/^[0-9]+$/",$input['id'])){
        return false;
    }
    $input['name']=strtoupper(preg_replace('/\s+/', ' ', trim($input['name'])));
    $input['updated_at']=date("Y-m-d H:i:s");
    $sql = 'UPDATE stages
                SET name=:name, institutions_id=:institutions_id, updated_at=:updated_at
                WHERE id IN (:id)';
    $connection = new connectionDb;
    $output = $connection->executeSQL($sql,$input);
    if($output['flag']){
        return true;
    }else{
        return false;
    }
}

function inactiveStage($id){
    if (!preg_match("/^[0-9]+$/",$id['id'])){
        return false;
    }
    $id['state']='INACTIVO';
    $id['updated_at']=date("Y-m-d H:i:s");
    $sql = 'UPDATE stages
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

function deleteStage($id){
    if (!preg_match("/^[0-9]+$/",$id['id'])){
        return false;
    }
    $sql = 'DELETE FROM stages WHERE id IN (:id)';
    $connection = new connectionDb;
    $output = $connection->executeSQL($sql,$id);
    if($output['flag']){
        return true;
    }else{
        return false;
    }
}

function findStage($id){
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
                ,institutions_id as institutions_id
            FROM stages
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
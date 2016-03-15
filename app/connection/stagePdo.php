<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once $_SERVER["DOCUMENT_ROOT"].'/academicophp/app/connection/connection.php';

function listStages(){
    $sql = 'SELECT 
                stages.id AS id
                ,stages.name AS name
                ,stages.state AS state
                ,stages.created_at AS created_at
                ,stages.updated_at AS updated_at
                ,institutions.name AS institution
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
    $input['name']=trim($input['name']);
    $input['state']="ACTIVO";
    $input['created_at']=date("Y-m-d H:i:s");
    $input['updated_at']=date("Y-m-d H:i:s");
    //$getId = new connectionDb;
    //$result = $connection->executeSQL('SELECT id as id FROM institutions WHERE state in (:state)',$input['state']='ACTIVO');
    //$input['institutions_id']=$result['output']['id'];
    $sql = 'INSERT 
                INTO stages (name, state, created_at, updated_at)
                VALUES (:name, :state, :created_at, :updated_at,)';
    $connection = new connectionDb;
    $output = $connection->executeSelect($sql,$input);
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
    if (!preg_match("/^[0-9]+$/",$input['id'])){
        return false;
    }
    $input['name']=trim($input['name']);
    $input['updated_at']=date("Y-m-d H:i:s");
    $sql = 'UPDATE stages
                SET name=:name, updated_at=:updated_at
                WHERE id IN (:id)';
    $connection = new connectionDb;
    $output = $connection->executeSQL($sql,$input);
    if($output['flag']){
        return true;
    }else{
        return false;
    }
}
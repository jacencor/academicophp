<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once $_SERVER["DOCUMENT_ROOT"].'/academicophp/app/connection/connection.php';

function listGroupLevels(){
    $sql = 'SELECT 
                group_levels.id AS id
                ,group_levels.name AS name
                ,group_levels.state AS state
                ,group_levels.quota AS quota
                ,group_levels.created_at AS created_at
                ,group_levels.updated_at AS updated_at
                ,levels.name AS level
                ,levels.id AS levels_id
            FROM group_levels
            INNER JOIN levels
            ON group_levels.levels_id=levels.id 
            ORDER BY level, name';
    $connection = new connectionDb;
    $output = $connection->executeSelectArray($sql);
    return ($output);
}

function listGroupLevelsActive(){
    $sql = "SELECT 
                group_levels.id AS id
                ,group_levels.name AS name
                ,group_levels.state AS state
                ,group_levels.quota AS quota
                ,group_levels.created_at AS created_at
                ,group_levels.updated_at AS updated_at
                ,levels.name AS level
                ,levels.id AS levels_id
            FROM group_levels
            INNER JOIN levels
            ON group_levels.levels_id=levels.id 
            WHERE group_levels.state = 'ACTIVO'
            ORDER BY level, name";
    $connection = new connectionDb;
    $output = $connection->executeSelectArray($sql);
    return ($output);
}

function addGroupLevel($input){
    if (!preg_match("/^[a-zA-Z0-9\s]{3,}+$/",$input['name'])){
        return false;
    }
    if (!preg_match("/^[0-9]+$/",$input['quota'])){
        return false;
    }
    if (!preg_match("/^[0-9]+$/",$input['levels_id'])){
        return false;
    }
    $foo = preg_replace('/\s+/', ' ', $foo);
    $input['name']=strtoupper(preg_replace('/\s+/', ' ', trim($input['name'])));
    $input['state']="ACTIVO";
    $input['created_at']=date("Y-m-d H:i:s");
    $input['updated_at']=date("Y-m-d H:i:s");
    $sql = 'INSERT 
                INTO group_levels (name, quota, state, created_at, updated_at, levels_id)
                VALUES (:name, :quota, :state, :created_at, :updated_at, :levels_id)';
    $connection = new connectionDb;
    $output = $connection->executeSQL($sql,$input);
    if($output['flag']){
        return true;
    }else{
        return false;
    }
}

function updateGroupLevel($input){
    if (!preg_match("/^[a-zA-Z0-9\s]{3,}+$/",$input['name'])){
        return false;
    }
    if (!preg_match("/^[0-9]+$/",$input['quota'])){
        return false;
    }
    if (!preg_match("/^[0-9]+$/",$input['levels_id'])){
        return false;
    }
    if (!preg_match("/^[0-9]+$/",$input['id'])){
        return false;
    }
    $input['name']=strtoupper(preg_replace('/\s+/', ' ', trim($input['name'])));
    $input['updated_at']=date("Y-m-d H:i:s");
    $sql = 'UPDATE group_levels
                SET name=:name, quota=:quota, updated_at=:updated_at, levels_id=:levels_id
                WHERE id IN (:id)';
    $connection = new connectionDb;
    $output = $connection->executeSQL($sql,$input);
    if($output['flag']){
        return true;
    }else{
        return false;
    }
}

function inactiveGroupLevel($id){
    if (!preg_match("/^[0-9]+$/",$id['id'])){
        return false;
    }
    $id['state']='INACTIVO';
    $id['updated_at']=date("Y-m-d H:i:s");
    $sql = 'UPDATE group_levels
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

function findGroupLevel($id){
    $output['flag']=false;
    if (!preg_match("/^[0-9]+$/",$id['id'])){
        return $output;
    }
    $sql = "SELECT 
                id AS id
                ,name AS name
                ,quota AS quota
                ,state AS state
                ,created_at AS created_at
                ,updated_at AS updated_at
                ,levels_id as levels_id
            FROM group_levels
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
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class user   {
    private $id;
    private $user_name;
    private $names;
    private $last_names;
    private $email;
    private $state;
    private $created_at;
    private $updated_at;
 
    
    function __construct($array) {
        $this->id=$array['id'];
        $this->user_name=$array['user_name'];
        $this->names=$array['names'];
        $this->last_names=$array['last_names'];
        $this->state=$array['state'];
        $this->created_at=$array['created_at'];
        $this->updated_at=$array['updated_at'];
    }
    function getId() {
        return $this->id;
    }

    function getUser_name() {
        return $this->user_name;
    }

    function getNames() {
        return $this->names;
    }

    function getLast_names() {
        return $this->lastNames;
    }

    function getEmail() {
        return $this->email;
    }

    function getState() {
        return $this->state;
    }

    function getCreated_at() {
        return $this->created_at;
    }

    function getUpdated_at() {
        return $this->updated_at;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUser_name($user_name) {
        $this->user_name = $user_name;
    }

    function setNames($names) {
        $this->names = $names;
    }

    function setLastNames($lastNames) {
        $this->lastNames = $lastNames;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setState($state) {
        $this->state = $state;
    }

    function setCreated_at($created_at) {
        $this->created_at = $created_at;
    }

    function setUpdated_at($updated_at) {
        $this->updated_at = $updated_at;
    }


}
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class institution   {
    private $id;
    private $name;
    private $state;
    private $created_at;
    private $updated_at;
    private $institutions_id;
    private $institution;
            
    function __construct($array) {
        $this->id=$array['id'];
        $this->name=$array['name'];
        $this->state=$array['state'];
        $this->created_at=$array['created_at'];
        $this->updated_at=$array['updated_at'];
        $this->institutions_id=$array['institutions_id'];
        $this->institution=$array['institution'];
    }
    
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
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
    function getInstitutions_id() {
        return $this->institutions_id;
    }

    function getInstitution() {
        return $this->institution;
    }

    function setInstitutions_id($institutions_id) {
        $this->institutions_id = $institutions_id;
    }

    function setInstitution($institution) {
        $this->institution = $institution;
    }

    function setName($name) {
        $this->name = $name;
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
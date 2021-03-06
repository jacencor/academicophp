<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ($_SERVER["DOCUMENT_ROOT"].'/academicophp/app/connection/stagePdo.php');
require_once ($_SERVER["DOCUMENT_ROOT"].'/academicophp/app/connection/institutionPdo.php');
require_once ($_SERVER["DOCUMENT_ROOT"].'/academicophp/app/class/stage.php');

function printListStagesActive(){
    $array = listStagesActive();
    if ($array['flag']){
        $list = $array['output'];
        echo '<div class="table-responsive">
            <table class="table">
                <tr>
                    <th>Ciclo</th>
                    <th>Institucion</th>
                    <th>Estado</th>
                    <th>Fecha de creacion</th>
                    <th></th>
                </tr>';
        foreach ($list as $row) {
           $ciclo = new stage($row);
           echo '<tr><td>';
           echo $ciclo->getName();
           echo '</td><td>';
           echo $ciclo->getInstitution();
           echo '</td><td>';
           echo $ciclo->getState();
           echo '</td><td>';
           echo $ciclo->getCreated_at();
               echo '</td><td>';
                    echo '<div class="btn-group pull-right">';
                        echo '<button name="delete" class="btn delete btn-danger" value="'.$ciclo->getId().'">Eliminar</button>';
                        echo '<button name="edit" class="btn edit btn-success" value="'.$ciclo->getId().'">Editar</button>';
                    echo '</div>';
           echo '</td></tr>';
        }
        echo '</tabla>'
        . '</div>';
    }else{
        echo alertReadFail();
    }
}

function printSelectInstitutionActive(){
    $array = listInstitutionsActive();
    if ($array['flag']){
        $list = $array['output'];
        echo '<select name= "institutions_id" class="form-control" id="institutions" form="form">';
        foreach ($list as $row) {
           $ciclo = new stage($row);
           echo '<option value="'.$ciclo->getId().'">'. $ciclo->getName().'</option>';
        }
        echo '</select>';
    }else{
        echo alertReadFail();
    }
}
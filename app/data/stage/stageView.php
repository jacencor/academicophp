<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once $_SERVER["DOCUMENT_ROOT"].'/academicophp/app/connection/stagePdo.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/academicophp/app/class/stage.php';

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
           echo $ciclo->getInstitutions_id();
           echo '</td><td>';
           echo $ciclo->getState();
           echo '</td><td>';
           echo $ciclo->getCreated_at();
               echo '</td><td>';
               echo '<button name="delete" class="btn delete btn-primary" value="'.$ciclo->getId().'">Eliminar</button>';
           echo '</td></tr>';
        }
        echo '</tabla>'
        . '</div>';
    }else{
        echo alertReadFail();
    }
}

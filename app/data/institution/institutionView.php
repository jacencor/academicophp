<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once $_SERVER["DOCUMENT_ROOT"].'/academicophp/app/connection/institutionPdo.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/academicophp/app/class/institution.php';

function printListInstitutionsActive(){
    $array = listInstitutionsActive();
    if ($array['flag']){
        $list = $array['output'];
        echo '<div class="table-responsive">
            <table class="table">
                <tr>
                    <th>Institutción</th>
                    <th>Estado</th>
                    <th>Fecha de creación</th>
                    <th></th>
                </tr>';
        foreach ($list as $row) {
            $institucion = new institution($row);
            echo '<tr><td>';
            echo $institucion->getName();
            echo '</td><td>';
            echo $institucion->getState();
            echo '</td><td>';
            echo $institucion->getCreated_at();
                echo '</td><td>';
                   echo '<div class="btn-group pull-right">';
                         echo '<button name="delete" class="btn delete btn-danger " value="'.$institucion->getId().'">Eliminar</button>';
                         echo '<button name="edit" class="btn edit btn-success " value="'.$institucion->getId().'">Editar</button>';
                    echo '</div>';
            echo '</td></tr>';
        }
        echo '</tabla>'
        . '</div>';
    }else{
        echo alertReadFail();
    }
}

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ($_SERVER["DOCUMENT_ROOT"].'/academicophp/app/connection/userPdo.php');
require_once ($_SERVER["DOCUMENT_ROOT"].'/academicophp/app/class/user.php');

function printListUsersActive(){
    $array = listUsersActive();
    if ($array['flag']){
        $list = $array['output'];
        echo '<div class="table-responsive">
            <table class="table">
                <tr>
                    <th>Usuario</th>
                    <th>Nombres y Apellidos</th>
                    <th>email</th>
                    <th>Fecha de creacion</th>
                    <th></th>
                </tr>';
        foreach ($list as $row) {
           $usuario = new user($row);
           echo '<tr><td>';
           echo $usuario->getUser_name();
           echo '</td><td>';
           echo $usuario->getNames().' '.$usuario->getLast_names();
           echo '</td><td>';
           echo $usuario->getEmail();
           echo '</td><td>';
           echo $usuario->getCreated_at();
               echo '</td><td>';
                    echo '<div class="btn-group pull-right">';
                        echo '<button name="delete" class="btn delete btn-danger" value="'.$usuario->getId().'">Eliminar</button>';
                        echo '<button name="edit" class="btn edit btn-success" value="'.$usuario->getId().'">Editar</button>';
                    echo '</div>';
           echo '</td></tr>';
        }
        echo '</tabla>'
        . '</div>';
    }else{
        echo alertReadFail();
    }
}


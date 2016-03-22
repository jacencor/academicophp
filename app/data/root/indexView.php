<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function printHead($dir){
    echo    '<head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
                <meta name="description" content="academico desarrollo">
                <meta name="author" content="jacencor">
                <!-- <link rel="icon" href="../../favicon.ico"> -->
                <title>academic</title>
                <link href="'.$dir.'css/bootstrap.min.css" rel="stylesheet">
                <link href="'.$dir.'css/theme.css" rel="stylesheet">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
                <script src="'.$dir.'js/bootstrap.min.js"></script>
            </head>';
}
function printNav(){
    echo    '<nav class="navbar navbar-inverse navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                <span class="sr-only">Toggle navegacion</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="http://localhost/academicophp/root/">Academico</a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li >
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Información<span class="caret"></span></a>
                                <ul class="dropdown-menu"> 
                                    <li><a href="http://localhost/academicophp/root/institucion/">Institución</a></li>
                                    <li><a href="http://localhost/academicophp/root/institucion/ciclo/">Ciclo</a></li>
                                    <li><a href="http://localhost/academicophp/root/institucion/nivel/">Nivel</a></li>
                                    <li><a href="http://localhost/academicophp/root/institucion/paralelo/">Paralelo</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>';
}

/*
 *  Mensajes de alerta
 * --------------------
 */
function alertDeleteFail(){
    $messages = '<div class="alert alert-warning">
                    <a href="#" class="close"  aria-label="close" data-dismiss="alert">&times;</a>
                    <strong>ERROR!</strong> Al eliminar información.
		</div>';
    return ($messages);
}
function alertAddFail(){
    $messages = '<div class="alert alert-warning">
                    <a href="#" class="close"  aria-label="close" data-dismiss="alert">&times;</a>
                    <strong>ERROR!</strong> Al guardar información.
                </div>';
    return ($messages);
}
function alertReadFail(){
    $messages = '<div class="alert alert-warning">
                    <a href="#" class="close"  aria-label="close" data-dismiss="alert">&times;</a>
                    <strong>ERROR!</strong> Al obtener información.
                </div>';
    return ($messages);
}

/*
 *  Cuadro de espera
 * --------------------
 */

function printWaitBox(){
    echo '<div class="modal fade bs-example-modal-sm" id="modalWait" tabindex="-1"
            role="dialog" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            <span class="glyphicon glyphicon-time">
                            </span>Por favor esperar...
                         </h4>
                    </div>
                    <div class="modal-body">
                        <div class="progress">
                            <div class="progress-bar progress-bar-info
                            progress-bar-striped active"
                            style="width: 100%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
}
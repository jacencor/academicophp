<!DOCTYPE html>
<?php 
    require_once $_SERVER["DOCUMENT_ROOT"].'/academicophp/app/data/root/indexView.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/academicophp/app/data/user/userView.php';
?>
<html lang="es">
    <?php printHead('../../'); ?>
	<script>
	$(document).ready(function(){
            $("#openModal").click(function(){
                $("#modalForm").modal();
            });

            $("#submit").click(function(){
                $('#modalWait').modal('show');
                $.ajax({
                    type: "POST",
                    url: "../../app/data/user/createUpdate.php",
                    data: $("form").serialize(),
                    dataType: 'json',
                    success: function(msg){ 
                        if (msg.suscess == 'true'){
                            $("#modalForm").modal('hide');
                        }else{
                            $("#messages1").append(msg.error);
                        }},
                    error: function(msg){
                        $("#messages1").append(msg.error);
                    },
                    complete: function () {
                        $('#modalWait').modal('hide');
                    }
                });
            });

            $(".delete").click(function(){
                $('#modalWait').modal('show').delay(5000);
                $.ajax({
                    type: "POST",
                    url: "../../app/data/user/delete.php",
                    data: {id:$(this).attr('value')},
                    dataType: 'json',
                    success: function(msg){
                        if (msg.suscess == 'true'){
                            location.reload();
                        }else{
                            $("#messages2").append(msg.error);
                    }},
                    error: function(msg){
                        $("#messages2").append(msg.error);
                    },
                    complete: function () {
                        $('#modalWait').modal('hide');
                    }
                });
            });
            
            $(".edit").click(function(){
                $.ajax({
                    type: "POST",
                    url: "../../app/data/user/loadInfo.php",
                    data: {id:$(this).attr('value')},
                    dataType: 'json',
                    success: function(msg){ 
                        alert('s');
                        console.log(msg.user_name);
                        if (msg.suscess == 'true'){
                            $("#modalForm").modal();
                            $("#user_name").val(msg.user_name);
                            $("#user_name").prop("readonly", true)
                            $("#email").val(msg.email);
                            $("#names").val(msg.names);
                            $("#last_names").val(msg.last_names);
                            $("#password").val('password');
                            $("#password").prop("readonly", true)
                            $("#id").val(msg.id);
                            //location.reload();
                        }else{
                            alert('e');
                            $("#messages2").append(msg.error);
                    }},
                    error: function(msg){
                        alert('n');
                        $("#messages2").append(msg.error);
                    }
                });
            });

            $('#modalForm').on('hidden.bs.modal', function () {
                    //$("#institutions").load("index.php #institutions");
                    //$("#modalForm").load("index.php #modalForm");
                    location.reload();
            });
	});
	</script>
    <body role="document">
    <?php printNav(); ?>
        <div class="container theme-showcase" role="main">
            <div  class="container">
                <div  class="page-header">
                    <div>
                        <h1>Usuarios
                            <button id="openModal" type="button" class="btn  btn-primary pull-right ">Agregar usuario</button>
                        </h1>
                        <div id="messages2"></div>
                    </div>
                </div>
                <div class="row">
                    <?php printListUsersActive(); ?>
                </div>
            </div>
        </div>
        <!-- Modal content-->
        <div id="modalForm" class="modal fade" role="dialog" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Crear Institucion</h4>
                    </div>
                    <div class="modal-body">
                        <form  id="form" role="form">
                            <div class="form-group">
                                <label for="user_name">Cédula:</label>
                                <input type="text" class="form-control" name="user_name" id="user_name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text" class="form-control" name="email" id="email">
                            </div>
                            <div class="form-group">
                                <label for="names">Nombres:</label>
                                <input type="text" class="form-control" name="names" id="names">
                            </div>
                            <div class="form-group">
                                <label for="last_names">Apellidos:</label>
                                <input type="text" class="form-control" name="last_names" id="last_names">
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" name="password" id="password">
                            </div>
                            <input type="hidden" name="id" id="id" value="">
                            <div id="messages1"></div>
			</form>
                        <div class="modal-footer">
                            <button id="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal content-->
        <!-- Modal wait-->
        <?php
            printWaitBox();
        ?>
        <!-- Modal wait -->
    </body>
</html>

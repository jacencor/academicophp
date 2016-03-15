<!DOCTYPE html>
<?php 
    include_once $_SERVER["DOCUMENT_ROOT"].'/academicophp/app/data/root/indexView.php';
    include_once $_SERVER["DOCUMENT_ROOT"].'/academicophp/app/data/institution/institutionView.php';
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
                    url: "../../app/data/institution/createUpdate.php",
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
                    complete: function ( ) {
                        $('#modalWait').modal('hide');
                    }
                });
            });

            $(".delete").click(function(){
                $('#modalWait').modal('show').delay(5000);
                $.ajax({
                    type: "POST",
                    url: "../../app/data/institution/delete.php",
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
                    url: "../../app/data/institution/loadInfo.php",
                    data: {id:$(this).attr('value')},
                    dataType: 'json',
                    success: function(msg){ 
                        if (msg.suscess == 'true'){
                            $("#modalForm").modal();
                            $("#name").val(msg.name);
                            $("#code").val(msg.code);
                            $("#id").val(msg.id);
                            //location.reload();
                        }else{
                            $("#messages2").append(msg.error);
                    }},
                    error: function(msg){
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
                        <h1>Institución
                            <?php
                                $count = countInstitutionsActive();
                                if ($count['output']['total']==0){
                                    echo '<button id="openModal" type="button" class="btn  btn-primary pull-right ">Agregar institución</button>';
                                }
                            ?>
                        </h1>
                        <div id="messages2"></div>
                    </div>
                </div>
                <div class="row">
                    <?php printListInstitutionsActive(); ?>
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
                                <label for="name">Nombre de institucion:</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            <div class="form-group">
                                <label for="code">Codigo:</label>
                                <input type="text" class="form-control" name="code" id="code">
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

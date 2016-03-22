<!DOCTYPE html>
<?php 
    require_once ($_SERVER["DOCUMENT_ROOT"].'/academicophp/app/data/root/indexView.php');
    require_once ($_SERVER["DOCUMENT_ROOT"].'/academicophp/app/data/groupLevel/groupLevelView.php'); 
?>
<html lang="es">
    <?php printHead('../../../'); ?>
	<script>
	$(document).ready(function(){
            $("#openModal").click(function(){
                $("#modalForm").modal();
            });

            $("#submit").click(function(){
                $('#modalWait').modal('show');
                $.ajax({
                    type: "POST",
                    url: "../../../app/data/groupLevel/createUpdate.php",
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
                         alert();
                        $('#modalWait').modal('hide');
                    }
                });
            });

            $(".delete").click(function(){
                $('#modalWait').modal('show').delay(5000);
                $.ajax({
                    type: "POST",
                    url: "../../../app/data/groupLevel/delete.php",
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
                    url: "../../../app/data/groupLevel/loadInfo.php",
                    data: {id:$(this).attr('value')},
                    dataType: 'json',
                    success: function(msg){ 
                        if (msg.suscess == 'true'){
                            $("#modalForm").modal();
                            $("#name").val(msg.name);
                            $("#quota").val(msg.quota);
                            $("#levels").val(msg.levels_id);
                            $("#stages").val(msg.stages_id);
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
                        <h1>Paralelos
                            <button id="openModal" type="button" class="btn  btn-primary pull-right ">Agregar paralelo</button>
                        </h1>
                        <div id="messages2"></div>
                    </div>
                </div>
                <div class="row">
                    <?php printListGroupLevelsActive(); ?>
                </div>
            </div>
        </div>
        <!-- Modal content-->
        <div id="modalForm" class="modal fade" role="dialog" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Crear Paralelo</h4>
                    </div>
                    <div class="modal-body">
                        <form  id="form" role="form">
                            <div class="form-group">
                                <label for="name">Paralelo:</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            <div class="form-group">
                                <label for="name">Cupo:</label>
                                <input type="integer" class="form-control" name="quota" id="quota">
                            </div>
                            <div class="form-group">
                                <label for="levels">Nivel:</label>
                                <?php printSelectLevelsActive(); ?>
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

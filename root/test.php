<!DOCTYPE html>
<html lang="en">
    <?php 
        include_once '../app/data/root/indexView.php';
        include_once '../app/data/ciclo/stageView.php';
        printHead('../');
    ?>
    
    <body>
    <?php
        printNav();
    ?>
<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>
<form  id="form" action="../app/data/stage/createUpdate.php" method="POST" role="form">
                            <div class="form-group">
                                <label for="name">Nombre de institucion:</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            <div class="form-group">
                                <label for="code">Codigo:</label>
                                <input type="text" class="form-control" name="code" id="code">
                            </div>
                            <input type="hidden" name="oid" id="oid" value="15">
                            <input type="submit" name="oid" id="oid" value="15">
                            <div id="messages1"></div>
			</form>

<?php
        printListStagesActive();
    ?>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal1">Open Modal</button>
    
        <p>Some text in the modal.</p>

      </div>
    </div>

  </div>
</div>

<!-- Modal -->
<div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
         <p>Some text in the modal.</p>
          <p>Some text in the modal.</p>
      </div>
    </div>

  </div>
</div>


<form  id="form" action="institucion/delete.php" method="POST" role="form">
                            
                            <input  name="id" id="id" value="">
                            <input type="submit" >
                            <div id="messages1"></div>
			</form>

    </body>
</html>


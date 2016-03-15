<!DOCTYPE html>
<html lang="en">
    <?php 
        include_once '../app/data/root/indexView.php';
        include_once '../app/data/stage/stageView.php';
        printHead('../');
        error_log("asadsdasd", 0)
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
                            
                            <input type="submit" name="oid" >
                            <div id="messages1"></div>
			</form>


    </body>
</html>


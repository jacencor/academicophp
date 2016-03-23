<!DOCTYPE html>
<html lang="en">
    <?php 
        require_once '../app/data/root/indexView.php';
        printHead('../');
    ?>
    <script>
	$(document).ready(function(){
            $("#submit").click(function(){
                $('#modalWait').modal('show');
                $.ajax({
                    type: "POST",
                    url: "../app/data/user/singIn.php",
                    data: $("form").serialize(),
                    dataType: 'json',
                    success: function(msg){ 
                        if (msg.suscess == 'true'){
                            $('#modalWait').modal('hide');
                              window.location.href = "http://localhost/academicophp/root";
                        }else{
                            $("#messages1").append(msg.error);
                        }},
                    error: function(msg){
                        $("#messages1").append('<p>error</p>');
                        alert('s');
                    },
                    complete: function () {
                        $('#modalWait').modal('hide');
                    }
                });
            });
	});
	</script>
    <body>
    <div class="container">
        <form  id="form"  class="form-signin">
            <h2 class="form-signin-heading">Iniciar sesión</h2>
            <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Cédula" required autofocus>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required> 
        </form>
        <div  class="form-signin">
            <button id="submit" class="btn btn-lg btn-primary btn-block">Ingresar</button>
        <div>
        <div class="form-signin" id="messages1"></div>
    </div> <!-- /container -->
    <?php printWaitBox(); ?>
    </body>
</html>


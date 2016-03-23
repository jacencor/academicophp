<?php
session_start();
 if(!isset($_SESSION['user_id'])){
     header('Location: http://localhost/academicophp/root/login.php');
 }
?>
<!DOCTYPE html>
<html lang="en">
    <?php 
        require_once '../app/data/root/indexView.php';
        printHead('../');
    ?>
    <body>
    <?php
        printNav();
        echo '<p>hola<p>';
        echo $_SESSION['user_id'];
    ?>
    </body>
</html>

<?php
    session_start();
?>
<html>

<head>
    <title>TimeLine</title>
    <link rel="stylesheet" type="text/css" media="screen" href="..\CSS\timeLine2.css" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="..\bootstrap-4.2.1-dist\css\bootstrap.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php 
        include('..\menu\head_menu.html');
    ?>
</head>

<body>
<?php
    if(isset($_SESSION['idUser'])){
        include('..\menu\menu_connecte.php');
        
    }else{
        include('..\menu\menu_deconnecte.html');
    }

    
        
?>
<div class="container-fluid">
    <?php
        // print_r($_SESSION);
        include('functionsTimeLine.php')
    ?>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="../bootstrap-4.2.1-dist/js/bootstrap.bundle.min.js"></script>
<script src="../bootstrap-4.2.1-dist/js/bootstrap.min.js"></script>

<script src="timeLine.js"></script>

</html>
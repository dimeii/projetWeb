<html>
        <?php
                session_start();
        ?>

<head>
        <title>Profil</title>
        <link rel="stylesheet" type="text/css" media="screen" href="..\CSS\profil.css" />
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="..\bootstrap-4.2.1-dist\css\bootstrap.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
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
                if(isset($_GET['nomArtist'])){
                        include('functionProfil.php');
                }
                else{
                        echo'Veuillez chercher un artist';
                }
                        
        ?> 
        </div>
</body>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"></script>

</html>
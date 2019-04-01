<?php
    session_start();
?>

<html>

<head>
    <title>Picture</title>
    <link rel="stylesheet" type="text/css" media="screen" href="..\CSS\picture2.css" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="..\bootstrap-4.2.1-dist\css\bootstrap.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="modal.css">
    <?php 
        include('..\menu\head_menu.html');
    ?>

</head>


 


<body>
    <?php
        if(isset($_SESSION['idUser'])){
            include('..\menu\menu_connecte.php');
            if(isset($_POST)){
                // print_r($_POST);
            }
        }else{
            include('..\menu\menu_deconnecte.html');
            echo'<h2 class="text-center">Veuillez vous connecter <a href="../connexion/connexion.php">ici</a> pour pouvoir aimer/commenter un post.</h2>';
        }
    ?>
    <div class="container-fluid">
        <div class="row">
            <?php
                if(isset($_GET)&& isset($_GET['img'])){
                    include('treatmentPicture.php');
                    }
                    
            ?>   
        </div>
    </div> 


    <!-- The Modal -->
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                
                <h2>Entrez votre commentaire : </h2>
                <span class="close">&times;</span>
            </div>
            <div class="modal-body">

                
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Entrez votre commentaire :</label>
                    <textarea class="form-control" id="commentaireArea" rows="2" name="commentaire"></textarea>
                </div>
                <button id="submit" class="btn btn-primary">Commenter ça </button>
                
            </div>
            
        </div>

    </div>

</body>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="../bootstrap-4.2.1-dist/js/bootstrap.bundle.min.js"></script>
<script src="../bootstrap-4.2.1-dist/js/bootstrap.min.js"></script>
<script src="modal.js"> </script>
<script src="postComment.js"> </script>
<script src="../js/like.js"> </script>

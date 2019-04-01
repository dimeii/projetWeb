<?php
    session_start();
    
?>    
<html>

<head>
    <title>Recherche</title>
    <link rel="stylesheet" type="text/css" media="screen" href="..\CSS\search.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="..\CSS\picture.css" />
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
       
        <div class="barreRecherche">
                <form method="get" action="#">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Recherche :</label>
                        <input type="text" class="form-control" name="researchChamp">
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="choixRecherche"  value="artistName">
                        <label class="form-check-label" id="artistName">Nom d'artiste</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="choixRecherche"  value="tags">
                        <label class="form-check-label" >Tag</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="choixRecherche"  value="imageTitre">
                        <label class="form-check-label" >Titre d'image</label>
                    </div>

                    <button type="submit" class="btn btn-primary">Rechercher</button>
                </form>

                

                
        </div>
        
        <div class="resultatRecherche">
            <?php
                if(isset($_GET) && isset($_GET['choixRecherche'])){
                   
                    
                    include('treatment.php');
                    // print_r($resultat);
                }
            ?>
            <!--
            <div class="card mb-3">
                <div class="containerImg">
                    <img src="../_images/lac.jpg" class="card-img-top" alt="...">
                </div>
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text"></p><i class="fa fa-heart-o" aria-hidden="true"></i> XXX likes</p>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional
                        content. This content is a little bit longer.</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
            -->
        </div>
    </div>
    
</body>


<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="../bootstrap-4.2.1-dist/js/bootstrap.bundle.min.js"></script>
<script src="../bootstrap-4.2.1-dist/js/bootstrap.min.js"></script>
<script src="../js/like.js"> </script>
<script src="search.js"> </script>

</html>

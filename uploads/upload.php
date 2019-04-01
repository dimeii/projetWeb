<?php
        session_start();
?>
<!DOCTYPE html>
<html>
        <head>
        <title>Ajout d'une nouvelle image</title>
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
                <div class="offset-lg-3 col-lg-6 offset-md-3 col-md-6 offset-sm-3 col-sm-6">
                        <form action="treatmentUpload.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                        <label for="formGroupExampleInput">Titre de l'image</label>
                                        <input type="text" class="form-control" name="titre" id="titre" placeholder="titre">
                                        </div>
                                        <div class="form-group">
                                        <label for="formGroupExampleInput2">Description</label>
                                        <input type="text" class="form-control" name="description" id="description" placeholder="une description">
                                        </div>
                                        <div class="form-group">
                                        <label for="formGroupExampleInput2">Fichier à charger</label>
                                        <input type="file" class="form-control" name="fileToUpload" id="fileToUpload" placeholder="une description">
                                        </div>
                                        <div class="form-group">
                                        <label for="formGroupExampleInput2">Saisir des tags (avec un '#' au début et des espaces)</label>
                                        <input type="text" class="form-control" name="tags" id="tags" placeholder="#famous #example">
                                        <button class='btn btn-info' type="submit" value="Upload Image" name="submit"> Upload Image </button>
                                </div>
                        </form>
                </div>
        </body>


        
</html>



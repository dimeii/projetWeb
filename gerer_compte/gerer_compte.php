<?php
    session_start();
?>
<html>

<head>
    <title>Gérer son compte</title>
    <link rel="stylesheet" type="text/css" media="screen" href="..\CSS\gere_compte..css" />
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
        // print_r($_SESSION);
        
    }else{
        header('Location: ../timeLine/pictures.php');;
    }

    if(isset($_POST)){
        print_r($_POST);
    }

    if(isset($_POST['newBio'])){
        include('functionsGererCompte.php'); 
    }
        
?>
    <div class="container-fluid">
        <div class="row">
            <div class="offset-lg-2 col-lg-9"><br>
                <h3 class="offset-lg-2">Gérer son compte</h3><br>
                <h6 class="offset-lg-2">Veuillez entrer les champs que vous désirez modifier :</h6><br>
                <form method="POST" action="#">
                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-lg">Nom d'artiste</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-lg" name="newArtistName" id="artistName" placeholder="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">Biographie</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control form-control-lg" name="newBio"id="colFormLabelLg" placeholder="">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="offset-md-2 col-md-4 mb-3">
                            <label>Mot de passe</label>
                            <input type="text" class="form-control" id="newMdp" name="newMdp" >
                        </div>

                        <div class="offset-md-1 col-md-4 mb-3">
                            <label>Confirmation mot de passe</label>
                            <input type="text" class="form-control" id="newMdpConf" name="newMdpConf" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label-lg">Email</label>
                        <div class="col-sm-10">
                        <input type="email" class="form-control form-control-lg" name="newMail" id="colFormLabel" placeholder="">
                        </div>
                    </div> 

                    
                
                    <button type="submit" class="btn btn-info offset-lg-2 offset-md-2 offset-sm-2">Modifier</button>
                    
                </form>
                
            </diV>
        </div>
    </div>

</body>
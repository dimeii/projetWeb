<html>

<head>
    <title>Inscription</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" media="screen" href="..\CSS\registration.css" />
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
        print_r($_POST)
    ?>
    <div class="container-fluid">
        <div class="registration">
            <h5 class="">Inscription</h5>
            <form method="POST" action="#">

                <div class="form-group">
                    <label for="idArtist">Artist identifiant</label>
                    <input type="text" class="form-control" id="idArtist" placeholder="Votre nom d'artiste" name="artistName">
                </div>

                <div class="form-group">
                    <label for="birth">Date de naissance</label>
                    <input type="date" class="form-control" id="birth">
                </div>

                

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                </div>

                <div class="form-group">
                    <label for="passwordControl">Confirmer votre mot de passe</label>
                    <input type="password" class="form-control" id="passwordControl" placeholder="Password">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Entrer votre email" name="email">

                </div>

                <div class="form-group">
                    <label for="firtName">Biographie</label>
                    <input type="text" class="form-control" id="firtName" placeholder="Votre biographie" name="biographie">
                </div>

                <button type="submit" class="btn btn-primary" id="submit" title="Veuillez remplir le formulaire." disabled="false">Submit</button>
            </form>


            <?php
                include('treatmentRegistration.php');
            ?>
        </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
    crossorigin="anonymous"></script>
    <script src="registration.js"></script>

</html>
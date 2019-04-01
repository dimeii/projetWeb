<?php
    session_start();
    
?>
<html>
<head>   
    <title> Connexion PICSURU</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
    <link rel="stylesheet" href="..\CSS\connexion.css">
        
        <link rel="stylesheet" href="..\bootstrap-4.2.1-dist\css\bootstrap.css">
</head>
<body>
    <?php
    // echo'SESSION :';
    //     // print_r($_SESSION);
    //     echo'POST :';
    //     print_r($_POST);
        if(!isset($_SESSION['idUser'])){
            // echo'pas  connecté.  ';
            if(isset($_POST['password'])){
                // print_r($_POST);
                $resConnexion =  include('treatmentConnexion.php');
                if($resConnexion){
                    $_SESSION['idUser'] = $resultat['idUser'];
                    $_SESSION['nomArtist'] = $resultat['nomArtist'];
                    header('Location: ../timeLine/timeLine.php');
                }
            }
        }
        else{
            header('Location: ../timeLine/timeLine.php');
            // echo'deja cnnecté';
        }
        
    ?>
    <!--
    <h2> Connectez-vous : </h2>
    <div class="container-fluid">
        <div class="row">
                <div class="offset-lg-5 offset-xs-3 offset-md-4 ">
                    <a href="../registration/registration.php"> <button class="btn btn-primary">Inscrivez-vous</button> </a>
                </div>
                
                <form class="offset-lg-5 offset-xs-3 offset-md-4 " method="post" action="connexion.php">
                    <div class="form-group ">
                        <label for="nomArtist">Nom d'artiste</label>
                        <input type="text" class="form-control" name="nomArtiste" id="nomArtiste" aria-describedby="artistHelp" placeholder="Entrer votre nom d'artiste">
                    </div>
                    <div class="form-group">
                        <label for="passWord">Mot de passe</label>
                        <input type="password" class="form-control" name="password" placeholder="Entrer votre mot de passe">
                    </div>
                        
                    <button type="submit" class="btn btn-primary">Connexion</button>
                    
                </form>
                
        </div>
    </div>
//-->

<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
                <h3>Connexion</h3>
                <!--
				<div class="d-flex justify-content-end social_icon">
					<span><i class="fab fa-facebook-square"></i></span>
					<span><i class="fab fa-google-plus-square"></i></span>
					<span><i class="fab fa-twitter-square"></i></span>
                </div>
                //-->
			</div>
			<div class="card-body">
				<form method="post" action="connexion.php">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" id="nomArtiste" name="nomArtiste" placeholder="nom de compte">
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" name="password" placeholder="password">
					</div>
					<div class="form-group">
						<input type="submit" value="Login" class="btn float-right login_btn">
					</div>
                    <div class="form-group">
						<a href="../timeLine/timeLine.php"  class="btn float-left login_btn"> Anonyme </a>
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Pas de compte?<a href="../registration/registration.php">Créer un compte!</a>
				</div>
			</div>
		</div>
	</div>
</div>
</body>

    

</html>
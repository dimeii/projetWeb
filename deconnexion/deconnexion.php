<?php
    //  destructions des sessions et redirection vers la page de connexion
    session_start();
    print_r($_SESSION);
    if(isset($_SESSION['nomArtist'])){
        
        session_destroy();
        header('Location: ../connexion/connexion.php');
    }
    
?>
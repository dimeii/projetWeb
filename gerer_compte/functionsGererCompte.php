<?php
    // change la bio
    function changeBio($newBio,$idUser,$bdd){

        $requete = $bdd->prepare('UPDATE `user` SET `bio` = :newBio WHERE `user`.`idUser` = :idUser;');
        $requete->bindValue(':newBio',htmlspecialchars($newBio));
        $requete->bindValue(':idUser',htmlspecialchars($idUser));
        $requete->execute();
        
    }  

    // change le mdp    
    function changeMdp($newMdp,$idUser,$bdd){
        $requete = $bdd->prepare('UPDATE `user` SET `mdp` = :newMdp WHERE `user`.`idUser` = :idUser;');
        $requete->bindValue(':newMdp',htmlspecialchars($newMdp));
        $requete->bindValue(':idUser',htmlspecialchars($idUser));
        $requete->execute();
        
    } 
    // change le mail
    function changeMail($newMail,$idUser,$bdd){

        $requete = $bdd->prepare('UPDATE `user` SET `mail` = :newMail WHERE `user`.`idUser` = :idUser;');
        $requete->bindValue(':newMail',htmlspecialchars($newMail));
        $requete->bindValue(':idUser',htmlspecialchars($idUser));
        $requete->execute();
        
    } 
    // change le nom dartist
    function changeArtistName($newArtistName,$idUser,$bdd){
        if(!(nomArtistLibre($newArtistName,$idUser,$bdd))){
            echo"Nom artist deja prit";
            return;
        }
        $requete = $bdd->prepare('UPDATE `user` SET `nomArtist` = :newArtistName WHERE `user`.`idUser` = :idUser;');
        $requete->bindValue(':newArtistName',htmlspecialchars($newArtistName));
        $requete->bindValue(':idUser',htmlspecialchars($idUser));
        if($requete->execute()){
            $_SESSION['nomArtist'] = $newArtistName;
            // echo $_SERVER['PHP_SELF'];
            echo '<meta http-equiv="refresh" content="0;URL='. $_SERVER['PHP_SELF'] .'">';
            // header('Location : '.$_SERVER['PHP_SELF']);
        }
    }
    // Verifie si le nom d'artiste n'est pas deja prit
    function nomArtistLibre($newArtistName,$idUser,$bdd){
        $requete = $bdd->prepare('SELECT COUNT(*) FROM `user` WHERE nomArtist = :newArtistName');
        $requete->bindValue(':newArtistName',htmlspecialchars($newArtistName));
        $requete->execute();
        $resultat = $requete->fetch(PDO::FETCH_NUM);
        print_r($resultat);
        return $resultat[0]==0;
    }



    try {
        $bdd = new PDO('mysql:host=localhost;dbname=picsuru;charset=utf8', 'root', '');
    } catch (Exception $e) {
        die('Erreur : impossible de se connecter a  la base de données, le site est inaccessible.');
        }

    try {
        if(isset($_POST['newBio']) && $_POST["newBio"] != null ){
            changeBio($_POST['newBio'],$_SESSION['idUser'], $bdd);
        }
        if(isset($_POST["newArtistName"]) && $_POST["newArtistName"] != null ){
            changeArtistName($_POST["newArtistName"],$_SESSION['idUser'],$bdd);
            
        }

        if(isset($_POST["newMdp"]) && $_POST["newMdp"] != null  && isset($_POST["newMdpConf"])){
            if($_POST["newMdp"] == $_POST["newMdpConf"]){
                changeMdp($_POST["newMdp"],$_SESSION['idUser'],$bdd);
            }
            else{
                echo'mots de passe pas identiques';
            }
        }

        if(isset($_POST["newMail"]) && $_POST["newMail"] != null){
            changeMail($_POST["newMail"],$_SESSION['idUser'],$bdd);
        }

    } catch (Exception $e) {
        die('Erreur : impossible .');
        }
        

        
    

?>  
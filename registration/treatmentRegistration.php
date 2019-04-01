<?php
// inscrit un utilisateur 
function inscription($artistName,$mdp,$mail,$bio,$bdd){

    $sql ="INSERT INTO `user` ( `nomArtist`, `mdp`, `mail`, `bio`) VALUES ( :nomArtist, :mdp, :mail, :bio);";

    $requete = $bdd->prepare($sql);
    $requete->bindValue(':nomArtist',htmlspecialchars($artistName));
    $requete->bindValue(':mdp',htmlspecialchars($mdp));
    $requete->bindValue(':mail',htmlspecialchars($bio));
    $requete->bindValue(':bio',htmlspecialchars($bio));
    if($requete->execute()){
        return 'Vous etes bien inscrit';
        header('Location : ../connexion/connexion.php');
    }else{
        return'Erreur dans l\'inscription';
    }
    

}


function nomArtistLibre($newArtistName,$bdd){
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

try{
    if(isset($_POST['artistName']) && nomArtistLibre($_POST['artistName'])){
        $retour = inscription($_POST['artistName'],$_POST['password'],$_POST['email'],$_POST['biographie'],$bdd);
        // echo'<h2 class"text-center"> '.$retour.'</h2>';
    }
    
}catch(Exception $e){
    echo"$e";
}


?>
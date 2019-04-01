<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=picsuru;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : impossible de se connecter a  la base de données, le site est inaccessible.');
    }
// effectue les verifs necessaires a la connexion : mdp similaires...
try{
    $sql='select * from user where nomArtist=:artistName';
    $requete= $bdd->prepare($sql);
    $requete->bindValue(':artistName',htmlspecialchars($_POST['nomArtiste']));
    $requete->execute();

    $resultat = $requete->fetch(PDO::FETCH_ASSOC);
     
    // print_r($resultat);
    if($resultat['mdp']== htmlspecialchars($_POST['password'])){
        echo"login et mdp bons";
        return $infosUser = array('idUser' => $resultat['idUser'],'nomArtist'=>$resultat['nomArtist'] );
    }
    else{
        echo"Nom d'artist ou mot de passe erroné.";
        return false;
    }
}catch(Exception $e){
    echo"$e";
}

?>
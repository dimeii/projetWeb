<?php
// recupere les infos de $nomArtist
function getArtist($nomArtist,$bdd){
    $sql = "SELECT * FROM `user` WHERE nomArtist = :nomArtist";
    $requete = $bdd->prepare($sql);
    $requete->bindValue(':nomArtist',$nomArtist);
    $requete->execute();
    $resultat = $requete->fetch(PDO::FETCH_ASSOC);
    return $resultat;    
}

// recupree les infos des images de l'artiste
function getDataImg($idArtist, $bdd){
    $sql = "SELECT path,idImage FROM `img` WHERE idUser = :idArtist";
    $requete = $bdd->prepare($sql);
    $requete->bindValue(':idArtist',$idArtist);
    $requete->execute();
    $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $resultat; 
}

// recupere le nombre de photo de l'artiste
function getNbPhoto($idArtist,$bdd){
    $sql = "SELECT COUNT(*) FROM `img` WHERE idUser = :idArtist";
    $requete = $bdd->prepare($sql);
    $requete->bindValue(':idArtist',$idArtist);
    $requete->execute();
    $resultat = $requete->fetch(PDO::FETCH_NUM);
    return $resultat;
}

try {
    $bdd = new PDO('mysql:host=localhost;dbname=picsuru;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : impossible de se connecter a  la base de données, le site est inaccessible.');
}


try{
    $nomArtist = htmlspecialchars($_GET['nomArtist']);
    $artist = getArtist($nomArtist,$bdd);
    $dataImages = getDataImg($artist['idUser'],$bdd);
    $nbPhoto = getNbPhoto($artist['idUser'],$bdd);
    // print_r($dataImages);

    echo'
    <div class="row">
                        
        <div class="infoCompte offset-lg-3 col-lg-5">
                <h1>Nom d\'artiste : '.$artist['nomArtist'].'</h1>
                <h2>Bio : '.$artist['bio'].'</h2>
        </div>
        <div class="nbPhoto col-lg-2">
                <h5>Nombre de photo :</h5>
                <h6>'.$nbPhoto[0].'</h6>
        </div>
    </div>
    <div class="row">
    <div class="contentProfil offset-lg-2 col-lg-8 offset-xs-1 col-xs-9">
    ';
    foreach ($dataImages as $key => $value) {
        echo'
            
                <div class="photo">
                    <a href="../picture/picture.php?img='.$value['idImage'] .'"> <img src="'.$value['path'].'"> </a>
                </div>
            
        ';
    }

    echo'
            </div>
        </div>
    ';

}catch(Exception $e){
    die('Erreur : impossible de trouver l\'artiste. ');
}

?>  
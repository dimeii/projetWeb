<?php
session_start();

// ajoute le commentaire à la table commentaire
function postComm($bdd,$idUser,$idImg,$valueComment){
    $sql = "INSERT INTO `commentaires` ( `commentaire`, `idImg`, `idUser`) VALUES ( :valueComment, :idImg, :idUser);";
    $requete= $bdd->prepare($sql);
    $requete->bindValue(':idImg',htmlspecialchars($idImg));
    $requete->bindValue(':idUser',htmlspecialchars($idUser));
    $requete->bindValue(':valueComment',htmlspecialchars($valueComment));
    // $requete->execute();
    if($requete->execute()){
        return "$sql";
    }
    else{
        return "$sql";
    }
}

// recupere le nom d'artist de $idUser
function getNomUser($idUser,$bdd){
    try{
        $sql="SELECT `nomArtist` FROM `user` WHERE idUser = $idUser";
        // echo $sql;
        $requete= $bdd->prepare($sql);
        $requete->execute();
        $resultat = $requete->fetch(PDO::FETCH_NUM);
        // print_r($resultat);
        return $resultat;
    }catch(Exception $e){
        echo"$e";
    }
}

try {
    $bdd = new PDO('mysql:host=localhost;dbname=picsuru;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : impossible de se connecter a  la base de données, le site est inaccessible.');
}


if( isset($_POST['idImg']) && isset($_POST['valueComment']) && isset($_SESSION['idUser']) ){
    $idImg = $_POST['idImg'];
    $valueComment = $_POST['valueComment'];
    $idUser = $_SESSION['idUser'];

    $resultPost = postComm($bdd,$idUser,$idImg,$valueComment);
    $nomArtist = getNomUser($idUser,$bdd);

}


echo json_encode(array(
    'success' => true,
    'idImage' => $idImg,
    'idUser'=> $idUser,
    'valueComment'=> $valueComment,
    'resultPost'=> $resultPost,
    'nomArtist' => $nomArtist,
));
?>
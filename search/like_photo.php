<?php
session_start();

// ajoute un like a l'image
function like($bdd,$idImg){
    try{
        $sql ="UPDATE `img` SET `nbLike` = `nbLike`+1 WHERE `img`.`idImage` = :idImg";
        $requete= $bdd->prepare($sql);
        $requete->bindValue(':idImg',htmlspecialchars($idImg));
        if($requete->execute()){
            return 1;
        }else{
            return -1;
        }
        // $requete->execute();
    }catch(Exception $e){
        echo"$e";
    }
}

// decremente les like a l'image
function unlike($bdd,$idImg){
    try{
        $sql ="UPDATE `img` SET `nbLike` = `nbLike`-1 WHERE `img`.`idImage` = :idImg";
        $requete= $bdd->prepare($sql);
        $requete->bindValue(':idImg',htmlspecialchars($idImg));
        $requete->execute();
    }catch(Exception $e){
        echo"$e";
    }
}

// verifie si le like existe
function testLikeExists($bdd,$idUser,$idImg){
    try{
        $sql ='select count(*) from likes where idUser=:idUser AND idImg=:idImg';
        $requete= $bdd->prepare($sql);
        $requete->bindValue(':idImg',htmlspecialchars($idImg));
        $requete->bindValue(':idUser',htmlspecialchars($idUser));
        // $requete->execute();
        if($requete->execute()){
            $resultat = $requete->fetch(PDO::FETCH_NUM);
            return $resultat[0];
        }
        else{
            return -1;
        }
        

    }catch(Exception $e){
        echo"$e";
    }
}

// ajoute un like a la table likes
function addLike($idImg,$idUser,$bdd){
    $sql="INSERT INTO `likes` (`idUser`, `idImg`) VALUES (:idUser, :idImg);";
    $requete= $bdd->prepare($sql);
    $requete->bindValue(':idImg',htmlspecialchars($idImg));
    $requete->bindValue(':idUser',htmlspecialchars($idUser));
    $requete->execute();
}

// supprime un like a la table likes
function deleteLike($idImg,$idUser,$bdd){
    $sql="DELETE from likes WHERE idUser=:idUser AND idImg=:idImg";
    $requete= $bdd->prepare($sql);
    $requete->bindValue(':idImg',htmlspecialchars($idImg));
    $requete->bindValue(':idUser',htmlspecialchars($idUser));
    $requete->execute();
}

// recupere le nombre de like
function getNbLike($idImg,$bdd){
    $sql ="SELECT nbLike from img where idImage=:idImg";
    $requete= $bdd->prepare($sql);
    $requete->bindValue(':idImg',htmlspecialchars($idImg));
    if($requete->execute()){
        $resultat = $requete->fetch(PDO::FETCH_NUM);
        return $resultat[0];
    }
    else{
        return -1;
    }


}


try {
    $bdd = new PDO('mysql:host=localhost;dbname=picsuru;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : impossible de se connecter a  la base de données, le site est inaccessible.');
    }


try{

   

    if(isset($_SESSION['idUser']) && isset( $_POST['idImg']) )
    {

        $idUser = $_SESSION['idUser'];
        $idImg = $_POST['idImg']; 

        $everLike = testLikeExists($bdd,$idUser,$idImg);
        if(!($everLike))
        {
            addLike($idImg,$idUser,$bdd);
            // like($bdd,$idImg);
            like($bdd,$idImg);
        }else{
            unlike($bdd,$idImg);
            deleteLike($idImg,$idUser,$bdd);
        }
        $nbLike = getNbLike($idImg,$bdd);
        // $testLike =testLikeExists($bdd,$idUser,$idImg);
        // like($bdd,$idImg);
        // addLike($idImg,$idUser,$bdd);
    }else if(!isset($_SESSION['idUser'])){
        // veuillez vous connecter
    }

    echo json_encode(array(
        'success' => true,
        'connecte' => isset($_SESSION['idUser']),
        'nbLike'=> $nbLike,
        // 'idUser'=>  $idUser,
        // 'idImg'=>$idImg,
        'everLike' => $everLike
    ));

}catch(Exception $e ){

}
    










?>
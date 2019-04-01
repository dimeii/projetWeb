<?php

// test si l'user a deja like cette image
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


// test si l'image existe 
function testImageExists($dataImg,$bdd){
    try{
        $sql="SELECT  COUNT(*) FROM `img` WHERE idImage = :dataImg";
        $requete = $bdd->prepare($sql);
        $requete->bindValue(':dataImg',htmlspecialchars($dataImg));
        $requete->execute();
        $resultat = $requete->fetch(PDO::FETCH_NUM);
        // print_r($resultat);
        return $resultat;
    }catch(Exception $e){
        echo"$e";
    }
}

// recupere les infos de l'image
function getImage($dataImg,$bdd){
    try{
        $sql="SELECT  * FROM `img` WHERE idImage = :dataImg";
        $requete = $bdd->prepare($sql);
        $requete->bindValue(':dataImg',htmlspecialchars($dataImg));
        $requete->execute();
        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        // print_r($resultat);
        return $resultat;
    }catch(Exception $e){
        echo"$e";
    }
}

// recupere le nom de $idUSer
function getNbUser($idUser,$bdd){
    try{
        $sql="SELECT count(*) FROM `user` WHERE idUser = $idUser";
        // echo $sql;
        $requete= $bdd->prepare($sql);
        $requete->execute();
        $resultat = $requete->fetch(PDO::FETCH_NUM);
        // print_r($resultat[0]);
        return $resultat;
    }catch(Exception $e){
        echo"$e";
    }
}


// recupere les commentaires d'une image
function getComm($bdd,$idImg){
    try{
        $sql="SELECT * FROM `commentaires` WHERE idImg = :idImg";
        // echo $sql;
        $requete= $bdd->prepare($sql);
        $requete->bindValue(':idImg',htmlspecialchars($idImg));
        $requete->execute();
        $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
        // print_r($resultat);
        return $resultat;
    }catch(Exception $e){
        echo"$e";
    }
}

// mets les commentaires dans une variable
function putCommInVar($arrayComm,$bdd){
    $res = '';
    foreach ($arrayComm as $key => $value) {
        $nomArtist = getNomUser($value['idUser'],$bdd);
        $res = $res.'<p class="card-text" >'.$nomArtist[0].' : '. $value['commentaire'] .' </p>';
    }
    // echo "$res";
    return $res;
}



// recupere le nom de $idUser
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

// recupere les tags de$idImg
function getTag($bdd,$idImg){

    $resFinal = array();

    $sql = "select idTag from tagimg where idImg =:idImg";
    $requete= $bdd->prepare($sql);
    $requete->bindValue(':idImg',htmlspecialchars($idImg));
    $requete->execute();
    $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
    // print_r($resultat);
    foreach ($resultat as $key => $value) {
        $sql2 = "select tag from tag where idTag=:idTag";
        $requete2= $bdd->prepare($sql2);
        // print_r($value);
        // echo $value['idTag'];
        $requete2->bindValue(':idTag',htmlspecialchars($value['idTag']));
        // echo"$sql2 || ";
        if($requete2->execute()){
            $resultat2 = $requete2->fetch(PDO::FETCH_NUM);
            // echo" execution requete";
            // echo"resultat2 ==". $resultat2[0];
            array_push($resFinal,$resultat2[0]);
        }else{
            echo"erreur execution requete";
        }
        
    }
    // print_r($resFinal);
    $charFinal = '';
    foreach ($resFinal as $key ) {
        $charFinal = $charFinal.' '.$key ;
    }
    // echo"$charFinal";
    return $charFinal;
}

// affiche une image
function afficheImage($dataImg,$bdd){
    $nomArtist = getNomUser($dataImg['idUser'],$bdd);

    // getNbUser($dataImg['idUser'],$bdd);

    $comm = getComm($bdd,$_GET['img']);
    $commInVar = putCommInVar($comm,$bdd);
    if(isset($_SESSION['idUser'])){

        $likeExists = testLikeExists($bdd,$_SESSION['idUser'],$dataImg['idImage']);

    }else{
        $likeExists = false;
    }
    
    $tags = getTag($bdd,$_GET['img']);

    $dejaLike = '
    
    <div class="card mb-0 offset-lg-3 col-lg-7">
        <div class="card-header">
            <a href="../profil/profil.php?nomArtist='.$nomArtist[0].'">   '.$nomArtist[0].' </a>
        </div>
        <div class="containerImg">
            <img src="'. $dataImg["path"] .'" class="card-img-top" alt="...">
        </div>
        <div class="card-body">

            <h5 class="card-title">'.$dataImg["titre"].' </h5>

            <div class="toLike" id="'. $dataImg['idImage'] .'">
                   <i class="fa fa-heart" aria-hidden="true"></i> '.$dataImg["nbLike"].' likes
            </div>

            <p class="card-text">'.$nomArtist[0].' : '.$dataImg["description"].'</p>
            <p class="card-text">'. $tags.'</p>
            
            <p class="card-text"><small class="text-muted">Posté le '.$dataImg["date"].'</small></p>
            <button id="myBtn" class="btn btn-info">Commenter ce post</button>
            </div>
        <div>
        <div class="comm">
               '.$commInVar.'
        </diV>
        <div class="card-footer text-center">
            <a href="../timeLine/timeLine.php">  Retour à l\'accueil  </a>
        </div>
    </div>
    
        ';
    $pasLike = '
    
    <div class="card mb-0 offset-lg-3 col-lg-7 ">
        <div class="card-header">
            <a href="../profil/profil.php?nomArtist='.$nomArtist[0].'">   '.$nomArtist[0].' </a>
        </div>
        <div class="containerImg">
            <img src="'. $dataImg["path"] .'" class="card-img-top" alt="...">
        </div>
        <div class="card-body">

            <h5 class="card-title " >'.$dataImg["titre"].' </h5>

            <div class="toLike" id="'. $dataImg['idImage'] .'">
               <i class="fa fa-heart-o" aria-hidden="true"></i> '.$dataImg["nbLike"].' likes
            </div>
            <p class="card-text">'.$nomArtist[0].' : '.$dataImg["description"].'</p>
            <p class="card-text">'. $tags.'</p>
            
            <p class="card-text"><small class="text-muted">Posté le '.$dataImg["date"].'</small></p>
            <button id="myBtn" class="btn btn-info">Commentez ce post </button>
        </div>
        <div class="comm">  
            '.$commInVar.'
        </diV>

        <div class="card-footer text-center">
            <a href="../timeLine/timeLine.php">  Retour à l\'accueil  </a>
        </div>
    </div>
    
        ';

        
        
        if($likeExists){
            echo $dejaLike;
        }
        else{
            echo $pasLike;
        }

        
        
}

try {
    $bdd = new PDO('mysql:host=localhost;dbname=picsuru;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : impossible de se connecter a  la base de données, le site est inaccessible.');
    }
try{
    $dataImg = $_GET['img'];
    if(testImageExists($dataImg,$bdd)[0] != 1){
        echo"Image inexistante";
        return;
    }
    $dataImg = getImage($dataImg,$bdd);
    // print_r($dataImg);
    afficheImage($dataImg,$bdd);
    getTag($bdd,$_GET['img']);
}catch (Exception $e) {
   echo "e";
}


?>











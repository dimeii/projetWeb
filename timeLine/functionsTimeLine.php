<?php

// teste si le like existe deja 
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

// recupere les infos de la photos
function getPhoto($bdd){
    try{
        $sql="SELECT DISTINCT * FROM `img` ORDER BY date DESC";
        $requete= $bdd->prepare($sql);
        $requete->execute();
        $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
        // print_r($resultat);
        return $resultat;
    }catch(Exception $e){
        echo"$e";
    }
}

// recupere les donnees de l'artist
function getArtist($bdd){
    try{
        $sql="SELECT DISTINCT * FROM `user`";
        $requete= $bdd->prepare($sql);
        $requete->execute();
        $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
        // print_r($resultat);
        return $resultat;
    }catch(Exception $e){
        echo"$e";
    }
}

// recupere le nom d'artiste $idUser
function getNomUser($idUser,$bdd){
    try{
        $sql="SELECT `nomArtist`, `idUser` FROM `user` WHERE idUser = $idUser";
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

// affiche une photo
function affichePhoto($photos,$bdd){

    foreach($photos as $key=>$value){
        $nomArtist = getNomUser($value['idUser'],$bdd);
        if(isset($_SESSION['idUser'])){
            $likeExists = testLikeExists($bdd,$_SESSION['idUser'],$value['idImage']);
        }else{
            $likeExists = false;
        }    
        
        // echo"idArtist => ".$_SESSION['idUser']. " | idImage => ".$value['idImage'];
        // echo" \n $likeExists";
        $dejaLike = '
        <div class="card mb-0">
            <div class="card-header">
                 <a href="../profil/profil.php?nomArtist='.$nomArtist[0].'">   '.$nomArtist[0].' </a>
            </div>
        <div class="containerImg">
            <a href="../picture/picture.php?img='. $value['idImage'] .'"> <img src="'. $value["path"] .'" class="card-img-top" alt="..."> </a>
        </div>
        <div class="card-body">
        
            <h5 class="card-title">'.$value["titre"].' </h5>
            
            <div class="toLike" id="'. $value['idImage'] .'">

                <i class="fa fa-heart" aria-hidden="true"> </i> '.$value["nbLike"].' likes

            </diV>

                <p class="card-text">'.$nomArtist[0].' : '.$value["description"].'</p>
            <p class="card-text"><small class="text-muted">Posté le '.$value["date"].'</small></p>
        </div>
        </div>
        
        ';
        $paslike = '
        <div class="card mb-0">
            <div class="card-header">
                 <a href="../profil/profil.php?nomArtist='.$nomArtist[0].'">   '.$nomArtist[0].' </a>
            </div>
        <div class="containerImg">
            <a href="../picture/picture.php?img='. $value['idImage'] .'"> <img src="'. $value["path"] .'" class="card-img-top" alt="..."> </a>
        </div>
        <div class="card-body">
        
            <h5 class="card-title">'.$value["titre"].' </h5>
            
            <div class="toLike" id="'. $value['idImage'] .'">

                <i class="fa fa-heart-o" aria-hidden="true"> </i> '.$value["nbLike"].' likes

            </diV>

                <p class="card-text">'.$nomArtist[0].' : '.$value["description"].'</p>
            <p class="card-text"><small class="text-muted">Posté le '.$value["date"].'</small></p>
        </div>
        </div>
        
        ';
        if($likeExists == "1"){
            echo"$dejaLike";
        }else{
            echo"$paslike";
        }
            
        
        
         
    }
}


try {
    $bdd = new PDO('mysql:host=localhost;dbname=picsuru;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : impossible de se connecter a  la base de données, le site est inaccessible.');
    }

try{
    $photos = getPhoto($bdd);
    $artists = getArtist($bdd);
    //print_r($photos);
    affichePhoto($photos,$bdd);
}catch (Exception $e) {
    die('Erreur : impossible d\'afficher les photos.');
}
//echo test();

?>
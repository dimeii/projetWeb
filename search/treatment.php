<?php

// affiche une photo
function affichePhoto($photos,$bdd){

    foreach($photos as $key=>$value){
        $nomArtist = getNomUser($value['idUser'],$bdd);    
        $likeExists = testLikeExists($bdd,$_SESSION['idUser'],$value['idImage']);
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

// affiche le profil
function afficheProfil($bdd,$data){
    
    echo'
        <div class="card">
            <div class="card-header">
                '. $data['nomArtist'] .'
            </div>
            <div class="card-body">
                <h5 class="card-title">'. $data['bio'] .'</h5>
                
                <a href="../profil/profil.php?nomArtist='. $data['nomArtist'] .'" class="btn btn-info">Voir le profil</a>
            </div>
        </div>
    ';
}




try {
    $bdd = new PDO('mysql:host=localhost;dbname=picsuru;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : impossible de se connecter a  la base de données, le site est inaccessible.');
    }


switch ($_GET['choixRecherche']){
    case 'artistName':{
        $sql = 'select * from user where nomArtist=:artistName';
        $requete = $bdd->prepare($sql);
        $requete->bindValue(':artistName',htmlspecialchars($_GET['researchChamp']));
		$requete->execute();
        $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
        if(empty($resultat)){
            echo'<h2 class="text-center">Il n\'y a pas de resultats pour votre recherche...</h2>' ;
            break;
        }else{
            echo'<h2 class="text-center">Il y a '. sizeof($resultat) .' de resultats à votre recherche :</h2>' ;
        }
        // print_r ($resultat);
        foreach ($resultat as $key => $value) {
            afficheProfil($bdd,$value);
        }
        
        break;
    }

    case 'tags':{
		#voir si il existe
		$tabTags = explode(" ", $_GET['researchChamp']);
		// print_r($tabTags);
		//selection des tags et des images associees
		foreach($tabTags as $ele){
			#recuperer l'id du tag
			$sql = "SELECT idTag FROM tag WHERE tag = '".$ele."'";
			//echo $sql;
			try{
				$requete = $bdd->prepare($sql);
				$requete->execute();
                $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
                if(empty($resultat)){
                    echo'<h2 class="text-center">Il n\'y a pas de resultats pour votre recherche...</h2>' ;
                    break;
                }else{
                    echo'<h2 class="text-center">Il y a '. sizeof($resultat) .' de resultats à votre recherche :</h2>' ;
                }
				// print_r($resultat);
			}catch(Exception $e){
				echo"$e";
			}
			
			
			
			#selection de l'id de l'image
			//echo $resultat[0]['idTag'];
			$sql = "SELECT idImg FROM tagimg WHERE idTag = '".$resultat[0]['idTag']."'";
			//echo $sql;
			try{
				$requete = $bdd->prepare($sql);
				$requete->execute();
				$resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
				//echo "<p></p>";
				//print_r($resultat);
			}catch(Exception $e){
				echo"$e";
			}
			
			
			#boucle sur chaque id image
			foreach($resultat as $element){
				$sql = "SELECT * FROM img WHERE idImage = '".$element['idImg']."'";
				//echo $sql;
				try{
					$requete = $bdd->prepare($sql);
					$requete->execute();
					$resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
				}catch(Exception $e){
					echo"$e";
				}	
			affichePhoto($resultat, $bdd); #recuperer tous les resultats et afficher plus tard....

			}			
		}
        break;
    }

    case 'imageTitre':{
        $sql = "select * from img where titre=:titre";
        $requete = $bdd->prepare($sql);
        $requete->bindValue(':titre',htmlspecialchars($_GET['researchChamp']));
		$requete->execute();
        $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
        if(empty($resultat)){
            echo'<h2 class="text-center">Il n\'y a pas de resultats pour votre recherche...</h2>' ;
            break;
        }else{
            echo'<h2 class="text-center">Il y a '. sizeof($resultat) .' de resultats à votre recherche :</h2>' ;
        }
        affichePhoto($resultat, $bdd); #recuperer tous les resultats et afficher plus tard....
        print_r ($resultat);
        break;
    }

    default:
        break;
}

/*
if($sql != NULL){
    $requete->execute();
    $resultat = $requete->fetch(PDO::FETCH_ASSOC);
}
*/

?>
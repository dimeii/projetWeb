
<?php
session_start();
//connection à la BDD
DEFINE('DB_USERNAME', 'root');
DEFINE('DB_PASSWORD', '');
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_DATABASE', 'picsuru');

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if (mysqli_connect_error()) {
  die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}

$target_dir = "../_images/"; // a changer par le nom du dossier
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Désolé le fichier existe déjà.";
    $uploadOk = 0;
}
// Check file size ; limite a 500ko
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Désolé le fichier est trop gros";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    echo "Désolé seules les fichiers au format jpg, pnj et jpeg sont acceptés.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Votre fichier ne correspond pas.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Désolé, une erreur est arrivé lors de l'upload du fichier.";
    }
}

//Ajout de l'image dans la BDD
//preparation des donnees a inserer
$titre = $_POST["titre"];
$description = $_POST["description"];
$date = date("Y-m-d");
$path = $target_file;
$idUser = $_SESSION['idUser'];  
$tags   = $_POST['tags'];
$tagsTab = explode(" ",$tags); //tags dans un tableau

echo'------';
echo date("Y-m-d");;
echo'------';

//insertion dans le tableau image
$sql = "INSERT INTO img (titre, description, date, path, idUser,nbLike)
VALUES ('".$titre."','".$description."',CURRENT_DATE(),'".$path."',".$idUser.",0)";

if ($mysqli->query($sql) === TRUE) {
    echo "New record created successfully";
    echo'<a href="../timeLine/timeLine.php" > <button class="btn btn-primary"> Retour à l\'accueil </button> </a>  ';
    // header('Location: ../timeLine/timeLine.php.php');
} else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
}

#insertion dans la table tagimg
//verifier que le tag existe ; si existe recuperer l'id et inserer dans la table tagimg le couple 
//idtag et idimg
//si n'existe pas, l'ajouter à la table tag et inserer dans la table tagimg le couple idtag et idimg

function getIdImage(&$mysqli){
	//selection de l'id de la derniere image ajouter
	$sql = "SELECT idImage FROM img ORDER BY idImage DESC";
	$res = $mysqli->query($sql);
	$row = $res->fetch_array(MYSQLI_NUM);
	//print_r($row);
	return $row[0];//recuperer l'id de la derniere image
}

function getIdTag(&$mysqli){
	//selection de l'id de la derniere image ajouter
	$sql = "SELECT idTag FROM tag ORDER BY idTag DESC";
	$res = $mysqli->query($sql);
	$row = $res->fetch_array(MYSQLI_NUM);
	return $row[0];//recuperer l'id de la derniere image
}

//ajout des tag dans la BDD
foreach($tagsTab as $ele){
		echo $ele;
		$sql = "SELECT idTag FROM tag where tag = '".$ele."'";
		$result = $mysqli->query($sql);		
		if($result->num_rows != 0){
			$idImage = getIdImage($mysqli);//recuperer l'id de l'image pour insertion
			echo $idImage;
			$row = $result->fetch_array(MYSQLI_NUM);//recuperation de l'id du tag existant
			echo $row[0];
			$sql = "INSERT INTO tagimg VALUES ('".$row[0]."', '".$idImage."')";
			if ($mysqli->query($sql) === TRUE){
				echo "New record created successfully";
			}else{
				echo "Erreur lors de la mise à jour de la table tagIMG";
			}
			$result->free();
		//le tag n'existe pas
		}else{
			$sql = "INSERT INTO tag (tag) VALUES ('".$ele."')";//insertion du nouveau tag
			if ($mysqli->query($sql) === TRUE){
				echo "New record created successfully";
			}else{
				echo "Erreur lors de l'ajout du nouveau tag";
			}	
			$idTag = getIdTag($mysqli);//recuperation de l'id du tag
			$idImage = getIdImage($mysqli);//recuparation de l'id de l'image	
			echo $idImage;
			echo $idTag;
			$sql = "INSERT INTO tagimg VALUES ('".$idTag."', '".$idImage."')";
			if ($mysqli->query($sql) === TRUE){
				echo "New record created successfully";
			}else{
				echo "Erreur lors de la mise à jour de la table tagIMG";
			}			
		}	
}
$mysqli->close();
header('Location: ../timeLine/timeLine.php');
?>

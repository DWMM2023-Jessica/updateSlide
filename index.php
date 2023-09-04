<?php
include 'Class/DbConnect.php';
$db = new DbConnect;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <section class="main">
        <nav>
            <ul>
                <a href="index.php?page=realisation&command=modifier&categorie=RenovMur"><li>Rénovation des murs</li></a>
                <a href="index.php?page=realisation&command=modifier&categorie=PeintureInt"><li>Peinture Intérieur</li></a>
                <a href="index.php?page=realisation&command=modifier&categorie=RevetMur"><li>Revêtement des Murs</li></a>
                <a href="index.php?page=realisation&command=modifier&categorie=RevetSol"><li>Revêtement des Sols</li></a>
            </ul>
        </nav>
        <a href="index.php?page=realisation&command=modifier&categorie=All"><p class='afficher'>Afficher tout</p></a>
    
    <?php 
    
    
    if (isset($_GET['page'], $_GET['command'], $_GET['categorie']) && $_GET['page']='realisation' && $_GET['command']='modifier' && $_GET['categorie']=='All'){ 
        
        $resultAllChantier=$db->readAllSlide();
        foreach ($resultAllChantier as $resultAllChantierKey) {
            echo
                '<form method=\'POST\'><div class="cardupdate">
                <p>' .$resultAllChantierKey['nom_chantier'] .'</p>
                <div class="imageCardUpdate">
                    <div class="imageAvant">
                        <p>Avant</p>
                        <img src="' .$resultAllChantierKey['photo_av_chantier']. '" alt="">
                    </div>
                    <div class="imageApres">
                        <p>Après</p>
                        <img src="' .$resultAllChantierKey['photo_ap_chantier']. '" alt="">
                    </div>
                </div>
                <p>' .$resultAllChantierKey['description_chantier']. '</p>
                <div class="updOrDelete">
                    <input type="submit" name="Modifier' .$resultAllChantierKey['id_chantier']. '" value="Modifier">
                    <input type="submit" name="Supprimer' .$resultAllChantierKey['id_chantier']. '" value="Supprimer">
                    <input type="hidden" class="inputHidden" name="postSupprimer' .$resultAllChantierKey['id_chantier']. '" value="' .$resultAllChantierKey['id_chantier']. '">
                    <input type="hidden" name="oldImageAv" value="' .$resultAllChantierKey['photo_av_chantier']. '">
                    <input type="hidden" name="oldImageAp" value="' .$resultAllChantierKey['photo_ap_chantier']. '">';
                    if (isset($_POST['Supprimer' .$resultAllChantierKey['id_chantier']. ''])) {
                        $oldImageAvDelete=$_POST['oldImageAv'];
                        $oldImageApDelete=$_POST['oldImageAp'];
                        $idCardSelect=$_POST['postSupprimer' .$resultAllChantierKey['id_chantier']. ''];
                        $db->deleteCard($idCardSelect);
                        if($db){
                            unlink($oldImageAvDelete);
                            unlink($oldImageApDelete);
                        }
                    }
                    if (isset($_POST['Modifier' .$resultAllChantierKey['id_chantier']. ''])) {
                        $idCardSelect=$_POST['postSupprimer' .$resultAllChantierKey['id_chantier']. ''];
                        header("Location: index.php?page=realisation&command=modifier&card=$idCardSelect");
                    }
                echo '</div>
            </div></form>';
        }
    }

    if (isset($_GET['page'], $_GET['command'], $_GET['card']) && $_GET['page']='realisation' && $_GET['command']='modifier'){
        $idCardUpdate=$_GET['card'];
        $resultCardUpdate=$db->readAllSlideUpdate($idCardUpdate);
        foreach ($resultCardUpdate as $resultCardUpdateKey){
        echo
                '<form class="updateForm" method=\'POST\' enctype="multipart/form-data"><div class="cardupdate">
                <input type="text" name="updateNomInput" value="' .$resultCardUpdateKey['nom_chantier'] .'">
                <div class="imageCardUpdate">
                    <div class="imageAvant">
                        <p>Avant</p>
                        <img src="' .$resultCardUpdateKey['photo_av_chantier']. '" alt="">
                        <input type="file" name="uploadImgAv">
                        <input type="hidden" name="oldImageAv" value="' .$resultCardUpdateKey['photo_av_chantier']. '">
                    </div>
                    <div class="imageApres">
                        <p>Après</p>
                        <img src="' .$resultCardUpdateKey['photo_ap_chantier']. '" alt="">
                        <input type="file" name="uploadImgAp">
                        <input type="hidden" name="oldImageAp" value="' .$resultCardUpdateKey['photo_ap_chantier']. '">
                        
                    </div>
                </div>
                <input type="text" name="updateDescriptionInput" value="' .$resultCardUpdateKey['description_chantier'] .'">
                <div class="updOrDelete">
                    <input type="submit" name="Supprimer' .$resultCardUpdateKey['id_chantier']. '" value="Supprimer">
                    <input type="text" class="inputHidden" name="postSupprimer' .$resultCardUpdateKey['id_chantier']. '" value="' .$resultCardUpdateKey['id_chantier']. '">
                    <input type="submit" name="validerUpdate" value="Valider">
                    </div>
                </div></form>';
        }
        if (isset($_POST['validerUpdate'])){
            if ($_FILES['uploadImgAv']['name'] !=''){
            $nameFile=$_FILES['uploadImgAv']['name'];
            $tmpFile=$_FILES['uploadImgAv']['tmp_name'];
            $typeFile=$_FILES['uploadImgAv']['type'];
            $sizeFile=$_FILES['uploadImgAv']['size'];
            $errFile=$_FILES['uploadImgAv']['error'];
            $oldImageAv=$_POST['oldImageAv'];
            $extensions=['png','jpg','jpeg', 'gif'];
            $type=['image/png', 'image/jpg', 'image/jpeg', 'image/gif'];
            $extension=explode(".", $nameFile);
            $maxSize=10000000;

            
            if (in_array($typeFile, $type)) {
                if (count($extension)<= 2 && in_array(strtolower(end($extension)), $extensions)) {
                    if ($sizeFile <=  $maxSize && $errFile == 0) {
                        $newName=uniqid(). '.' . strtolower(end($extension));
                        $imgPath='./images/'.$newName;
                        if (move_uploaded_file($tmpFile, $imgPath)) {
                            $db->uploadimgUpdate($imgPath, $idCardUpdate);
                            if ($db && !empty($oldImageAv)) {
                                unlink($oldImageAv);
                            }
                            var_dump($newName);           
                            echo 'Upload effectué';
                        }
                        else{
                            echo 'Erreur';
                        }
                    }
                    else {
                        echo 'Erreur, vérifier la taille.';
                    }
                }
                else{
                    echo 'Merci de mettre un image';
                }
            }
            else {
                echo 'Type non autorisé.';
            }
            }
        
        if ($_FILES['uploadImgAp']['name'] !=''){
            $nameFile=$_FILES['uploadImgAp']['name'];
            $tmpFile=$_FILES['uploadImgAp']['tmp_name'];
            $typeFile=$_FILES['uploadImgAp']['type'];
            $sizeFile=$_FILES['uploadImgAp']['size'];
            $errFile=$_FILES['uploadImgAp']['error'];
            $oldImageAp=$_POST['oldImageAp'];
            $extensions=['png','jpg','jpeg', 'gif'];
            $type=['image/png', 'image/jpg', 'image/jpeg', 'image/gif'];
            $extension=explode(".", $nameFile);
            $maxSize=10000000;

            
            if (in_array($typeFile, $type)) {
                if (count($extension)<= 2 && in_array(strtolower(end($extension)), $extensions)) {
                    if ($sizeFile <=  $maxSize && $errFile == 0) {
                        $newName=uniqid(). '.' . strtolower(end($extension));
                        $imgPath='./images/'.$newName;
                        if (move_uploaded_file($tmpFile, $imgPath)) {
                            $db->uploadimgUpdate2($imgPath, $idCardUpdate);
                            if ($db && !empty($oldImageAp)) {
                                unlink($oldImageAp);
                            }
                            var_dump($newName);           
                            echo 'Upload effectué';
                        }
                        else{
                            echo 'Erreur';
                        }
                    }
                    else {
                        echo 'Erreur, vérifier la taille.';
                    }
                }
                else{
                    echo 'Merci de mettre un image';
                }
            }
            else {
                echo 'Type non autorisé.';
            }
            }
        
            $newTitle=$_POST['updateNomInput'];
            $newDescription=$_POST['updateDescriptionInput'];
            $db->update2($newTitle, $newDescription, $idCardUpdate);
            
            
        }

  }




    ?>
    </section>
</body>
</html>
<?php
ob_start();
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
        <nav>
            <ul>
                <a href="index.php?page=realisation&command=modifier&categorie=RenovMur"><li>Rénovation des murs</li></a>
                <a href="index.php?page=realisation&command=modifier&categorie=PeintureInt"><li>Peinture Intérieur</li></a>
                <a href="index.php?page=realisation&command=modifier&categorie=RevetMur"><li>Revêtement des Murs</li></a>
                <a href="index.php?page=realisation&command=modifier&categorie=RevetSol"><li>Revêtement des Sols</li></a>
            </ul>
        </nav>
        <a href="index.php?page=realisation&command=modifier&categorie=All"><p class='afficher'>Afficher tout</p></a>
    <section class='mainUpdateAdmin'>
    <?php 

    if (isset($_GET['page'], $_GET['command'], $_GET['categorie']) && $_GET['page']='realisation' && $_GET['command']='modifier' && $_GET['categorie']=='RenovMur'){
        ?><section class='chantierAfficheUpdate'>
            <p class='titleAffiche'>Chantier Affiches</p>
        <div class="slideChantierUpdate"><?php
        $resultAllChantier=$db->readAllSlideWhereAnd(1);
            if (($resultAllChantier[0]['position_chantier']!=1)){
                $db->insertUpdateParDefaut(1,1);
                header("Location: index.php?page=realisation&command=modifier&categorie=RenovMur");
            }
            var_dump($resultAllChantier);
            if (($resultAllChantier[1]['position_chantier']!=2)){
                $db->insertUpdateParDefaut(2,1);
                header("Location: index.php?page=realisation&command=modifier&categorie=RenovMur");
            }
            if (($resultAllChantier[2]['position_chantier']!=3)){
                $db->insertUpdateParDefaut(3,1);
                header("Location: index.php?page=realisation&command=modifier&categorie=RenovMur");
            }
            if (($resultAllChantier[3]['position_chantier']!=4)){
                $db->insertUpdateParDefaut(4,1);
                header("Location: index.php?page=realisation&command=modifier&categorie=RenovMur");
            }
            if (($resultAllChantier[4]['position_chantier']!=5)){
                $db->insertUpdateParDefaut(5,1);
                header("Location: index.php?page=realisation&command=modifier&categorie=RenovMur");
            }
            if (($resultAllChantier[5]['position_chantier']!=6)){
                $db->insertUpdateParDefaut(6,1);
                header("Location: index.php?page=realisation&command=modifier&categorie=RenovMur");
            }
        foreach ($resultAllChantier as $resultAllChantierKey) {
            echo
                '<form method=\'POST\' class=\'updateCardPost\'><div class="cardupdate">
                <div class="positionDiv">
                    <select name="selectChantierUpdate">
                    <option value="">Sélectionner un chantier</option>';

                foreach($resultAllChantier as $resultAllChantierKey2){
                    echo '<option value="'.$resultAllChantierKey2['id_chantier'].'">'.$resultAllChantierKey2['nom_chantier'].'</option>';
                }
            
            echo '<input type="submit" name="submitPosition" value="Valider">
                </div>
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
                        header("Refresh:0");
                    }
                    if (isset($_POST['Modifier' .$resultAllChantierKey['id_chantier']. ''])) {
                        $idCardSelect=$_POST['postSupprimer' .$resultAllChantierKey['id_chantier']. ''];
                        header("Location: index.php?page=realisation&command=modifier&card=$idCardSelect");
                    }
                echo '</div>
            </div></form>';
        }
        echo '</div></section>';

        if (isset($_POST['submitPosition'])){
            $idChantierToReplace=$_POST['selectChantierUpdate'];

            
        }

    }

    if (isset($_GET['page'], $_GET['command'], $_GET['categorie']) && $_GET['page']='realisation' && $_GET['command']='modifier' && $_GET['categorie']=='PeintureInt'){
        ?><section class='chantierAfficheUpdate'>
            <p class='titleAffiche'>Chantier Affiches</p>
        <div class="slideChantierUpdate"><?php
        $resultAllChantier=$db->readAllSlideWhere(2);
        foreach ($resultAllChantier as $resultAllChantierKey) {
            echo
            
                '<form method=\'POST\' class=\'updateCardPost\'><div class="cardupdate">
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
        echo '</div></section>';
    }

    if (isset($_GET['page'], $_GET['command'], $_GET['categorie']) && $_GET['page']='realisation' && $_GET['command']='modifier' && $_GET['categorie']=='RevetMur'){
        ?><section class='chantierAfficheUpdate'>
            <p class='titleAffiche'>Chantier Affiches</p>
        <div class="slideChantierUpdate"><?php
        $resultAllChantier=$db->readAllSlideWhere(3);
        foreach ($resultAllChantier as $resultAllChantierKey) {
            echo
                '<form method=\'POST\' class=\'updateCardPost\'><div class="cardupdate">
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
        echo '</div></section>';
    }

    if (isset($_GET['page'], $_GET['command'], $_GET['categorie']) && $_GET['page']='realisation' && $_GET['command']='modifier' && $_GET['categorie']=='RevetSol'){
        ?><section class='chantierAfficheUpdate'>
            <p class='titleAffiche'>Chantier Affiches</p>
        <div class="slideChantierUpdate"><?php
        $resultAllChantier=$db->readAllSlideWhere(4);
        foreach ($resultAllChantier as $resultAllChantierKey) {
            echo
                '<form method=\'POST\' class=\'updateCardPost\'><div class="cardupdate">
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
        echo '</div></section>';
    }
    
    if (isset($_GET['page'], $_GET['command'], $_GET['categorie']) && $_GET['page']='realisation' && $_GET['command']='modifier' && $_GET['categorie']=='All'){ 
        
        $resultAllChantier=$db->readAllSlide();
        foreach ($resultAllChantier as $resultAllChantierKey) {
            echo
                '<form method=\'POST\' class=\'updateCardPost\'><div class="cardupdate">
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
                    
                echo '</div>
            </div></form>';
        }
        if (isset($_POST['Modifier' .$resultAllChantierKey['id_chantier']. ''])) {
            $idCardSelect=$_POST['postSupprimer' .$resultAllChantierKey['id_chantier']. ''];
            header("Location: index.php?page=realisation&command=modifier&card=$idCardSelect");
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



ob_end_flush();
    ?>
    </section>
</body>
</html>
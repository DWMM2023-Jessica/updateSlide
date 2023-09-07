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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Average+Sans&family=Besley&display=swap" rel="stylesheet"> 
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


                                                    //RENOVATION DES MURS//

                                                    
    if (isset($_GET['page'], $_GET['command'], $_GET['categorie']) && $_GET['page']='realisation' && $_GET['command']='modifier' && $_GET['categorie']=='RenovMur'){
        ?><section class='chantierAfficheUpdate'>
            <p class='titleAffiche'>Chantier Affiches</p>
        <div class="slideChantierUpdate"><?php
        $all=$db->readAllSlideWhere(1);
        $resultAllChantier=$db->readAllSlideWhereAnd(1);
        $position1=$db->readAllSlideWherePosition(1,1);
        $position2=$db->readAllSlideWherePosition(1,2);
        $position3=$db->readAllSlideWherePosition(1,3);
        $position4=$db->readAllSlideWherePosition(1,4);
        $position5=$db->readAllSlideWherePosition(1,5);
        $position6=$db->readAllSlideWherePosition(1,6);
            if (empty($position1)){
                $db->insertUpdateParDefaut(1,1);
                header("Refresh:0");
            }
            if (empty($position2)){
                $db->insertUpdateParDefaut(2,1);
                header("Refresh:0");
            }
            if (empty($position3)){
                $db->insertUpdateParDefaut(3,1);
                header("Refresh:0");
            }
            if (empty($position4)){
                $db->insertUpdateParDefaut(4,1);
                header("Refresh:0");
            }
            if (empty($position5)){
                $db->insertUpdateParDefaut(5,1);
                header("Refresh:0");
            }
            if (empty($position6)){
                $db->insertUpdateParDefaut(6,1);
                header("Refresh:0");
            }
        foreach ($resultAllChantier as $resultAllChantierKey) {
            echo
                '<form method=\'POST\' class=\'updateCardPost\'>
                <div class="positionDiv">
                    <select name="selectChantierUpdate' .$resultAllChantierKey['id_chantier']. '">
                    <option value="">Sélectionner un chantier</option>';

                foreach($all as $allKey){
                    echo '<option value="'.$allKey['id_chantier'].'">'.$allKey['nom_chantier'].'</option>';
                }
            
            echo '<input type="submit" name="submitPosition' .$resultAllChantierKey['id_chantier']. '" value="Valider">
                </div>
                <p>' .$resultAllChantierKey['nom_chantier'] .'</p>
                <div class="imageCardUpdate">
                    <div class="imageAvant">
                        <p>Avant</p>
                        <div class="imageDivUpdate">
                            <img src="' .$resultAllChantierKey['photo_av_chantier']. '" alt="">
                        </div>
                    </div>
                    <div class="imageApres">
                        <p>Après</p>
                        <div class="imageDivUpdate">
                            <img src="' .$resultAllChantierKey['photo_ap_chantier']. '" alt="">
                        </div>
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
                        if($db && !empty($oldImageApDelete) && !empty($oldImageAvDelete)){
                            unlink($oldImageAvDelete);
                            unlink($oldImageApDelete);
                        }
                        header("Refresh:0");
                    }
                    if (isset($_POST['submitPosition' .$resultAllChantierKey['id_chantier']. ''])){
                        
                        $idChantierToReplace1=$_POST['selectChantierUpdate' .$resultAllChantierKey['id_chantier']. ''];
                        $idChantierToReplace2=$_POST['postSupprimer' .$resultAllChantierKey['id_chantier']. ''];
                        var_dump($idChantierToReplace2);
                        var_dump($idChantierToReplace1);
                        if (!empty($idChantierToReplace1)) {
                            $positionChantierArray1=$db->selectPosition($idChantierToReplace1);
                        $positionChantierArray2=$db->selectPosition($idChantierToReplace2);
                        $positionChantier1=$positionChantierArray1[0]['position_chantier'];
                        $positionChantier2=$positionChantierArray2[0]['position_chantier'];
                            $db->updatePosition($positionChantier1, $idChantierToReplace2);
                            $db->updatePosition($positionChantier2, $idChantierToReplace1); 
                            header("Refresh:0");
                        }
                    }
                    if (isset($_POST['Modifier' .$resultAllChantierKey['id_chantier']. ''])) {
                        $idCardSelect=$_POST['postSupprimer' .$resultAllChantierKey['id_chantier']. ''];
                        header("Location: index.php?page=realisation&command=modifier&card=$idCardSelect");
                    }
                echo '</div>
            </form>';
        }

        echo '</div></section>';

        
    }


                                                    //RENOVATION DES MURS//


                                                    //PEINTURE INTERIEUR//


    if (isset($_GET['page'], $_GET['command'], $_GET['categorie']) && $_GET['page']='realisation' && $_GET['command']='modifier' && $_GET['categorie']=='PeintureInt'){
        ?><section class='chantierAfficheUpdate'>
            <p class='titleAffiche'>Chantier Affiches</p>
        <div class="slideChantierUpdate"><?php
        $all=$db->readAllSlideWhere(2);
        $resultAllChantier=$db->readAllSlideWhereAnd(2);
        $position1=$db->readAllSlideWherePosition(2,1);
        $position2=$db->readAllSlideWherePosition(2,2);
        $position3=$db->readAllSlideWherePosition(2,3);
        $position4=$db->readAllSlideWherePosition(2,4);
        $position5=$db->readAllSlideWherePosition(2,5);
        $position6=$db->readAllSlideWherePosition(2,6);
            if (empty($position1)){
                $db->insertUpdateParDefaut(1,2);
                header("Refresh:0");
            }
            if (empty($position2)){
                $db->insertUpdateParDefaut(2,2);
                header("Refresh:0");
            }
            if (empty($position3)){
                $db->insertUpdateParDefaut(3,2);
                header("Refresh:0");
            }
            if (empty($position4)){
                $db->insertUpdateParDefaut(4,2);
                header("Refresh:0");
            }
            if (empty($position5)){
                $db->insertUpdateParDefaut(5,2);
                header("Refresh:0");
            }
            if (empty($position6)){
                $db->insertUpdateParDefaut(6,2);
                header("Refresh:0");
            }
        foreach ($resultAllChantier as $resultAllChantierKey) {
            echo
                '<form method=\'POST\' class=\'updateCardPost\'>
                <div class="positionDiv">
                    <select name="selectChantierUpdate' .$resultAllChantierKey['id_chantier']. '">
                    <option value="">Sélectionner un chantier</option>';

                foreach($all as $allKey){
                    echo '<option value="'.$allKey['id_chantier'].'">'.$allKey['nom_chantier'].'</option>';
                }
            
            echo '<input type="submit" name="submitPosition' .$resultAllChantierKey['id_chantier']. '" value="Valider">
                </div>
                <p>' .$resultAllChantierKey['nom_chantier'] .'</p>
                <div class="imageCardUpdate">
                    <div class="imageAvant">
                        <p>Avant</p>
                        <div class="imageDivUpdate">
                            <img src="' .$resultAllChantierKey['photo_av_chantier']. '" alt="">
                        </div>
                    </div>
                    <div class="imageApres">
                        <p>Après</p>
                        <div class="imageDivUpdate">
                            <img src="' .$resultAllChantierKey['photo_ap_chantier']. '" alt="">
                        </div>
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
                        if($db && !empty($oldImageApDelete) && !empty($oldImageAvDelete)){
                            unlink($oldImageAvDelete);
                            unlink($oldImageApDelete);
                        }
                        header("Refresh:0");
                    }
                    if (isset($_POST['submitPosition' .$resultAllChantierKey['id_chantier']. ''])){
                        
                        $idChantierToReplace1=$_POST['selectChantierUpdate' .$resultAllChantierKey['id_chantier']. ''];
                        $idChantierToReplace2=$_POST['postSupprimer' .$resultAllChantierKey['id_chantier']. ''];
                        var_dump($idChantierToReplace2);
                        var_dump($idChantierToReplace1);
                        if (!empty($idChantierToReplace1)) {
                            $positionChantierArray1=$db->selectPosition($idChantierToReplace1);
                        $positionChantierArray2=$db->selectPosition($idChantierToReplace2);
                        $positionChantier1=$positionChantierArray1[0]['position_chantier'];
                        $positionChantier2=$positionChantierArray2[0]['position_chantier'];
                            $db->updatePosition($positionChantier1, $idChantierToReplace2);
                            $db->updatePosition($positionChantier2, $idChantierToReplace1); 
                            header("Refresh:0");
                        }
                    }
                    if (isset($_POST['Modifier' .$resultAllChantierKey['id_chantier']. ''])) {
                        $idCardSelect=$_POST['postSupprimer' .$resultAllChantierKey['id_chantier']. ''];
                        header("Location: index.php?page=realisation&command=modifier&card=$idCardSelect");
                    }
                echo '</div>
            </form>';
        }

        echo '</div></section>';
    }

                                                //PEINTURE INTERIEUR//

                                                //RENOVATION DES MURS//


    if (isset($_GET['page'], $_GET['command'], $_GET['categorie']) && $_GET['page']='realisation' && $_GET['command']='modifier' && $_GET['categorie']=='RevetMur'){
        ?><section class='chantierAfficheUpdate'>
            <p class='titleAffiche'>Chantier Affiches</p>
        <div class="slideChantierUpdate"><?php
        $all=$db->readAllSlideWhere(3);
        $resultAllChantier=$db->readAllSlideWhereAnd(3);
        $position1=$db->readAllSlideWherePosition(3,1);
        $position2=$db->readAllSlideWherePosition(3,2);
        $position3=$db->readAllSlideWherePosition(3,3);
        $position4=$db->readAllSlideWherePosition(3,4);
        $position5=$db->readAllSlideWherePosition(3,5);
        $position6=$db->readAllSlideWherePosition(3,6);
            if (empty($position1)){
                $db->insertUpdateParDefaut(1,3);
                header("Refresh:0");
            }
            if (empty($position2)){
                $db->insertUpdateParDefaut(2,3);
                header("Refresh:0");
            }
            if (empty($position3)){
                $db->insertUpdateParDefaut(3,3);
                header("Refresh:0");
            }
            if (empty($position4)){
                $db->insertUpdateParDefaut(4,3);
                header("Refresh:0");
            }
            if (empty($position5)){
                $db->insertUpdateParDefaut(5,3);
                header("Refresh:0");
            }
            if (empty($position6)){
                $db->insertUpdateParDefaut(6,3);
                header("Refresh:0");
            }
        foreach ($resultAllChantier as $resultAllChantierKey) {
            echo
                '<form method=\'POST\' class=\'updateCardPost\'>
                <div class="positionDiv">
                    <select name="selectChantierUpdate' .$resultAllChantierKey['id_chantier']. '">
                    <option value="">Sélectionner un chantier</option>';

                foreach($all as $allKey){
                    echo '<option value="'.$allKey['id_chantier'].'">'.$allKey['nom_chantier'].'</option>';
                }
            
            echo '<input type="submit" name="submitPosition' .$resultAllChantierKey['id_chantier']. '" value="Valider">
                </div>
                <p>' .$resultAllChantierKey['nom_chantier'] .'</p>
                <div class="imageCardUpdate">
                    <div class="imageAvant">
                        <p>Avant</p>
                        <div class="imageDivUpdate">
                            <img src="' .$resultAllChantierKey['photo_av_chantier']. '" alt="">
                        </div>
                    </div>
                    <div class="imageApres">
                        <p>Après</p>
                        <div class="imageDivUpdate">
                            <img src="' .$resultAllChantierKey['photo_ap_chantier']. '" alt="">
                        </div>
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
                        if($db && !empty($oldImageApDelete) && !empty($oldImageAvDelete)){
                            unlink($oldImageAvDelete);
                            unlink($oldImageApDelete);
                        }
                        header("Refresh:0");
                    }
                    if (isset($_POST['submitPosition' .$resultAllChantierKey['id_chantier']. ''])){
                        
                        $idChantierToReplace1=$_POST['selectChantierUpdate' .$resultAllChantierKey['id_chantier']. ''];
                        $idChantierToReplace2=$_POST['postSupprimer' .$resultAllChantierKey['id_chantier']. ''];
                        if (!empty($idChantierToReplace1)) {
                            $positionChantierArray1=$db->selectPosition($idChantierToReplace1);
                        $positionChantierArray2=$db->selectPosition($idChantierToReplace2);
                        $positionChantier1=$positionChantierArray1[0]['position_chantier'];
                        $positionChantier2=$positionChantierArray2[0]['position_chantier'];
                            $db->updatePosition($positionChantier1, $idChantierToReplace2);
                            $db->updatePosition($positionChantier2, $idChantierToReplace1); 
                            header("Refresh:0");
                        }
                    }
                    if (isset($_POST['Modifier' .$resultAllChantierKey['id_chantier']. ''])) {
                        $idCardSelect=$_POST['postSupprimer' .$resultAllChantierKey['id_chantier']. ''];
                        header("Location: index.php?page=realisation&command=modifier&card=$idCardSelect");
                    }
                echo '</div>
            </form>';
        }

        echo '</div></section>';
        ?><section class='chantierAfficheUpdate2'>
            <p class='titleAffiche'>Chantier Disponible</p>
        <div class="slideChantierUpdate"><?php
        $resultChantierDispo=$db->readAllSlideWhereAnd2(3);
        foreach ($resultChantierDispo as $resultChantierDispoKey) {
            echo
                '<form method=\'POST\' class=\'updateCardPost\'>
                <div class="positionDiv">
                    <select name="selectChantierUpdate' .$resultChantierDispoKey['id_chantier']. '">
                    <option value="">Sélectionner un chantier</option>';

                foreach($all as $allKey){
                    echo '<option value="'.$allKey['id_chantier'].'">'.$allKey['nom_chantier'].'</option>';
                }
            
            echo '<input type="submit" name="submitPosition2' .$resultChantierDispoKey['id_chantier']. '" value="Valider">
                </div>
                <p>' .$resultChantierDispoKey['nom_chantier'] .'</p>
                <div class="imageCardUpdate">
                    <div class="imageAvant">
                        <p>Avant</p>
                        <div class="imageDivUpdate">
                            <img src="' .$resultAllChantierKey['photo_av_chantier']. '" alt="">
                        </div>
                    </div>
                    <div class="imageApres">
                        <p>Après</p>
                        <div class="imageDivUpdate">
                            <img src="' .$resultAllChantierKey['photo_ap_chantier']. '" alt="">
                        </div>
                    </div>
                </div>
                <p>' .$resultChantierDispoKey['description_chantier']. '</p>
                <div class="updOrDelete">
                    <input type="submit" name="Modifier' .$resultChantierDispoKey['id_chantier']. '" value="Modifier">
                    <input type="submit" name="Supprimer' .$resultChantierDispoKey['id_chantier']. '" value="Supprimer">
                    <input type="hidden" class="inputHidden" name="postSupprimer' .$resultChantierDispoKey['id_chantier']. '" value="' .$resultChantierDispoKey['id_chantier']. '">
                    <input type="hidden" name="oldImageAv" value="' .$resultChantierDispoKey['photo_av_chantier']. '">
                    <input type="hidden" name="oldImageAp" value="' .$resultChantierDispoKey['photo_ap_chantier']. '">';
                    if (isset($_POST['Supprimer' .$resultChantierDispoKey['id_chantier']. ''])) {
                        $oldImageAvDelete=$_POST['oldImageAv'];
                        $oldImageApDelete=$_POST['oldImageAp'];
                        $idCardSelect=$_POST['postSupprimer' .$resultChantierDispoKey['id_chantier']. ''];
                        $db->deleteCard($idCardSelect);
                        if($db && !empty($oldImageApDelete) && !empty($oldImageAvDelete)){
                            unlink($oldImageAvDelete);
                            unlink($oldImageApDelete);
                        }
                        header("Refresh:0");
                    }
                    if (isset($_POST['submitPosition2' .$resultChantierDispoKey['id_chantier']. ''])){
                        $idChantierToReplace1=$_POST['selectChantierUpdate' .$resultChantierDispoKey['id_chantier']. ''];
                        $idChantierToReplace2=$_POST['postSupprimer' .$resultChantierDispoKey['id_chantier']. ''];
                        if (!empty($idChantierToReplace1)) {
                            $positionChantierArray1=$db->selectPosition($idChantierToReplace1);
                        $positionChantierArray2=$db->selectPosition($idChantierToReplace2);
                        $positionChantier1=$positionChantierArray1[0]['position_chantier'];
                        $positionChantier2=$positionChantierArray2[0]['position_chantier'];
                            $db->updatePosition($positionChantier1, $idChantierToReplace2);
                            $db->updatePosition($positionChantier2, $idChantierToReplace1); 
                            header("Refresh:0");
                        }
                    }
                    if (isset($_POST['Modifier' .$resultChantierDispoKey['id_chantier']. ''])) {
                        $idCardSelect=$_POST['postSupprimer' .$resultChantierDispoKey['id_chantier']. ''];
                        header("Location: index.php?page=realisation&command=modifier&card=$idCardSelect");
                    }
                echo '</div>
            </form>';
        }

        echo '</div></section>';
    }

                                        //REVETEMENT DES MURS//


                                        //REVETEMENT DES SOLS//


    if (isset($_GET['page'], $_GET['command'], $_GET['categorie']) && $_GET['page']='realisation' && $_GET['command']='modifier' && $_GET['categorie']=='RevetSol'){
        ?><section class='chantierAfficheUpdate'>
        <p class='titleAffiche'>Chantier Affiches</p>
    <div class="slideChantierUpdate"><?php
    $all=$db->readAllSlideWhere(4);
    $resultAllChantier=$db->readAllSlideWhereAnd(4);
    $position1=$db->readAllSlideWherePosition(4,1);
    $position2=$db->readAllSlideWherePosition(4,2);
    $position3=$db->readAllSlideWherePosition(4,3);
    $position4=$db->readAllSlideWherePosition(4,4);
    $position5=$db->readAllSlideWherePosition(4,5);
    $position6=$db->readAllSlideWherePosition(4,6);
        if (empty($position1)){
            $db->insertUpdateParDefaut(1,4);
            header("Refresh:0");
        }
        if (empty($position2)){
            $db->insertUpdateParDefaut(2,4);
            header("Refresh:0");
        }
        if (empty($position3)){
            $db->insertUpdateParDefaut(3,4);
            header("Refresh:0");
        }
        if (empty($position4)){
            $db->insertUpdateParDefaut(4,4);
            header("Refresh:0");
        }
        if (empty($position5)){
            $db->insertUpdateParDefaut(5,4);
            header("Refresh:0");
        }
        if (empty($position6)){
            $db->insertUpdateParDefaut(6,4);
            header("Refresh:0");
        }
    foreach ($resultAllChantier as $resultAllChantierKey) {
        echo
            '<form method=\'POST\' class=\'updateCardPost\'>
            <div class="positionDiv">
                <select name="selectChantierUpdate' .$resultAllChantierKey['id_chantier']. '">
                <option value="">Sélectionner un chantier</option>';

            foreach($all as $allKey){
                echo '<option value="'.$allKey['id_chantier'].'">'.$allKey['nom_chantier'].'</option>';
            }
        
        echo '<input type="submit" name="submitPosition' .$resultAllChantierKey['id_chantier']. '" value="Valider">
            </div>
            <p>' .$resultAllChantierKey['nom_chantier'] .'</p>
            <div class="imageCardUpdate">
                <div class="imageAvant">
                    <p>Avant</p>
                    <div class="imageDivUpdate">
                            <img src="' .$resultAllChantierKey['photo_av_chantier']. '" alt="">
                        </div>
                </div>
                <div class="imageApres">
                    <p>Après</p>
                    <div class="imageDivUpdate">
                            <img src="' .$resultAllChantierKey['photo_ap_chantier']. '" alt="">
                        </div>
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
                    if($db && !empty($oldImageApDelete) && !empty($oldImageAvDelete)){
                        unlink($oldImageAvDelete);
                        unlink($oldImageApDelete);
                        header("Refresh:0");
                    }
                    
                }
                if (isset($_POST['submitPosition' .$resultAllChantierKey['id_chantier']. ''])){
                    
                    $idChantierToReplace1=$_POST['selectChantierUpdate' .$resultAllChantierKey['id_chantier']. ''];
                    $idChantierToReplace2=$_POST['postSupprimer' .$resultAllChantierKey['id_chantier']. ''];
                    var_dump($idChantierToReplace2);
                    var_dump($idChantierToReplace1);
                    if (!empty($idChantierToReplace1)) {
                        $positionChantierArray1=$db->selectPosition($idChantierToReplace1);
                    $positionChantierArray2=$db->selectPosition($idChantierToReplace2);
                    $positionChantier1=$positionChantierArray1[0]['position_chantier'];
                    $positionChantier2=$positionChantierArray2[0]['position_chantier'];
                        $db->updatePosition($positionChantier1, $idChantierToReplace2);
                        $db->updatePosition($positionChantier2, $idChantierToReplace1); 
                        header("Refresh:0");
                    }
                }
                if (isset($_POST['Modifier' .$resultAllChantierKey['id_chantier']. ''])) {
                    $idCardSelect=$_POST['postSupprimer' .$resultAllChantierKey['id_chantier']. ''];
                    header("Location: index.php?page=realisation&command=modifier&card=$idCardSelect");
                }
            echo '</div></form>';
        
    }

    echo '</div></section>';
    }
    
    if (isset($_GET['page'], $_GET['command'], $_GET['categorie']) && $_GET['page']='realisation' && $_GET['command']='modifier' && $_GET['categorie']=='All'){ 
        
        $resultAllChantier=$db->readAllSlide();
        foreach ($resultAllChantier as $resultAllChantierKey) {
            echo
                '<form method=\'POST\' class=\'updateCardPost\'>
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


                                                        // PAGE POUR MODIFIER //




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
            header("Refresh:0"); 
        }
  }



ob_end_flush();
    ?>
    </section>
</body>
</html>
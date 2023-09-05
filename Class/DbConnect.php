<?php

include 'Class/Database.php';

class DbConnect extends Database{
    private $dbConnect;    


    public function __construct()
    {
        
        $this->dbConnect = Database::dbConnect();
    }

    public function readAllSlide()
    {
        $sql="SELECT * FROM `chantier`;";
        $stmt= $this->dbConnect->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readAllSlideWhereAnd($idtravaux)
    {
        $sql="SELECT * FROM `chantier` WHERE `id_travaux`=$idtravaux AND `position_chantier` IS NOT NULL ORDER BY `position_chantier` ASC;";
        $stmt= $this->dbConnect->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readAllSlideWhere($idtravaux)
    {
        $sql="SELECT * FROM `chantier` WHERE `id_travaux`=$idtravaux;";
        $stmt= $this->dbConnect->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteCard($idCardDelete){
        $sqlDeleteCard="DELETE FROM `chantier` WHERE `id_chantier`=$idCardDelete;";
        $stmtDeleteCard= $this->dbConnect->prepare($sqlDeleteCard);
        $stmtDeleteCard->execute();
        }
    
    public function readAllSlideUpdate($idCardUpdate){
    
        $sql="SELECT * FROM `chantier` WHERE `id_chantier`=$idCardUpdate;";
        $stmt= $this->dbConnect->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function uploadimgUpdate($imgPath, $idCardUpdate){
        $sql="UPDATE `chantier`
             SET `photo_av_chantier`='$imgPath' WHERE `id_chantier`=$idCardUpdate;";
        $stmt= $this->dbConnect->prepare($sql);
        $stmt->execute();
    }

    public function uploadimgUpdate2($imgPath, $idCardUpdate){
        $sql="UPDATE `chantier`
             SET `photo_ap_chantier`='$imgPath' WHERE `id_chantier`=$idCardUpdate;";
        $stmt= $this->dbConnect->prepare($sql);
        $stmt->execute();
    }

    public function update2($newTitle, $newDescription, $idCardUpdate){
        $sql="UPDATE `chantier`
        SET `nom_chantier`='$newTitle', `description_chantier`='$newDescription' WHERE `id_chantier`=$idCardUpdate;";
        $stmt= $this->dbConnect->prepare($sql);
        $stmt->execute();
    }

    public function insertUpdateParDefaut($positionParDefaut,$idtravaux){
        $sql="INSERT INTO `chantier`(`nom_chantier`, `description_chantier`, `position_chantier`, `id_travaux`) VALUES ('Chantier','Description','$positionParDefaut','$idtravaux');";
        $stmt= $this->dbConnect->prepare($sql);
        $stmt->execute();
    }

}   
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
        $sql="SELECT * FROM `chantier` WHERE `id_travaux`=$idtravaux AND `position_chantier`!=0 ORDER BY `position_chantier` ASC;";
        $stmt= $this->dbConnect->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readAllSlideWhereAnd2($idtravaux)
    {
        $sql="SELECT * FROM `chantier` WHERE `id_travaux`=$idtravaux AND `position_chantier`=0 ORDER BY `position_chantier` ASC;";
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
        SET `nom_chantier` = :newTitle, `description_chantier` = :newDescription WHERE `id_chantier` = :idCardUpdate;";
        $stmt= $this->dbConnect->prepare($sql);
        $stmt->bindParam(":newTitle", $newTitle, PDO::PARAM_STR);
        $stmt->bindParam(":newDescription", $newDescription, PDO::PARAM_STR);
        $stmt->bindParam(":idCardUpdate", $idCardUpdate, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function insertUpdateParDefaut($positionParDefaut,$idtravaux){
        $sql="INSERT INTO `chantier`(`nom_chantier`, `description_chantier`, `position_chantier`, `id_travaux`) VALUES ('Chantier$positionParDefaut','Description par défaut','$positionParDefaut','$idtravaux');";
        $stmt= $this->dbConnect->prepare($sql);
        $stmt->execute();
    }

    public function readAllSlideWherePosition($idtravaux, $position)
    {
        $sql="SELECT * FROM `chantier` WHERE `id_travaux`=$idtravaux AND `position_chantier`=$position;";
        $stmt= $this->dbConnect->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectPosition($idChantierToReplace)
    {
        $sql="SELECT `position_chantier` FROM `chantier` WHERE `id_chantier`=$idChantierToReplace;";
        $stmt= $this->dbConnect->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updatePosition($positionChantier, $idChantier){
        $sql="UPDATE `chantier`
        SET `position_chantier`='$positionChantier' WHERE `id_chantier`=$idChantier;";
        $stmt= $this->dbConnect->prepare($sql);
        $stmt->execute();
    }

    public function deleteParDefaut($idtravaux){
        $sql="DELETE FROM `chantier` WHERE `description_chantier`='Description par défaut' AND `position_chantier`=0 AND `id_travaux`=$idtravaux;";
        $stmt= $this->dbConnect->prepare($sql);
        $stmt->execute();
        
    }

    public function countParDefaut($idtravaux){
        $sql="SELECT COUNT(*) FROM  `chantier` WHERE `description_chantier`='Description par défaut' AND `position_chantier`=0 AND `id_travaux`=$idtravaux;";
        $stmt= $this->dbConnect->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    
}   
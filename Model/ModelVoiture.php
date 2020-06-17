<?php
require_once 'DB_connect.php';


class ModelVoiture{
    private $id_voiture,$no_plaque, $marque, $nb_place, $prop_email, $date_disp_debut, $date_disp_fin, $prix_unit, $agence,$etat;


    public function __construct($no_plaque=NULL, $marque=NULL, $nb_place=NULL, $prop_email=NULL, $date_disp_debut=NULL, $date_disp_fin=NULL, $prix_unit=NULL,$agence=NULL,$etat=NULL)
    {
        // valeurs nulles si pas de passage de parametres
        if (!is_null($no_plaque)){
            $this->id_voiture=NULL;
            $this->no_plaque=$no_plaque;
            $this->marque=$marque;
            $this->nb_place=$nb_place;
            $this->prop_email=$prop_email;
            $this->date_disp_debut=$date_disp_debut;
            $this->date_disp_fin=$date_disp_fin;
            $this->prix_unit=$prix_unit;
            $this->agence=$agence;
            $this->etat=$etat;
        }
    }
    //return a statement object
    public static function returnSta($query){
        try{
            $db = DataBase::getInstance();
            $statement = $db->prepare($query);
            return $statement;
        }catch (PDOException $e) {
            printf("%s - %s\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }


    public static function readAll(){
        $query = "Select * From `voiture`";
        try {
            $statement = self::returnSta($query);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_CLASS,"ModelVoiture");
            return $result;
        } catch (PDOException $e) {
            printf("%s - %s\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    public static function readId($no_plaque){
        $query = "Select * From `voiture` WHERE no_plaque='$no_plaque'";
        try {
            $statement = self::returnSta($query);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_CLASS,"ModelVoiture");
            return $result;
        } catch (PDOException $e) {
            printf("%s - %s\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function readMyCars($email){
        $query = "Select * From `voiture` WHERE prop_email = :prop_email";
        try {
            $statement = self::returnSta($query);
            $statement->execute([
                'prop_email'=>$email
            ]);
            $result = $statement->fetchAll(PDO::FETCH_CLASS,"ModelVoiture");
            return $result;
        } catch (PDOException $e) {
            printf("%s - %s\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }


    //Update `voiture` Set date_disp_debut='2019-06-19',date_disp_fin='2019-07-19'
    //WHERE no_plaque='utt9999'
    public static function updateVoiture($column=array(),$data=array(),$plaque){
        $set = "SET ";
        for($i=0;$i<count($column)-1;$i++){
            $set .= $column[$i].'='."'".$data[$i]."', ";
        }
        $set .=$column[count($column)-1].'='."'".$data[count($column)-1]."'";
        $query ="UPDATE `voiture` ".$set.' '."WHERE no_plaque='$plaque'";
        try {
            self::returnSta($query)->execute();
            return true;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return false;
        }
    }

    //Au garage：1
    //en location：0
    //pas encore au garage ni en location：-1
    //checking
    public static function updateEtat($no_plaque,$etat){
        $query="UPDATE `voiture` SET etat='$etat' WHERE voiture.no_plaque='$no_plaque'";
        try{
            self::returnSta($query)->execute();
        }catch (PDOException $e){
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return FALSE;
        }

    }

    //DELETE FROM `parking` WHERE `parking`.`id_parking` = 1;
    public static function deleteVoiture($id){
        $query="Delete From voiture "."Where id_voiture='$id'";
        try {
            self::returnSta($query)->execute();
            return true;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return false;
        }
    }
    public static function select($select_list=array(),$select_table=array(),$where){//没测试
        $select_list_temp = implode(",",$select_list);
        $select_table_temp = implode(",",$select_table);
        $query="Select ".$select_list_temp." From $select_table_temp ".$where;
        try {
            $statement=self::returnSta($query);
            $statement->execute();
            $result = $statement->fetchAll(self::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            printf("%s - %s\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }


    //Pour lister tous les voitures disponibles
    //1：est reservée
    //0：en location
    //-1：expirée
    //-2：est annulée
    public static function listCars($date_debut,$date_fin,$nb_place,$agence){
        $query="SELECT * FROM voiture WHERE '$date_debut' >= voiture.date_disp_debut AND '$date_fin' <= voiture.date_disp_fin AND '$nb_place'<= voiture.nb_place
        AND voiture.agence ='$agence' AND voiture.etat='1' AND voiture.no_plaque NOT IN (SELECT location.no_plaque FROM location WHERE location.etat>='0' AND ((location.date_utili_debut BETWEEN '$date_debut' 
        AND '$date_fin') OR (location.date_utili_fin BETWEEN '$date_debut 'AND '$date_fin' )))";
        try{
            $statement=self::returnSta($query);
            $statement->execute();
            $results=$statement->fetchAll(PDO::FETCH_CLASS,"ModelVoiture");
            return $results;
        }catch (PDOException $e){
            printf("%s - %s\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    // VALUES (NULL, 'utt8888', 'zxy@utt.fr', 'lrk@utt.fr', '2019-05-26', '2019-05-31', '100');
    public static function insert($no_plaque,$marque,$nb_place,$prop_email,$date_disp_debut,$date_disp_fin,$prix_unit,$agence){
        $etat=-1;
        $query = "INSERT INTO `voiture` VALUES (:id_voiture,:no_plaque, :marque, :nb_place, :prop_email, :date_disp_debut, :date_disp_fin, :prix_unit,:agence, :etat)";
        try {
            $statement = self::returnSta($query);
            $statement->execute([
                'id_voiture'=>NULL,
                'no_plaque'=>$no_plaque,
                'marque'=>$marque,
                'nb_place'=>$nb_place,
                'prop_email'=>$prop_email,
                'date_disp_debut'=>$date_disp_debut,
                'date_disp_fin'=>$date_disp_fin,
                'prix_unit'=>$prix_unit,
                'agence'=>$agence,
                'etat'=>$etat
            ]);
            return true;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return false;
        }
    }
    
    public static function readCarsOutside(){
        $query="SELECT * FROM `voiture` WHERE etat='-1'";
        try {
            $statement = self::returnSta($query);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_CLASS,"ModelVoiture");
            return $result;
        } catch (PDOException $e) {
            printf("%s - %s\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    
    
    
    
public function getId(){
    return $this->id_voiture;
}
    
    
    public function getNumPlaque(){
    return $this->no_plaque;
    }
    public function getMarque(){
        return $this->marque;
    }
    public function getNbPlace(){
        return $this->nb_place;
    }
    public function getPropEmail(){
        return $this->prop_email;
    }
    public function getDateDebut(){
        return $this->date_disp_debut;
    }
    public function getDateFin(){
        return $this->date_disp_fin;
    }
    public function getPrixUnit(){
        return $this->prix_unit;
    }
    public function getAgence(){
        return $this->agence;
    }
    public function getEtat(){
        return $this->etat;
    }
    public function setNumPlaque($plaque){
        $this->no_plaque=$plaque;
    }
    public function setMarque($marque){
        $this->marque=$marque;
    }
    public function setNbPlace($nb){
        $this->nb_place=$nb;
    }
    public function setPropEmail($email){
        return $this->prop_email=$email;
    }
    public function setDateDebut($date){
        $this->date_disp_debut=$date;
    }
    public function setDateFin($date){
        $this->date_disp_fin=$date;
    }
    public function setPrixUnit($prix){
        $this->prix_unit=$prix;
    }
    public function setAgence($a){
        $this->agence=$a;
    }
    public function setEtat($e){
        $this->etat=$e;
    }
}
?>
<?php

require_once 'DB_connect.php';

class ModelSite {

    private $id_site, $num_site, $id_parking, $date_disp_debut, $date_disp_fin, $prix_unit, $adress, $nom_parking;

    public function __construct($id_site = NULL, $num_site = NULL, $id_parking = NULL, $date_disp_debut = NULL, $date_disp_fin = NULL, $prix_unit = NULL, $adresse = NULL, $nom_parking = NULL) {
        // valeurs nulles si pas de passage de parametres
        if (!is_null($id_site)) {
            $this->id_site = $id_site;
            $this->num_site = $num_site;
            $this->id_parking = $id_parking;
            $this->date_disp_debut = $date_disp_debut;
            $this->date_disp_fin = $date_disp_fin;
            $this->prix_unit = $prix_unit;
            $this->adress = $adresse;
            $this->nom_parking = $nom_parking;
        }
    }

    public static function returnSta($query) {
        try {
            $db = DataBase::getInstance();
            //echo("---DataBase : $query----\n");
            $statement = $db->prepare($query);
            return $statement;
        } catch (PDOException $e) {
            printf("%s - %s\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function readAll() {//成功test
        $query = "Select * From site";
        try {
            //echo("---DataBase : $query----\n");
            $statement = self::returnSta($query);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_CLASS, "ModelSite");
           // echo "<pre>";
           // print_r($result);
           // echo"</pre>";
            return $result;
        } catch (PDOException $e) {
            printf("%s - %s\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function readSite($id) {
        $query = "SELECT * FROM `site` WHERE id_site='$id'";
        try {
            $statement = self::returnSta($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelSite");
            // print_r($results);
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    //可租的车位List
    //测试成功
    public static function viewSites($date_debut, $date_fin, $label) {
        $query = "SELECT * FROM `site`,`parking` WHERE '$date_debut' >= site.date_disp_debut AND '$date_fin' <= site.date_disp_fin 
        AND parking.label LIKE '%$label%' AND site.id_parking=parking.id_parking AND site.id_site NOT IN (SELECT id_site FROM `locasite` WHERE ((locasite.date_debut BETWEEN '$date_debut' 
        AND '$date_fin') OR (locasite.date_fin BETWEEN '$date_debut 'AND '$date_fin' )) AND locasite.etat>='0')";
        try {
            $statement = self::returnSta($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelSite");
            //echo"<pre>";
            //print_r($results);
           // echo "</pre>";
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function updateSite($column = array(), $data = array(), $id) {
        $set = "Set ";
        for ($i = 0; $i < count($column) - 1; $i++) {
            $set .= $column[$i] . '=' . "'" . $data[$i] . "', ";
        }
        $set .= $column[count($column) - 1] . '=' . "'" . $data[count($column) - 1] . "'";
        $query = "Update `site` " . $set . ' ' . "WHERE id_site = '$id'";
        try {
            self::returnSta($query)->execute();
            //echo("sucessful update");
            return true;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return false;
        }
    }

    //DELETE FROM `parking` WHERE `parking`.`id_parking` = 1;
    public static function deleteSite($id) {//成功test
        $result = self::readSite($id);
        $id_parking = $result[2];
        $num = self::countSite($id_parking) - 1;
        $query = "Delete From `site` " . "Where id_site='$id'";
       // echo $query;
        try {
            self::returnSta($query)->execute();
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return false;
        }
        //删掉一个车位，停车场总个数也减去1
        ModelParking::updateParking(array("nb_site"), array($num));
        return true;
    }

    public static function select($select_list = array(), $select_table = array(), $where) {//没测试
        $select_list_temp = implode(",", $select_list);
        $select_table_temp = implode(",", $select_table);
        $query = "Select " . $select_list_temp . " From $select_table_temp " . $where;
        try {
            $statement = self::returnSta($query);
            $statement->execute();
            $result = $statement->fetchAll(self::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            printf("%s - %s\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function insert($get) {
        $lenth = count($get) - 4; //4的倍数
        $id_parking = $get['id_parking'];

        for ($i = 1; $i <= ($lenth) / 4; $i++) {
            $num_site = $get['num_site' . $i];
            $date_disp_debut = $get['date_disp_debut' . $i];
            $date_disp_fin = $get['date_disp_fin' . $i];
            $prix_unit = $get['prix_unit' . $i];
            $query = "INSERT INTO `site` VALUES (NULL, '$num_site', '$id_parking', '$date_disp_debut', '$date_disp_fin',  '$prix_unit')";
            try {
                $statement = self::returnSta($query);
                $statement->execute();
            } catch (PDOException $e) {
                printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
                return false;
            }
        }
        return 1;
    }

    public static function countSite($id_parking) {
        $query = "SELECT sum($id_parking) FROM `site` ";
        try {
            $statement = self::returnSta($query);
            $statement->execute();
            $rows = $statement->columnCount();
            $rowsCount = $rows[0];
            //echo "number of sites: " . $rowsCount;
            return $rowsCount;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public function getIdSite() {
        return $this->id_site;
    }

    public function getIdParking() {
        return $this->id_parking;
    }

    public function getPrix() {
        return $this->prix_unit;
    }

    public function getDateDebut() {
        return $this->date_disp_debut;
    }

    public function getDateFin() {
        return $this->date_disp_fin;
    }

    public function setIdSite($id) {
        $this->id_site = $id;
    }

    public function setIdParking($id) {
        $this->id_parking = $id;
    }

    public function setPrix($prix) {
        $this->prix_unit = $prix;
    }

    public function setDateDebut($date) {
        $this->date_disp_debut = $date;
    }

    public function setDateFin($date) {
        $this->date_disp_fin = $date;
    }

    public function getNumSite() {
        return $this->num_site;
    }

    public function getAdresse() {
        return $this->adress;
    }

    public function getNomPark() {
        return $this->nom_parking;
    }

}

?>
<?php

require_once 'DB_connect.php';

class ModelLocaSite {

    private $id_loca, $id_site, $prop_email, $date_debut, $date_fin, $prix_total, $etat,$adress;

    public function __construct($id_loca = NULL, $id_site = NULL, $prop_email = NULL, $date_debut = NULL, $date_fin = NULL, $etat = NULL,$adress=NULL) {
        // valeurs nulles si pas de passage de parametres
        if (!is_null($id_loca)) {
            $this->id_loca = $id_loca;
            $this->id_site = $id_site;
            $this->prop_email = $prop_email;
            $this->date_debut = $date_debut;
            $this->date_fin = $date_fin;
            $this->prix_total = 0;
            $this->etat = $etat;
            $this->adress=$adress;
        }
    }

    public static function returnSta($query) {
        try {
            $db = DataBase::getInstance();
           // echo("---DataBase : query : $query----\n");
            $statement = $db->prepare($query);
            return $statement;
        } catch (PDOException $e) {
            printf("%s - %s\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    //更新车位状态
    //1是被预定了
    //0是正在被租借中
    //-1是订单完成
    //-2是被取消的订单
    public static function updateEtat($id, $etat) {
        $query = "UPDATE `locasite` SET etat='$etat' WHERE id_loca='$id'";
        try {
            self::returnSta($query)->execute();
            return TRUE;
        } catch (PDOException $e) {
            printf("%s - %s\n", $e->getCode(), $e->getMessage());
            return FALSE;
        }
    }

    //预定车位
    //成功test
    public static function reservation($id_site, $email, $date_debut, $date_fin) {
        $results = ModelSite::readSite($id_site);
        foreach ($results as $v) {
            $prix_unit = $v->getPrix();
        }
        //比较开始时间和结束时间和预定天数
        //date("Y-m-d",strtotime("+1 day",strtotime("2011-02-04")));
        $days_reservation = round((strtotime($date_fin) - strtotime($date_debut)) / 3600 / 24) + 1; //预定的天数
        $prix_total = $days_reservation * $prix_unit; //计算预定好的价格
        //插入预定停车位的数据到locasite里
        self::insert($id_site, $email, $date_debut, $date_fin, $prix_total, "1");
    }

    //取消订单
    public static function cancel($id) {
        self::updateEtat($id, "-2");
    }

    public static function readAll() {//成功test
        $query = "Select * From `locasite`";
        try {
            //echo("---DataBase : readAll : $query----\n");
            $statement = self::returnSta($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelLocaSite");
            //echo("<pre>");
            //print_r($results);
            //echo("</pre>");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function readId($id) {
        $query = "Select * From `locasite` WHERE id_loca = :id_loca";
        try {
            //echo("---DataBase : readAll : $query----\n");
            $statement = self::returnSta($query);
            $statement->execute([
                'id_loca' => $id
            ]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelLocaSite");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    //用户还未完成订单，可以取消
    public static function readOrderUndone($email) {
        $query = "Select * From `locasite` WHERE prop_email = :prop_email AND date_fin>=date('Y-m-d') ";
        try {
            //echo("---DataBase : readAll : $query----\n");
            $statement = self::returnSta($query);
            $statement->execute([
                'prop_email' => $email
            ]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelLocaSite");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    //用户历史订单:包括已经完成的和取消的
    public static function readOrderOver($email) {
        $query = "Select * From `locasite` WHERE prop_email = :prop_email AND date_fin<date('Y-m-d') OR etat='-2'";
        try {
           // echo("---DataBase : readAll : $query----\n");
            $statement = self::returnSta($query);
            $statement->execute([
                'prop_email' => $email
            ]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelLocaSite");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function updateLocasite($column = array(), $data = array(), $where) {
        $set = "Set ";
        for ($i = 0; $i < count($column) - 1; $i++) {
            $set .= $column[$i] . '=' . "'" . $data[$i] . "', ";
        }
        $set .= $column[count($column) - 1] . '=' . "'" . $data[count($column) - 1] . "'";
        $query = "Update `locasite` " . $set . ' ' . $where;
        //echo $query;
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
    public static function deleteLocation($id_loca) {//成功test
        $query = "Delete From locasite " . "Where id_loca='$id_loca'";
        //echo $query;
        try {
            self::returnSta($query)->execute();
            //echo("sucessful delete '$id_loca'");
            return true;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return false;
        }
    }

    public static function select($select_list = array(), $select_table = array(), $where) {
        $select_list_temp = implode(",", $select_list);
        $select_table_temp = implode(",", $select_table);
        $query = "Select " . $select_list_temp . " From $select_table_temp " . $where;
        //echo $query;
        try {
            $statement = self::returnSta($query);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_CLASS);
            //echo("<pre>");
            //print_r($result);
            //echo("</pre>");
            return $result;
        } catch (PDOException $e) {
            printf("%s - %s\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function insert($num_site, $prop_email, $date_debut, $date_fin, $prix_total, $etat) {//成功test
        $query = "INSERT INTO `locasite` VALUE (:id_loca, :num_site, :prop_email, :date_debut, :date_fin, :prix_total, :etat)";
       // echo $query;
        try {
            $statement = self::returnSta($query);
            $statement->execute([
                'id_loca' => NULL,
                'num_site' => $num_site,
                'prop_email' => $prop_email,
                'date_debut' => $date_debut,
                'date_fin' => $date_fin,
                'prix_total' => $prix_total,
                'etat' => $etat
            ]);
            //echo("sucessful insert");
            return true;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return false;
        }
    }

    public static function readHistroySite($email) {
        $query = "SELECT * FROM `locasite`,`parking` ,`site` WHERE locasite.id_site=site.id_site AND site.id_parking=parking.id_parking AND prop_email = :prop_email";
        try {
            $statement = self::returnSta($query);
             $statement->execute([
                'prop_email' => $email
            ]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelLocaSite");
            //print_r($results);
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public function getId() {
        return $this->id_loca;
    }

    public function getIdSite() {
        return $this->id_site;
    }

    public function getUserEmail() {
        return $this->prop_email;
    }

    public function getDateDebut() {
        return $this->date_debut;
    }

    public function getDateFin() {
        return $this->date_fin;
    }

    public function getPrixTotal() {
        return $this->prix_total;
    }

    public function getEtat() {
        return $this->etat;
    }

    public function setId($id) {
        $this->id_loca = $id;
    }

    public function setIdSite($id) {
        $this->id_site = $id;
    }

    public function setUserEmail($email) {
        $this->prop_email = $email;
    }

    public function setDateDebut($date) {
        $this->date_debut = $date;
    }

    public function setDateFin($date) {
        $this->date_fin = $date;
    }

    public function setPrixTotal($prix) {
        $this->prix_total = $prix;
    }

    public function setEtat($e) {
        $this->etat = $e;
    }
    public function getAdress(){
        return $this->adress;
    }
}

?>
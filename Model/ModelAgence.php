<?php
require_once 'DB_connect.php';

class ModelAgence{
    private $nom_agence, $adress_agence;

    public function __construct($nom_agence = NULL, $adress_agence = NULL) {
        // valeurs nulles si pas de passage de parametres
        if (!is_null($nom_agence)) {
            $this->nom_agence = $nom_agence;
            $this->adress_agence = $adress_agence;
        }
    }

    public static function returnSta($query){
        try{
            $db = DataBase::getInstance();
           // echo("---DataBase : query : $query----\n");
            $statement = $db->prepare($query);
            return $statement;
        }catch (PDOException $e) {
            printf("%s - %s\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function readAll(){//成功test
        $query = "Select * From `agence`";
        try {
            //echo("---DataBase : readAll : $query----\n");
            $statement = self::returnSta($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelAgence");
           // echo("<pre>");
            //print_r($results);
            //echo("</pre>");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    public static function readAgence(){
        $query= "SELECT nom_agence FROM `agence`";
        try {
            $statement = self::returnSta($query);
            $statement->execute();
            $results = array();
            while ($tuple = $statement->fetch()) {
                $results[] = $tuple[0];
            }
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    public static function insertAgence($nom,$adress){
        $query ="INSERT INTO `agence` VALUES (:nom_agence, :adress_agence)";
        //echo $query;
        try {
            $statement = self::returnSta($query);
            $statement->execute([
                'nom_agence'=>$nom,
                'adress_agence'=>$adress
            ]);
            //echo("sucessful insert");
            return true;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return false;
        }
    }
    public static function deleteAgence($nom){
        $query="Delete From agence "."Where nom_agence='$nom'";
        //echo $query;
        try {
            self::returnSta($query)->execute();
            //echo("sucessful delete agence '$nom'");
            return true;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return false;
        }
    }
    public function getName(){
        return $this->nom_agence;
    }
    public function getAdress(){
        return $this->adress_agence;
    }
    public function setName($nom){
        $this->nom_agence=$nom;
    }
    public function setAdress($adress){
        $this->adress_agence=$adress;
    }

}
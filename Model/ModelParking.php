<?php
require_once 'DB_connect.php';


class ModelParking{//加了一个label
    private $id_parking, $label,$nom_parking, $adress, $nb_site;

    public function __construct($id_parking = NULL, $label=NULL,$adress = NULL, $nb_site = NULL) {
        // valeurs nulles si pas de passage de parametres
        if (!is_null($id_parking)) {
            $this->id_parking=$id_parking;
            $this->label=$label;
            $this->adress=$adress;
            $this->nb_site=$nb_site;
        }
    }

    public static function returnSta($query){
        try{
            $db = DataBase::getInstance();
            //echo("---DataBase :  $query----\n");
            $statement = $db->prepare($query);
            return $statement;
        }catch (PDOException $e) {
            printf("%s - %s\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function ListParking($label){//成功test
        $query = "Select * From `parking` WHERE label Like '$label'";
        //echo $query;
        try {
            $statement = self::returnSta($query);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_CLASS,"ModelParking");
            return $result;
        } catch (PDOException $e) {
            printf("%s - %s\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    public static function selectbyid(){//成功test
        $query = "Select * From `parking`";
       // echo $query;
        try {
           // echo("---DataBase : readAll : $query----\n");
            $statement = self::returnSta($query);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_CLASS,"ModelParking");
            return $result;
        } catch (PDOException $e) {
            printf("%s - %s\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    
    

    public static function readAll(){//成功test
        $query = "Select * From `parking`";
        //echo $query;
        try {
           // echo("---DataBase : readAll : $query----\n");
            $statement = self::returnSta($query);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_CLASS,"ModelParking");
            return $result;
        } catch (PDOException $e) {
            printf("%s - %s\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    public static function updateParking($column=array(),$data=array(),$where){//没测试
        $set = "Set ";
        for($i=0;$i<count($column)-1;$i++){
            $set .= $column[$i].'='."'".$data[$i]."', ";
        }
        $set .=$column[count($column)-1].'='."'".$data[count($column)-1]."'";
        $query ="Update `parking` ".$set.' '.$where;
        try {
            self::returnSta($query)->execute();
           // echo("sucessful update");
            return true;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return false;
        }
    }

    //2019-06-14改过
    public static function deleteParking($id){//成功test
        $query="Delete From parking "."Where id_parking='$id'";
        //echo $query;
        try {
            $statement=self::returnSta($query);
            $statement->execute();
            $nombreline = $statement->rowCount();
            if($nombreline == 0){
                return 'zero';
            }
            else{
                return 'done';
            }
            return true;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return false;
        }
    }
    

    public static function select($select_list=array(),$select_table=array(),$where){//没测试
        $select_list_temp= implode(",",$select_list);
        $select_table_temp = implode(",",$select_table);
        $query="Select ".$select_list_temp." From $select_table_temp ".$where;
        try {
            $statement=self::returnSta($query);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_CLASS,"ModelParking");
           // echo("<pre>");
          //  print_r($result);
          //  echo("</pre>");
            return $result;
        } catch (PDOException $e) {
            printf("%s - %s\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    //2019-06-14改了
    public static function insert($get){//成功test
        $query = "INSERT INTO `parking` VALUES (:id_parking, :label, :nom_parking, :adress, :nb_site)";
        //echo $query;
        try {
            $statement = self::returnSta($query);
            $statement->execute([
                'id_parking'=>NULL,
                'label'=>$get['label'],
                'nom_parking'=>$get['nom_parking'],
                'adress'=>$get['adress'],
                'nb_site'=>$get['nb_site']
            ]);
            return true;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return false;
        }
    }
    
    
    //2019-06-14新加的
    public static function getLastId(){
        $query="select id_parking from `parking` order by id_parking DESC limit 1";
        try{
            $statement=self::returnSta($query);
            $statement->execute();
            $id=-1;
            while ($tuple = $statement->fetch()) {
                $id = $tuple[0];
            }
            return $id;
        }catch (PDOException $e){
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public function where($where)
    {
        $this->filter .= $where;
    }
    public function getIdParking()
    {
        return $this->id_parking;
    }

    public function getNomParking(){
        return $this->nom_parking;
    }

    public function getAdress(){
        return $this->adress;
    }
    public function getLabel(){
        return $this->label;
    }


    
    
    
    public function getNbSite(){
        return $this->nb_site;
    }
    public function setIdPrking($id){
        $this->id_parking=$id;
    }
    public function setNomParking($nom){
        $this->nom_parking=$nom;
    }
    public function setAdress($adress){
        $this->adress=$adress;
    }
    public function setNbsite($nb){
        $this->nb_site=$nb;
    }

}
?>
<?php
require_once 'DB_connect.php';


class ModelLocation{
    private $id_location, $no_plaque, $prop_temp_email, $date_utili_debut, $date_utili_fin, $prix_total,$etat;

    public function __construct($id_location = NULL, $no_plaque = NULL,
                                $prop_temp_email = NULL, $date_utili_debut = NULL, $date_utili_fin = NULL,$etat=NULL) {
        // valeurs nulles si pas de passage de parametres
        if (!is_null($id_location)) {
            $this->id_location = $id_location;
            $this->no_plaque = $no_plaque;
            $this->prop_temp_email = $prop_temp_email;
            $this->date_utili_debut = $date_utili_debut;
            $this->date_utili_fin = $date_utili_fin;
            $this->prix_total = 0;
            $this->etat=$etat;
        }
    }

    public static function returnSta($query){
        try{
            $db = DataBase::getInstance();
            //echo("---DataBase : query : $query----\n");
            $statement = $db->prepare($query);
            return $statement;
        }catch (PDOException $e) {
            printf("%s - %s\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function readAll(){//成功test
        $query = "Select * From 'location'";
        try {
            //echo("---DataBase : readAll : $query----\n");
            $statement = self::returnSta($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelLocation");
            //echo("<pre>");
            //print_r($results);
            //echo("</pre>");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    //筛选出跟这个用户全部有关信息
    public static function readUser($email)
    {
        $query = "Select * From `location` WHERE prop_temp_email = :prop_temp_email";
        try {
            //echo("---DataBase : readUser : $query----\n");
            $statement = self::returnSta($query);
            $statement->execute([
                'prop_temp_email' => $email
            ]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelLocation");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }


    //DELETE FROM `parking` WHERE `parking`.`id_parking` = 1;
    public static function deleteLocament($id_location){//成功test
        $query="Delete From location "."Where id_location='$id_location'";
        //echo $query;
        try {
            self::returnSta($query)->execute();
            //echo("sucessful delete '$id_location'");
            return true;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return false;
        }
    }

    //        date("Y-m-d",strtotime("+1 day",strtotime("2011-02-04")));
    public static function reservation($no_plaque,$email,$date_debut,$date_fin){//传给我voiture的id和用户email和使用时间
        //计算价格，增加到location中
        $result=ModelVoiture::readId($no_plaque);
        foreach($result as $ob){
            $prix_unit=$ob->getPrixUnit();
        }
        $days_reservation = round((strtotime($date_fin) - strtotime($date_debut)) / 3600 / 24)+1;//预定的天数
        $prix_total=$days_reservation*$prix_unit;//计算预定好的价格
        //echo $prix_total;
        ModelLocation::insert("$no_plaque","$email","$date_debut","$date_fin",$prix_total,"1");

    }

    public static function insert($no_plaque, $prop_temp_email,
                                  $date_utili_debut, $date_utili_fin, $prix_total,$etat){//成功test
        $query = "INSERT INTO `location` VALUES (:id_location, :no_plaque, :prop_temp_email, :date_utili_debut, :date_utili_fin, :prix_total, :etat)";
        //echo $query;
        try {
            $statement = self::returnSta($query);
            $statement->execute([
                'id_location'=>NULL,
                'no_plaque'=>$no_plaque,
                'prop_temp_email'=>$prop_temp_email,
                'date_utili_debut'=>$date_utili_debut,
                'date_utili_fin'=>$date_utili_fin,
                'prix_total'=>$prix_total,
                'etat'=>$etat,
            ]);
            //echo("sucessful insert");
            return true;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return false;
        }
    }

    //UPDATE 表名称 SET 列名称 = 新值 WHERE 列名称 = 某值
    //用户取消订单就把etat设置成-2
    public static function cancel($id){
        $query="UPDATE `location` SET etat='-2' WHERE id_location=$id";
        try{
            $statement = self::returnSta($query);
            $statement->execute();
            //echo "cancel successfully";
            return TRUE;
        }catch (PDOException $e){
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return false;
        }
    }


    //来还车
    //检查完毕后，订单状态etat=-1，此订单过期
    //车的状态改变为1，在车库中
    public static function confirmationReturn($id,$no_plaque){
        $query="UPDATE `location` SET etat='-1' WHERE id_location='$id'";
        try{
            $statement = self::returnSta($query);
            $statement->execute();
            //车的状态变化改为1,在车库可租状态
            ModelVoiture::updateEtat($no_plaque,"1");
            return TRUE;
        }catch (PDOException $e){
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return false;
        }
    }
   


    //到了该还车日期但却还没有还车的订单
    //每日检查
    public static function checkLocation(){
        $today=date("Y-m-d",time());
        //echo "Today:".$today;
        $query="SELECT * From `location` WHERE date_utili_fin='$today' AND etat='0'";
        try{
            $results=self::returnSta($query)->execute();
            return $results;
        }catch (PDOException $e){
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return false;
        }
    }

    public static function select($select_list=array(),$select_table=array(),$where){
        $select_list_temp = implode(",",$select_list);
        $select_table_temp = implode(",",$select_table);
        $query="Select ".$select_list_temp." From $select_table_temp ".$where;
       // echo $query;
        try {
            $statement=self::returnSta($query);
            $statement->execute();
            $result = $statement->fetchAll(self::FETCH_ASSOC);
            //echo("<pre>");
            //print_r($result);
            //echo("</pre>");
            return $result;
        } catch (PDOException $e) {
            printf("%s - %s\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    //来借走车
    //订单状态etat=0租借中
    //车的状态改变为0，
    //2019-06-15 gaile
    public static function confirmationBorrow($no_plaque,$id){
        $query="UPDATE `location` SET etat='0' WHERE id_location='$id'";
        try{
            $statement = self::returnSta($query);
            $statement->execute();
            ModelVoiture::updateEtat($no_plaque,"0");
            return TRUE;
        }catch (PDOException $e){
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return false;
        }
    }
    
    //2019-06-15 xinjiade
    public static function readEtat($etat){
        $query="SELECT * FROM `location` WHERE etat='$etat'";
        try {
            $statement = self::returnSta($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelLocation");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    
    
    



    public function getIdLocation(){
        return $this->id_location;
    }
    public function getNumPlaque(){
        return $this->no_plaque;
    }
    public function getPropTempEmail(){
        return $this->prop_temp_email;
    }
    public function getDateDebut(){
        return $this->date_utili_debut;
    }
    public function getDateFin(){
        return $this->date_utili_fin;
    }
    public function getPrixTotal(){
        return $this->prix_total;
    }
    public function getEtat(){
        return $this->etat;
    }
    public function setIdLocation($id){
        $this->id_location=$id;
    }
    public function setPlaque($plaque){
        $this->no_plaque=$plaque;
    }
    public function setPropEmail($email){
        $this->proprietaire_email=$email;
    }
    public function setPropTempEmail($email){
        $this->prop_temp_email=$email;
    }
    public function setDateDebut($date){
        $this->date_utili_debut=$date;
    }
    public function setDateFin($date){
        $this->date_utili_fin=$date;
    }
    public function setPrixTotal($prix){
        $this->prix_total=$prix;
    }
    public function setEtat($e){
        $this->etat=$e;
    }
}
?>
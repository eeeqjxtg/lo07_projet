<?php
require_once 'DB_connect.php';
//include '../fragment/biblio_form.php';

class ModelUser extends DataBase
{
    private  $nom, $prenom, $passwd, $email, $phone;

    public function __construct($nom = NULL, $prenom = NULL, $passwd = NULL, $email = NULL, $phone = NULL) {
        // valeurs nulles si pas de passage de parametres
        if (!is_null($email)) {
            $this->nom=$nom;
            $this->prenom=$prenom;
            $this->passwd=$passwd;
            $this->email=$email;
            $this->phone;
        }
    }

    //return un statement object
    public static function returnSta($query){//成功test
        try{
            $db = DataBase::getInstance();
           // echo("---DataBase : readAll : $query----\n");
            $statement = $db->prepare($query);
            return $statement;
        }catch (PDOException $e) {
            printf("%s - %s\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function readAll(){//成功test
        $query = "Select * From utilisateur";
        try {
           //$db = DataBase::getInstance();
            //echo("---DataBase : readAll : $query----\n");
            $statement=self::returnSta($query);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_CLASS,"ModelUser");
            //echo("<pre>");
           // print_r($result);
            //echo("</pre>");
            return $result;
        } catch (PDOException $e) {
            printf("%s - %s\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    // $query = "insert into vin value (:id, :cru, :annee, :degre)";
    public static function insertUser($nom,$prenom,$passwd,$email,$phone){//成功test
        $query = "INSERT INTO `utilisateur` VALUES (:nom, :prenom, :passwd, :email, :phone)";
        try {
            self::returnSta($query)->execute([
                'nom'=>$nom,
                'prenom'=>$prenom,
                'passwd'=>$passwd,
                'email'=>$email,
                'phone'=>$phone
            ]);
            return true;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return false;
        }
    }

    //DELETE FROM `parking` WHERE `parking`.`id_parking` = 1;
    //$column=arry(),$data=array();
    public static function updateUser($column,$data,$email){//成功test
        $set = "Set ";
        for($i=0;$i<count($column)-1;$i++){
            $set .= $column[$i].'='."'".$data[$i]."', ";
        }
        $set .=$column[count($column)-1].'='."'".$data[count($column)-1]."'";
        $query ="Update `utilisateur` " .$set.' '."WHERE email='$email'";
       // echo $query;
        try {
            self::returnSta($query)->execute();
            return true;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return false;
        }
    }

    //DELETE FROM `parking` WHERE `parking`.`id_parking` = 1;
    public static function deleteUser($email){//成功test
        $query="Delete From utilisateur Where email='$email'";
        try {
            self::returnSta($query)->execute();
            //echo("sucessful delete '$email'");
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
       // echo $query;
        try {
            $statement=self::returnSta($query);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_CLASS,"ModelUser");
            return $result;
        } catch (PDOException $e) {
            printf("%s - %s\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public function getNom(){
        return $this->nom;
    }
    public function getPrenom(){
        return $this->prenom;
    }
    public function getPasswd(){
        return $this->passwd;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getPhone(){
        return $this->phone;
    }
    public function setNom($nom){
        $this->nom=$nom;
    }
    public function setPrenom($prenom){
        $this->prenom=$prenom;
    }
    public function setPasswd($passwd){
        $this->passwd=$passwd;
    }
    public function setEmail($email){
        $this->email=$email;
    }
    public function setPhone($phone){
        $this->phone=$phone;
    }

}





?>
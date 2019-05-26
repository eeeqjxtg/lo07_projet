<?php
require_once 'DB_connect.php';
include '../fragment/biblio_form.php';

class ModelUser extends DataBase
{
    private  $nom, $prenom, $passwd, $email, $phone;


    public static function returnSta($query){
        try{
            $db = DataBase::getInstance();
            echo("---DataBase : readAll : $query----\n");
            $statement = $db->prepare($query);
            return $statement;
        }catch (PDOException $e) {
            printf("%s - %s\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function readAllUser()
    {
        $query = "Select * From utilisateur";
        try {
           // $db = DataBase::getInstance();
            echo("---DataBase : readAll : $query----\n");
            //$statement = $db->prepare($query);
            $statement=self::returnSta($query);
            $statement->execute();
            $result = $statement->fetchAll(self::FETCH_ASSOC);
            echo("<pre>");
            print_r($result);
            echo("</pre>");
            return $result;
        } catch (PDOException $e) {
            printf("%s - %s\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function insertUser($post){//应该是一个数组
        $query = "INSERT INTO `utilisateur` (`id_user`, `nom`, `prenom`, `passwd`, `email`, `phone`) VALUES ('$post[0]','$post[1]','$post[2]','$post[3]','$post[4]','$post[4]')";
        try {
            self::returnSta($query)->execute();
            echo("sucessful insert");
            return true;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function updateUser($column=array(),$data=array(),$where){
        $set = "Set ";
        for($i=0;i<count($column)-1;$i++){
            $set .= $column[$i].'='.'$data[i]'.', ';
        }
        $set .=$column[count($column)-1].'='.'$data[count($column)-1]';
        $query ="Update `utilisateur` .$set.' '.$where";
        try {
            self::returnSta($query)->execute();
            echo("sucessful update");
            return true;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function deleteUser($email){
        $query="Delete From utilisateur "."Where email='$email'";
        try {
            self::returnSta($query)->execute();
            echo("sucessful delete '$email'");
            return true;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function selectUser($select_list=array(),$where){
       $select_list_temp= implode(",",$select_list);
       $query="Select ".$select_list_temp." From utilisateur ".$where;
        try {
            $statement=self::returnSta($query);
            $statement->execute();
            $result = $statement->fetchAll(self::FETCH_ASSOC);
            echo("<pre>");
            print_r($result);
            echo("</pre>");
            return $result;
        } catch (PDOException $e) {
            printf("%s - %s\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function selectGene($select_list=array(),$select_table=array(),$where){
        $select_list_temp = implode(",",$select_list);
        $select_table_temp = implode(",",$select_table);
        $query="Select ".$select_list_temp." From ".$select_table_temp." ".$where;
        try {
            $statement=self::returnSta($query);
            $statement->execute();
            $result = $statement->fetchAll(self::FETCH_ASSOC);
            echo("<pre>");
            print_r($result);
            echo("</pre>");
            return $result;
        } catch (PDOException $e) {
            printf("%s - %s\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public function where($where)
    {
        $this->filter .= $where;
    }

    public function getId()
    {
        return $this->id_user;
    }

    public function getNom(){
        return $this->nom;
    }
    public function getPreom(){
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
}



/*

class sql{
    protected $primary;  //cle de table
    protected $table;   //name of table
    protected $param=array();  //parametre //// Pdo bindParam()绑定的参数集合 ????
    protected $filter; //condition

// $this->where(['id = 1','and title="Web"', ...])->fetch();
//为防止注入，建议通过$param方式传入参数：
    public function where($list_where,$list_param){ //不是很明白这种做法；
        $this->filter .= " WHERE ";
        $this->filter .= implode(" ",$list_where);
        $this->filter = $list_param;
        return $this;
    }

    //DELETE FROM Person WHERE LastName = 'Wilson' 删除行
    public function delete(){
        $sql = "DELETE FROM ".$this->table.$this->where();
        $result = DataBase::getInstane()->prepare($sql);
        $result->excute();

        return $result->rowCount();
    }

    //INSERT INTO Persons (LastName, Address) VALUES ('Wilson','Champs-Elysees')
    public function insert($table,$list_value){ //这个参数是外部传进来的还是sql对象自带的？？？？
        $keys=array();
        $vals=array();
        foreach ($list_value as $k => $v){
            array_push($keys,$k);
            array_push($vals,$v);
        }
        $res_k=implode(",",$keys);
        $res_v=implode(",",$vals);
        $sql= "INSERT INTO ".$table." (".$res_k.") VALUES (".$res_v.")"; //可能有单引号的问题。注意下
        $result = DataBase::getInstance()->prepare($sql);//??
        $result->execte();//??

        return $result->rowCount();
    }

    //SELECT * FROM TABLE
    public function fetchAll($table){
        $sql = "SELECT * FROM ".$table;
        $result= DataBase::getInstance()->prepare($sql); //getInstance()这个函数并不是自己弹出来的
        $result->execute();

        return $result->rowCount();
    }

    //SELECT LISTE_PARAM FROM LISTE_TABLE WHERE
    public function fetch(){

    }

    public function update(){

    }

public static function readAll2(){ //要不要用statis
$query = "Select * From utilisateur";
echo("avant try");
try{
$db = DataBase::getInstance();
echo("DataBase : readAll : $query");
$statement=$db->prepare($query);
$statement->execute();
$result=$statement->fetchAll(PDO::FETCH_CLASS,"Sql");//???获取不了数据？
print_r("$result");
//echo("DataBase : readAll : result : $result");
return $result;
}catch (PDOException $e){
printf("%s - %s\n",$e->getCode(), $e->getMessage());
return NULL;
}
$r2=$db->query($query);
$res2=$r2->fetchAll();
}

}
*/


?>
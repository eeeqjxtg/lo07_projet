<?php

class DataBase extends PDO{
private static $dbInstance;

   public function __construct(){}


    public static function getInstance(){
        global $dsn,$username,$passwd;

       $host="localhost";//3306
        $username="root";
        $passwd="";
        $dbname="Project";
        $dsn= "mysql:host=$host;dbname=$dbname;charset=utf8";
        $option=array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION); 

        if (!isset(self::$dbInstance)) {
            try {

                self::$dbInstance = new PDO($dsn, $username, $passwd,$option);
            }catch (PDOException $e){
                printf("can not connect database"."%s - %s<p/>\n",$e->getCode(),$e->getMessage());
            }
        }
        return self::$dbInstance;
    }
}
?>


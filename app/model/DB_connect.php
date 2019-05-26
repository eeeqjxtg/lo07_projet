<?php

class DataBase extends PDO{
private static $dbInstance=null;

   public function __construct(){}


    public static function getInstance(){
        echo("----getInstance----<p/>\n");
        $host="localhost";//3306
        $username="root";
        $passwd="root";
        $dbname="LO07";
        $option=array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION); //要不要用呢

        if (self::$dbInstance == null) {
            try {
                $dsn= "mysql:host=$host;dbname=$dbname;charset=utf8";
                self::$dbInstance = new PDO($dsn, $username, $passwd);
                echo("database chenggong chuangjian<p/>\n");
            }catch (PDOException $e){
                printf("can not connect database"."%s - %s<p/>\n",$e->getCode(),$e->getMessage());
            }
        }
        return self::$dbInstance;
    }

}

?>


<?php
public static function readAll(){
    $query = "Select * From utilisateur";
    try{
        $db = DataBase::getInstance();
        echo("DataBase : readAll : $query\n");
        $res = $db->query($query);
        $result=$res->fetchAll();
        $row=$res->rowCount();
        echo("row:$row");

        echo("<ul>");
        foreach ($result as $k => $v){
            echo("<li>$k.'='.$v</li>>");
        }
        echo("</ul>");
        echo("<pre>");
        print_r($result);
        echo("</pre>");
        return true;
    }catch (PDOException $e){
        printf("%s - %s<p/>\n",$e->getCode(), $e->getMessage());
        return NULL;
    }
}
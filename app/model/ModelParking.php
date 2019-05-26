<?php

class ModelParking extends DataBase{
    private $id_parking, $nom_parking,$prix_parking,$adress,$nb_site;



    public static function readAll()
    {
        $query = "Select * From utilisateur";
        try {
            $db = DataBase::getInstance();
            echo("---DataBase : readAll : $query----\n");
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll(self::FETCH_ASSOC);//???获取不了数据？
            echo("<pre>");
            print_r($result);
            echo("</pre>");
            return $result;
        } catch (PDOException $e) {
            printf("%s - %s\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    public function update(){
    }
    public function select(){

    }

    public static function insert()
    {//应该是一个数组 //测试成功成功插入
        $squery = "INSERT INTO `parking` (`id_user`, `nom`, `prenom`, `passwd`, `email`, `phone`) VALUES ('$_POST[username]','$_POST[nom]','$_POST[prenom]','$_POST[md5_pass]','$_POST[email]','$_POST[phone]')";
        try {
            $db = DataBase::getInstance();
            $statement = $db->prepare($squery);
            $statement->execute();
            echo("sucessful insert");
            return true;
        } catch (PDOException $e) {
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
    public function getPrix(){
        return $this->prix_parking;
    }
    public function getAdress(){
        return $this->adress;
    }
    public function getNbSite(){
        return $this->nb_site;
    }


}
?>
<?php
require_once 'DB_connect.php'
$sql= mysqli_query("SELECT id_user FROM utilisateur where id_user='".trim($_POST['username'])."'",$conn);
$res=mysqli_fetch_array($sql);
if($res){
    echo "yes";
}
else
    echo "no";
?>
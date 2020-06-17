<?php
require_once 'ControllerAdmin.php';
require_once 'controlerCar.php';
require_once 'controlerLocation.php';
require_once 'controlerParking.php';
require_once 'controlerUser.php';
require_once 'controlerAgence.php';
@$ac=$_POST['action'];
// récupération de l'action passée dans l'URL
$query_string = $_SERVER['QUERY_STRING'];

// fonction parse_str permet de construire une table de hachage (clé + valeur)
parse_str($query_string, $param);

// $action contient le nom de la méthode statique recherchée
@$action = $param["action"];
if(@$param['controller']!=null){
$controller = $param["controller"];
@$change = $param["change"];
@$passwd=$param["passwd"];
$get=array();
if($passwd != NULL){
 foreach ($_POST as $k => $v){
     $get[$k] = $v;
 }
}else{
    foreach ($_GET as $k => $v) {
        $get[$k] = $v;
    }
}

switch ($controller){
    case "admin" : if($change == null)ControllerAdmin::$action();
                   else ControllerAdmin::$action($get);
                   break;
    //case "user" : if($change == null)ControllerUser::$action();

        break;
    default: ControllerAdmin::deleteUsers();
}
}
if($ac=="logedin"){
    controlerUser::logedin();
}else if($ac=="inscription"){
    controlerUser::inscription();
    
}




switch ($action) {
    case "cancelcar":
        controlerCar::cancelcar($param['id']);
        break;
    
    
    case "cancellocationsite":
        controlerParking::cancellocationsite($param['id']);
        break;
    
    
    case "cancellocationcar":
        controlerLocation::cancellocationcar($param['locid']);
        break;
    case "first":
        session_start();
        $_SESSION['login'] = null;
        $_SESSION['email'] = null;
        require '../view/PageWelcome.php';
        break;
    case "acueil":
        session_start();
        require '../view/PageWelcome.php';
        break;
    case "reservationcar":
        session_start();
        if ($_SESSION['login'] != null) {
            controlerCar::reservationcar();
        } else {
            //$return=0;
            echo '<script languate="javascript">alert("You need to log in")</script>';
            require '../view/PageWelcome.php';
        }
        break;
    case "reservationpark":
        session_start();
        if ($_SESSION['login'] != null) {
            require '../view/ReservationPark.php';
        } else {
            //$return=0;
            echo '<script languate="javascript">alert("You need to log in")</script>';
            require '../view/PageWelcome.php';
        }
        break;
        
    case "rentedcar":
        session_start();
        controlerCar::rentcar($_SESSION['email']);
        break;
    case "rentcar":
        session_start();
        if ($_SESSION['login'] != null) {
            controlerAgence::rentcar();
            
            //require '../view/RentCar.php';
        } else {
            //$return=0;
            echo '<script languate="javascript">alert("You need to log in")</script>';
            require '../view/PageWelcome.php';
        }

        break;
    case 'selectedpark':
        controlerParking::selectedpark();
        break;
    case "personalpage":
        session_start();
        controlerUser::personalPage($_SESSION['email']);
        break;
    case "selectedcar":
        controlerCar::selectedcar();
        break;
    case "logout":
        session_start();
        $_SESSION['login'] = null;
        $_SESSION['email'] = null;
        require '../view/PageWelcome.php';
        break;

    
    case "register":
        require '../view/view_inscription.php';
        break;
    
    case "login":
        
        require '../view/PageLogin.php';
        break;
    case "reserve":
        controlerLocation::reservation($param);
        break;
    
    case "reservepark":
        controlerParking::reservepark($param);
        break;
    default:
        $action = "accueil";
}



// appel de la méthode statique $action de ControllerVin2

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


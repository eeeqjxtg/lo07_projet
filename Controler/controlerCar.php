<?php
require_once '../Model/ModelAgence.php';
require_once '../Model/ModelVoiture.php';





class controlerCar {
    public static function reservationcar(){
        $resultsr= ModelAgence::readAll();
        require '../view/ReservationCar.php';
    }
    public static function selectedcar(){
        $results= ModelVoiture::listCars( $_GET['DateOfStart'], $_GET['DateOfFinish'], $_GET['NumberOfPerson'],$_GET['Agence']);
        $dof=$_GET['DateOfFinish'];
        $dos=$_GET['DateOfStart'];
        //print_r($results);
        require '../view/CarList.php';
    }
    public static function cancelcar($id){
        ModelVoiture::deleteVoiture($id);
        require '../view/PageSuccess.php';
    }
    public static function rentcar($email){
        ModelVoiture::insert($_GET['plaque'], $_GET['brand'], $_GET['nb_seat'], $email, $_GET['d_start'], $_GET['d_finish'], $_GET['prix'], $_GET['agence']);
        
        require '../view/PageSuccess.php';
    }
    
    
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


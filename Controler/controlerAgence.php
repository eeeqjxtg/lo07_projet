<?php
require_once '../Model/ModelAgence.php';




class controlerAgence{
    public static function rentcar(){
        $results= ModelAgence::readAll();
        require '../view/RentCar.php';
    }
    
    
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


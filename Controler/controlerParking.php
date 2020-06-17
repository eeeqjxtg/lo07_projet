<?php
require_once '../Model/ModelSite.php';
require_once '../Model/ModelLocasite.php';

class controlerParking{
    public static function selectedpark(){
        $results= ModelSite::viewSites($_GET['DateOfStart'], $_GET['DateOfFinish'], $_GET['city']);
        $dos=$_GET['DateOfStart'];
        $dof=$_GET['DateOfFinish'];
        require '../view/ParkingList.php';
    }
    public static function reservepark($param){
        ModelLocaSite::reservation($param['siteid'],$param['email'],$param['dos'], $param['dof']);
        require '../view/PageSuccess.php';
    }
    public static function cancellocationsite($id){
        ModelLocaSite::cancel($id);
        require '../view/PageSuccess.php';
    }
    
    
    
}




/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


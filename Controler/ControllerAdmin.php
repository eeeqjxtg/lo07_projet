<?php
require_once '../model/ModelUser.php';
require_once '../model/ModelVoiture.php';
require_once '../model/ModelParking.php';
require_once '../model/ModelSite.php';
require_once '../model/ModelLocaSite.php';
require_once '../model/ModelLocation.php';


class ControllerAdmin{

    public static function deleteUsers() {
        $results = ModelUser::readAll();
        $delete_result = NULL;
        require('../view/view_deleteCustomer.php');
    }

    public static function delete_done($email){
        $delete_result = ModelUser::deleteUser($email['email']);
        $results = ModelUser::readAll();
        require('../view/view_deleteCustomer.php');
    }

    public static function deleteParking(){
        $results=ModelParking::readAll();
        require('../view/view_deleteParking.php');//删除和增加都在这个view里面
    }
    public static function delete_done_parking($id){
        $delete_result = ModelParking::deleteParking($id['id_parking']);
        $results = ModelParking::readAll();
        require('../view/view_deleteParking.php');
    }
    public static function addParking(){
        $results=ModelParking::readAll();
        require ('../view/view_addParking.php');
    }
    public static function addParking_done($get){
        ModelParking::insert($get);//测试过的可以的
        $number=$get['nb_site'];//测试过的可以的
        //获取新插入的id号
        $id=ModelParking::getLastId();//测试过的可以的
        require ('../view/view_addSite.php');
    }
    public static function addSite_done($get){
        //echo"进入insert";
        $success=ModelSite::insert($get);
        //echo"likai insert";
        //echo $success;
        $results=ModelParking::readAll();
        require ('../view/view_addParking.php');
    }

    public static function readAllCars(){
       $results_all=ModelVoiture::readAll();
       require('../view/view_returnCars.php');
    }
    public static function returnCars(){
        $results=ModelLocation::readEtat('0');
        require('../view/view_returnCars.php');
    }
    public static function returnCars_done($get){
       ModelLocation::confirmationReturn($get['id_location'],$get['no_plaque']);
        $results=ModelLocation::readEtat('0');
       require('../view/view_returnCars.php');
    }
    public static function rentCars(){
       $results=ModelLocation::readEtat('1');
       require ('../view/view_confirmRentCars.php');
    }
    public static function rentCars_done($get){
        ModelLocation::confirmationBorrow($get['no_plaque'],$get['id_location']);
        $results=ModelLocation::readEtat('1');
        require ('../view/view_confirmRentCars.php');
    }
    public static function putCarsAtAgence(){
        $results=ModelVoiture::readCarsOutside();
        require ('../view/view_putCarsToAgence.php');

    }
    public static function putCarsAtAgence_done($get){
        ModelVoiture::updateEtat($get['no_plaque'],'1');
        $results=ModelVoiture::readCarsOutside();
        require ('../view/view_putCarsToAgence.php');
    }



}
?>
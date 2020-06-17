<?php
require_once '../Model/ModelLocation.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class controlerLocation{
    public static function reservation($param){
        ModelLocation::reservation($param['noplague'], $param['email'],$param['dos'],$param['dof']);
        require '../view/PageSuccess.php';
    }
    public static function cancellocationcar($id){
        ModelLocation::cancel($id);
        require '../view/PageSuccess.php';
        
    }
    
    
}

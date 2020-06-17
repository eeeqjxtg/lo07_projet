<?php

require_once '../Model/ModelLocation.php';
require_once '../Model/ModelLocasite.php';
require_once '../Model/ModelUser.php';;

class controlerUser{
    public static function personalPage($email){
        $resultsC= ModelLocation::readUser($email);
        $resultsS= ModelLocaSite::readHistroySite($email);
        $resultsMC= ModelVoiture::readMyCars($email);
        require '../view/PersonalPage.php';
    }
    public static function logedin(){
        $userlist= ModelUser::readAll();
        $res= false;
        $emailtest=$_POST['email'];
        $passwdtest=$_POST['passwd'];
        $email=null;
        $username=null;
        if($emailtest=="00000"){
            echo '<a href="../Controler/router.php?action=deleteUsers&controller=admin">something intesting</a>';
        }else{
        
        
        
        foreach ($userlist as $user){
            if($user->getEmail()==$emailtest){
                if($user->getPasswd()==$passwdtest){
                    $res=true;
                    $email=$user->getEmail();
                    $username=$user->getNom();
                }
            }
        }
        if($res){
            session_start();
            $_SESSION['login']=$username;
            $_SESSION['email']=$email;
            require '../view/PageWelcome.php';
        }else{
            echo '<script languate="javascript">alert("Email or password incorrect!")</script>';
            require '../view/PageLogin.php';
        }}
        
    }
    public static function inscription(){
        $userlist= ModelUser::readAll();
        $res= true;
        @$emailtest=$_POST['email'];
        foreach ($userlist as $user){
            if($user->getEmail()==$emailtest){
                $res=FALSE;
            }
        }
        if($res){
           // print_r($_POST);
            
            
            
            @ModelUser::insertUser($_POST['nom'], $_POST['prenom'], $_POST['passwd_2'], $_POST['email'], $_POST['phone']);
            require '../view/PageSuccess.php';
        } else {
            echo '<script languate="javascript">alert("Email already inscripted")</script>';
            require '../view/view_inscription.php';
        }
        
    }
    
}
    
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


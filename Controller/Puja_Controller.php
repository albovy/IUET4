<?php

include "../Functions/Authentication.php";
include '../Models/Subasta_Model.php';
include '../Models/Pujas_Model.php';
include '../Views/MESSAGE_View.php';



session_start();
//Se coje de la url

if(!estaAutenticado()){
    header('Location:../index.php');
}
if(!isset($_GET['action'])){
    $action = '';
} else {
    $action = $_GET['action'];
}

//dependiendo del valor
switch($action){

    default:
        if($_SESSION['rol'] == 'SUBASTADOR'){
            header('Location:../index.php');
        }
        if(!isset($_GET['id'])){
            new Message('id incorrecto','../index.php');
        }else{
            $subasta = new Subasta_Model($_GET['id']);
            $subasta = $subasta->encontrarPorId();
            $puja = new Pujas_Model('','','','',$_GET['id']);
            $puja = $puja->getMaxPujador();
            if(!$_POST){

                new ADD_Pujador_View($subasta,$puja);
            }else{
                
            }
        }
}
?>
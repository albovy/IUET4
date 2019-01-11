<?php

include "../Functions/Authentication.php";
include '../Models/Subasta_Model.php';
include '../Models/Pujas_Model.php';
include '../Views/ADD_Pujador_View.php';
include '../Views/MESSAGE_View.php';
include '../Views/Show_Pujas.php';



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

    case 'historial':
        if($_SESSION['rol'] == 'SUBASTADOR'){
            header('Location:../index.php');
        }
        $pujas = new Pujas_Model('','',$_SESSION['login']);
        
        $pujas = $pujas->historial();
        
        new Show_Pujas($pujas);
    break;


    //añadir
    default:
        if($_SESSION['rol'] == 'SUBASTADOR'){
            header('Location:../index.php');
        }
        if(!isset($_GET['id'])){
            new Message('id incorrecto','../index.php');
        }else{
            $subasta = new Subasta_Model($_GET['id']);
            $subasta = $subasta->encontrarPorId();
            
            $pujaMasAlta = new Pujas_Model('','','',$_GET['id']);
            
            $pujaMasAlta = $pujaMasAlta->getMaxPujador();
            
            if(!$_POST){
                
                new ADD_Pujador_View($subasta,$pujaMasAlta);
            }else{
                $puja = new Pujas_Model(NULL,$_POST['puja'],$_SESSION['login'],$_GET['id']);
                
                    if($pujaMasAlta >= $puja->getDinero() ){
                        new Message('Puja más baja que la más alta','../index.php');
                    }else{
                        $respuesta = $puja->add();
                        new Message($respuesta,'../index.php');
                    }         
            }
        }
    



}
?>
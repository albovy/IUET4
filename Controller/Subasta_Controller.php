<?php


include "../Functions/Authentication.php";
include '../Models/Usuario_Model.php';
include '../Models/Subasta_Model.php';
include '../Views/ShowAll_SubastasAdmin_View.php';
include '../Views/MESSAGE_View.php';


//inicio de sesion
session_start();
//Se coje de la url

if(!estaAutenticado()){
    header('Location:..index.php');
}
if(!isset($_GET['action'])){
    $action = '';
} else {
    $action = $_GET['action'];
}

//dependiendo del valor
switch($action){


    //Pueden añadir o subastador o administrador
    case 'add':
        if($_SESSION['rol'] == 'PUJADOR'){
            header('Location:../index.php');

        }
        if($_SESSION['rol'] == 'ADMINISTRADOR'){
            if(!$_POST){
                //VISTA AÑADIR SUBASTA
            }else{
                //CONTROLADOR EL ESTADO DE LA PUJA TIENE Q SER ACEPTADA O COMO SEA EN LA BASE DE DATOS Y EL LOGIN DEL ADMIN QUE AUTORIZA
            }
        }else{
            if(!$_POST){
                //VISTA AÑADIR SUBASTA
            }else{
                //Controlador el estado de la puja pendiente y el admin nulo
            }
        }

        break;


    case 'edit':
        if($_SESSION['rol'] == 'PUJADOR'){
            header('Location:../index.php');
        }
        if(!isset($_GET['id'])){
            
            new Message('id incorrecto', '../index.php');
        }else{
           $subasta = new Subasta_Model($_GET['id']);
           $subasta = $subasta->encontrarPorId();
           if($subasta == 'id incorrecto'){
                new Message($subasta,'../index.php');
           }else{
                if($subasta->getLogin_subastador() == $_SESSION['login'] || $_SESSION['rol'] == "ADMINISTRADOR"){
                    if(!$_POST){

                    }else{

                    }
                }else{
                    
                    new Message('No puedes editar','..index.php');
                }
            }
        }


        break;
        
    
    
    //listado de las subastas de un subastador
    default:
            
            
        $usuario = new Usuario_Model($_SESSION['login']);
        $usuario = $usuario->encontrarPorLogin();
            
        if($usuario->getRol() == 'PUJADOR'){
            header('Location:./Controller/');
        }
        //Mostramos todas las subastas que hay
        if($usuario->getRol() == 'ADMINISTRADOR'){
                
            $subasta = new Subasta_Model();
            $subasta = $subasta->encontrarTodos();
            new ShowAll_View($subasta);

        //Mostramos solo sus subastas
        }else{
                
            $subasta = new Subasta_Model($_SESSION['login']);
            $subasta = $subasta->encontrarSubastasSubastador();
            new ShowAll_Subastador_View($subasta);
        }
            
    break;

}

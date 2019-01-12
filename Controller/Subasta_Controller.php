<?php


include "../Functions/Authentication.php";
include '../Models/Usuario_Model.php';
include '../Models/Subasta_Model.php';
include '../Views/ShowAll_SubastasAdmin_View.php';
include '../Views/ShowAll_SubastasSubastador_View.php';
include '../Views/ShowAll_SubastasPujador_View.php';
include '../Views/MESSAGE_View.php';
include '../Views/Add_Subastas_View.php';
include '../Views/Search_Subastas_View.php';


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
            header('Location:../index.php');
            }else{
            if(!$_POST){
                new Add_Subastas_View();
            }else{
                //Controlador el estado de la subasta pendiente y el admin nulo
                $registro = new Subasta_Model(NULL,$_POST['tipo'], $_FILES['informacion'], $_POST['incremento'], 
                    $_POST['fech_inicio'], $_POST['fech_fin'], 'PENDIENTE', $_SESSION['login'],NULL);

                $respuesta = $registro->add();
                new Message($respuesta, '../index.php');

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
                        new Edit_Subastas_View($subasta);
                    }else{
                        $subasta = new Subasta_Model(NULL, $_POST['tipo'], $_FILES['informacion'], $_POST['incremento'], 
                        $_POST['fech_inicio'], $_POST['fech_fin'], 'PENDIENTE', $admin->getLogin(),NULL); 
                        $respuesta = $subasta->edit();
                        new Message($respuesta, '../index.php');
                    }
                }else{
                    
                    new Message('No puedes editar','..index.php');
                }
            }
        }


        break;

    case 'delete':


    break;

    case 'search':
     $usuario = new Usuario_Model($_SESSION['login']);
     $usuario = $usuario->encontrarPorLogin();

    
            
            if(!$_POST){
                new Search_Subastas_View();
            }else{
                    $subasta = new Subasta_Model(NULL, $_POST['tipo'],$_POST['informacion'], $_POST['incremento'] ,
                        $_POST['fech_inicio'], $_POST['fech_fin'],$_POST['estado'],$_POST['subastador']);
        

            $respuesta = $subasta->search();
             if($_GET['results']){
                if($_SESSION['rol'] == 'ADMINISTRADOR'){
                     new ShowAll_View($respuesta);
                }

             if($_SESSION['rol'] == 'PUJADOR'){
                  new ShowAll_Pujador($respuesta);
             }
            }       
        }
    

    

    break;
        
    
    
    //listado de las subastas de un subastador
    default:
            
            
        $usuario = new Usuario_Model($_SESSION['login']);
        $usuario = $usuario->encontrarPorLogin();
            
        if($usuario->getRol() == 'PUJADOR'){
            
            $subasta = new Subasta_Model();
            $subasta = $subasta->encontrarTodos();
            
            new ShowAll_Pujador($subasta);
        }else{
        //Mostramos todas las subastas que hay
        if($usuario->getRol() == 'ADMINISTRADOR'){
                
            $subasta = new Subasta_Model();
            $subasta = $subasta->encontrarTodos();
            new ShowAll_View($subasta);

        //Mostramos solo sus subastas
        }else{
                
            $subasta = new Subasta_Model('','','','','','','',$_SESSION['login']);
            $subasta = $subasta->encontrarSubastasSubastador();
            new ShowAll_Subastador_View($subasta);
        }
    }
            
    break;


    case 'validar':
        if($_SESSION['rol'] == 'PUJADOR' || $_SESSION['rol'] == 'SUBASTADOR'){
            header('Location:../index.php');
        }
        if(!isset($_GET['id'])){
            new Message('id incorrecto','../index.php');
        }else{
            $subasta = new Subasta_Model($_GET['id']);
            $subasta = $subasta->encontrarPorId();
            $subasta = $subasta->validarSubasta($_SESSION['login']);

            new Message($subasta,'../index.php');
        }
    break;



}

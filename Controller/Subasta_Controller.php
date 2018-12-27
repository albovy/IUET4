<?php


include "../Functions/Authentication.php";
include '../Models/Usuario_Model.php';
include '../Views/ShowAll_SubastasAdmin_View.php'

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


    //listado de las subastas de un subastador
    case 'default':
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

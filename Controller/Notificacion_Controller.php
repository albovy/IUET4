<?php
    include '../Functions/Authentication.php';
    include '../Models/Notificacion_Model.php';
    include '../Views/Notificacion_View.php';

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
switch($action){

    default:
    
        $notificacion = new Notificacion_Model();
        $notificacion = $notificacion->encontrarPorLogin();
        new Notificacion_View($notificacion);
    break;  
}
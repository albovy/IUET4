<?php

session_start();

if(!isAuthenticated()){
    header('Location:../index.php');
}


if(!isset($_GET['email'])){
    new Message($respuesta, '../index.php');
}
else{
    $usuario = new Usuario_Model($_GET['email']);
    $usuario = $usuario->findByEmail();
    $respuesta = $usuario->delete();
    new Message($respuesta, '../index.php');   
}
?>
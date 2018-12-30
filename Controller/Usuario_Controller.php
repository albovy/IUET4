<?php


include "../Functions/Authentication.php";
include '../Views/Edit_View.php';
include '../Views/Login_View.php';
include '../Views/Registro_View.php';
include '../Views/Delete_View.php';
include '../Views/ShowAll_UsuariosAdmin_View.php';
include '../Models/Usuario_Model.php';

include '../Views/MESSAGE_View.php';
//inicio de sesion
session_start();
//Se coje de la url
if(!isset($_GET['action'])){
    $action = '';
} else {
    $action = $_GET['action'];
}


//dependiendo del valor
switch($action){
    //funcion tanto para administradores como para usuarios
    case 'register':
        //si esta autenticado y es admin puede registrar
        if(estaAutenticado()){
            $admin = new Usuario_Model($_SESSION['login']);
            //encontramos al admin por el login
            $admin = $admin->encontrarPorLogin();
            //miramos su rol
            if($admin->getRol() != 'ADMINISTRADOR'){
                //redirección
                header('Location:../index.php');
            }else{
                //si no viene de formulario
                if(!$_POST){
                    new Register($admin->getRol());
                }else{
                    //creamos el usuario que nos meten por el formulario
                    $registro = new Usuario_Model($_POST['login'], $_POST['contraseña'], $_POST['email'], $_POST['DNI'], $_POST['direccion'], $_POST['nombre'],
                                    $_POST['apellidos'], $_FILES['avatar'], $_POST['rol'], 'CREADO', $admin->getLogin());
                    /*Comprobamos si es un usuario válido*/
                    $respuesta = $registro->comprobarValidez();
                    if($respuesta == 'true'){
                        $respuesta = $registro->register();
                    }
                    new Message($respuesta, '../index.php');

                }
            }
        }else{
            //registro de un usuario normal
            if(!$_POST){
                new Register();
            }else{
                //creamos el usuario que nos meten por el formulario
                $registro = new Usuario_Model($_POST['login'], $_POST['contraseña'], $_POST['email'], $_POST['DNI'], $_POST['direccion'], $_POST['nombre'],
                                $_POST['apellidos'], $_FILES['avatar'], $_POST['rol'], 'PENDIENTE',NULL);
                
                /*Comprobamos si es un usuario válido*/
                $respuesta = $registro->comprobarValidez();
                if($respuesta == 'true'){
                    $respuesta = $registro->register();
                }
                new Message($respuesta, '../index.php');

            }
        }
    break;
    //funcion tanto para administradores como para usuarios
    case 'edit':
    
        if(!estaAutenticado()){
            header('Location:..index.php');
        }
        //miramos si hay un login en la url
        if(!isset($_GET['login'])){
            new Message('Login incorrecto','../index.php');
        }else{
            $usuario = new Usuario_Model($_SESSION['login']);
            $usuario = $usuario->encontrarPorLogin();
            //miramos si es el para poder editarte o si es administrador
            if($usuario->getLogin() == $_GET['login'] || $usuario->getRol() == 'ADMINISTRADOR'){
                $editar = new Usuario_Model($_GET['login']);
                $editar = $editar->encontrarPorLogin();
                if($editar == 'Login incorrecto'){
                    new Message($editar,'../index.php');
                }else{
                    $avatar = $usuario->getAvatar();
                    //editamos
                    if(!$_POST){
                        new editUser($editar);
                    }else{

                        //miramos si manda un nuevo avatar o no
                        if(!isset($_FILES['avatar']['name']) || $_FILES['avatar']['name'] == ''){
                            $usuario = new Usuario_Model($_GET['login'], $_POST['contraseña'], $_POST['email'], $_POST['dni'],$_POST['direccion'],$_POST['nombre'],
                                $_POST['apellidos'], $avatar) ;
    
                        }else{
                        $usuario = new Usuario_Model($_GET['login'], $_POST['contraseña'], $_POST['email'], $_POST['dni'],$_POST['direccion'],$_POST['nombre'],
                                $_POST['apellidos'], $_FILES['avatar']['name']);
                        }
                        //modelop
                        $respuesta = $editar->edit();
                        new Message($respuesta,'../index.php');
                    }
                }

            }
            
        }
        break;
    //Función común
    default : //login
        if(estaAutenticado()){
            header('Location:../index.php');
        }
        if(!$_POST){
            new Login();
        }else{
            $usuario = new Usuario_Model($_POST['login'],$_POST['contraseña']);
            $respuesta = $usuario->login();
            

            if($respuesta == 'true'){
                $_SESSION['login'] = $_POST['login'];
                $usuarioLogueado = new Usuario_Model($_SESSION['login']);
                $usuarioLogueado = $usuarioLogueado->encontrarPorLogin();
                $_SESSION['rol'] = $usuarioLogueado->getRol();

                header('Location:../index.php');
            }else{
                new Message($respuesta, '../index.php');
            }
            

        }
    break;
    //funcion admin
    case 'delete':
        if(!estaAutenticado()){
            header('Location:../index.php');
        }
        //miramos si es admin
        $admin = new Usuario_Model($_SESSION['login']);
        $admin = $admin->encontrarPorLogin();

        if($admin->getRol()!= "ADMINISTRADOR"){
            header('Location:../index.php');
        }else{
            //miramos en la url
            if(!isset($_GET['login'])){
                new Message('Login incorrecto','../index.php');
            }else{
                $borrar = new Usuario_Model($_GET['login']);
                $borrar = $borrar->encontrarPorLogin();
                if($borrar == 'Login incorrecto'){
                    new Message($borrar,'../index.php');
                }else{
                    $borrar->delete();
                    new Message('Borrado', '../index.php');
                }
            }
        }

        break;
    //funciona admin
    case 'listUsuarios':
        if(!estaAutenticado()){
            header('Location:../index.php');
        }
        $admin = new Usuario_Model($_SESSION['login']);
        $admin = $admin->encontrarPorLogin();

        if($_SESSION['rol'] != "ADMINISTRADOR"){
            header('Location:../index.php');
        }else{
            $usuarios = new Usuario_Model();
            $usuarios = $usuarios->showAll();
            new ShowAll_Usuarios_View($usuarios);
        }


        
        





}

?>
<?php 

include "../Functions/Authentication.php";
include '../Views/Edit_View.php';
include '../Models/Usuario_Model.php';
include '../Views/MESSAGE_View.php';



session_start();

if(!estaAutenticado()){
    header('Location:../index.php');
}

if(!isset($_GET['login'])){
            new Message('Login incorrecto','../index.php');
        }else{
            $usuario = new Usuario_Model($_GET['login']);

            $usuario = $usuario->findByEmail();

            if($usuario == 'Email incorrecto'){
                new Message($usuario , '../index.php');
            
            }else{
            
                $avatar = $usuario->getAvatar();

                if(!$_POST){
                    $usuario = new Usuario_Model($_GET['login']);
                    $usuario = $usuario->findByEmail();
                    new editUser($usuario);
                }else{
                   
                    if(!isset($_FILES['avatar']['name']) || $_FILES['avatar']['name'] == ''){
                        $usuario = new Usuario_Model($_POST['email'], $_POST['dni'],$_POST['direccion'],$_POST['nombre'],
                        	$_POST['apellidos'], $avatar ,$_GET['login'], $_POST['contraseña'],$_POST['rol'],$_POST['estado'],
                        	$_POST['admin']);

                    }else{
                    $usuario = new Usuario_Model($_POST['email'], $_POST['dni'],$_POST['direccion'],$_POST['nombre'],
                        	$_POST['apellidos'], $_FILES['avatar']['name'] ,$_GET['login'], $_POST['contraseña'],$_POST['rol'],$_POST['estado'],
                        	$_POST['admin']);
                    }
                    $respuesta = $usuario->edit();
                    new Message($respuesta,'../index.php');
                


                 }
            }
        }
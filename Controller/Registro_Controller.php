<?php

    session_start();
    /*Si el usuario no viene de un formulario, lo redirije a un formulario de registro*/
    if(!$_POST){
        new Register();
    } /*Si el usuario viene de un formulario de registro*/ 
    else{
        /*Creamos un nuevo usuario*/
        $registro = new Usuario_Model($_POST['email'], $_POST['DNI'], $_POST['direccion'], $_POST['nombre'],
                                    $_POST['apellidos'], $_POST['avatar'], $_POST['login'], $_POST['contraseña'],
                                    $_POST['rol'], $_POST['estado'], $_POST['loginAdmin']);
        /*Comprobamos si es un usuario válido*/
        $respuesta = $registro->comprobarValidez();
        /*Si es un usuario válido, lo registra*/
        if($respuesta){
            $registro->register();
        }
        else{
            /*Si no es un usuario válido, manda un mensaje*/
            new Message($respuesta, '../index.php');
        }
    }
?>
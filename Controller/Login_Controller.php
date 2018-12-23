<?php

include '../Functions/Authentication.php';
include '../Views/Login_View.php';

session_start();
//Si viene de un formulario
if(!$_POST){
    new Login();
}   
<?php

//Función que valida si está autenticado


function estaAutenticado(){
    if(!isset($_SESSION['login'])){
        return false;
    }
    return true;

}

?>
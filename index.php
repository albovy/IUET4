
<?php
    //entrada de la aplicación
    
    //se va usar la session de la conexion
    session_start();
    
    //funcion de autenticacion
    include './Functions/Authentication.php';
    
    //si no ha pasado el login de forma correcta
    if(!estaAutenticado()){
        header('Location:./Controller/Usuario_Controller.php');
    
    }
    //si ha pasado por el login de forma correcta 
    else{
        
    }
    
    
?>



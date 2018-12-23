<?php
    //clase Usuario
    class Usuario_Model{

        var $email;
        var $dni;
        var $direccion;
        var $nombre;
        var $apellidos;
        var $avatar;
        var $login;
        var $contraseña;
        var $rol;
        var $estado;
        var $loginadmin;

        var $mysqli;


        function __construct($email=null,$dni=null,$direccion=null
                            ,$nombre=null,$apellidos=null,$avatar=null
                            ,$login=null,$contraseña=null,$rol=null,$estado=null,$loginadmin=null){


            $this->email=$email;

        }






    }
<?php
    //clase Usuario
    class Usuario_Model{
        //variables
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
        //conexion con la base de datos
        var $mysqli;

        //constructor
        function __construct($email=null,$dni=null,$direccion=null
                            ,$nombre=null,$apellidos=null,$avatar=null
                            ,$login=null,$contraseña=null,$rol=null,$estado=null,$loginadmin=null){


            $this->email=$email;
            $this->dni=$dni;
            $this->direccion=$direccion;
            $this->nombre=$nombre;
            $this->apellidos=$apellidos;
            $this->avatar=$avatar;
            $this->login=$login;
            $this->contraseña=$contraseña;
            $this->rol=$rol;
            $this->estado=$estado;
            $this->loginadmin=$loginadmin;

            include_once '../Model/Access_DB.php';
	        $this->mysqli = ConnectDB();

        }
        function login(){

            $sql = "SELECT *
                    FROM USUARIOS
                    WHERE (
                        (login = '$this->login') 
                    )";

            if(!isset($this->login)){
                return 'login vacio';
            }
        
            $resultado = $this->mysqli->query($sql);
            if ($resultado->num_rows == 0){
                return 'El login no existe';
            }
            else{
                
                $tupla = $resultado->fetch_array();
                if ($tupla['password'] == $this->password){
                    
                    return 'true';
                }
                else{
                    return 'La contraseña para este usuario no es correcta';
                }
            }
        }//fin metodo login

        









    }
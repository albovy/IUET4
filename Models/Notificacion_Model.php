<?php

    class Notificacion_Model{
        var $mensaje;
        var $login;
        var $id;

        var $mysqli;


        function __construct($mensaje=null,$login=null,$id=null){
            $this->mensaje = $mensaje;
            $this->login = $login;
            $this->id = $id;

            include_once '../Models/Access_DB.php';
            $this->mysqli = ConnectDB();
        }
        function getMensaje(){
            return $this->mensaje;
        }
        function getLogin(){
            return $this->login;
        }
        function getID(){
            return $this->id;
        }

        function encontrarPorLogin(){
            $sql = "SELECT * FROM NOTIFICACION WHERE `LOGIN` = '$this->login'";
            
            $resultado = $this->mysqli->query($sql);
            $notificaciones_db = $resultado->fetch_All(MYSQLI_ASSOC);
            $notificaciones = array();

            foreach($notificaciones_db as $notificacion_db){
                array_push($notificaciones,new Notificacion_Model($notificacion_db['ESTADO'],$notificacion_db['LOGIN'],$notificacion_db['ID_SUBASTA']));
                
            }
            
            return $notificaciones;

        }
        function add(){
            
            $sql="INSERT INTO NOTIFICACION VALUES('$this->mensaje','$this->login',$this->id)";
            
            if($this->mysqli->query($sql)){

                return "Añadida";
            }else{
                return "Error";
            }

        }

    }
?>
<?php
    class Pujas_Model{
        var $id;
        var $dinero;
        var $login_pujador;
        var $id_subasta;

        var $mysqli;

        function __construct($id=null,$dinero=null,$login_pujador=null,$id_subasta=null){
            $this->id=$id;
            $this->dinero=$dinero;
            $this->login_pujador=$login_pujador;
            $this->id_subasta = $id_subasta;

            include_once '../Models/Access_DB.php';
            $this->mysqli = ConnectDB();
        }

        function getID(){
            return $this->id;
        }
        function getDinero(){
            return $this->dinero;
        }
        function getLoginPujador(){
            return $this->login_pujador;
        }
        function getIDSubasta(){
            return $this->id_subasta;
        }

        function getMaxPujador(){
            $sql="SELECT *,MAX(`DINERO`) AS MAXIMO FROM PUJA WHERE `ID_SUBASTA` = '$this->id_subasta'";
            var_dump($sql);

            $resultado = $this->mysqli->query($sql);
            $resultado = $resultado->fetch_array();
            
            return $resultado['MAXIMO'];
            
        
        }

    }

?>
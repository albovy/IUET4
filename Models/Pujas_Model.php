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
            $sql="SELECT MAX(`DINERO`) AS MAXIMO FROM PUJA WHERE `ID_SUBASTA` = '$this->id_subasta'";
            

            $resultado = $this->mysqli->query($sql);
            $resultado = $resultado->fetch_array();
            
            return $resultado['MAXIMO'];
            
        
        }
        function getLoginPujadorMaxPuj(){
            $sql="SELECT * FROM PUJA WHERE `DINERO` = (SELECT MAX(`DINERO`) FROM PUJA WHERE `ID_SUBASTA`= '$this->id_subasta')";
           
            
            $resultado = $this->mysqli->query($sql);
            $resultado = $resultado->fetch_array();
            
            
            return $resultado['LOGIN_PUJADOR'];
        }

        function add(){
            $sql="INSERT INTO PUJA(`DINERO`,`LOGIN_PUJADOR`,`ID_SUBASTA`) VALUES($this->dinero,'$this->login_pujador',$this->id_subasta)";
           
            if($this->mysqli->query($sql)){
                return 'Puja exitosa';
            }else{
                return 'Error en la puja';
            }

        }

        function historial(){
            $sql="SELECT * FROM PUJA WHERE `LOGIN_PUJADOR` = '$this->login_pujador'";
            $resultado = $this->mysqli->query($sql);
        
            $pujas_db = $resultado->fetch_All(MYSQLI_ASSOC);
            
            $pujas = array();

            foreach($pujas_db as $puja_db){
                array_push($pujas,new Pujas_Model($puja_db['ID'],$puja_db['DINERO'],$puja_db['LOGIN_PUJADOR'],$puja_db['ID_SUBASTA']));
            }
            return $pujas;
        }

    }

?>
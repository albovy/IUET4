<?php

    include '../Models/Notificacion_Model.php';
    
    
    
    class Subasta_Model{
        var $id;
        var $tipo;
        var $informacion;
        var $minIncremento;
        var $fech_inicio;
        var $fech_fin;
        var $estado;
        var $login_subastador;
        var $login_admin;

        var $mysqli;

        function __construct($id=null,$tipo=null,$informacion=null,$minIncremento=null,$fech_inicio=null
                            ,$fech_fin=null,$estado=null,$login_subastador=null,$login_admin=null){

                                $this->id = $id;
                                $this->tipo = $tipo;
                                $this->informacion = $informacion;
                                $this->minIncremento = $minIncremento;
                                $this->fech_inicio = $fech_inicio;
                                $this->fech_fin = $fech_fin;
                                $this->estado = $estado;
                                $this->login_subastador = $login_subastador;
                                $this->login_admin = $login_admin;

                                include_once '../Models/Access_DB.php';
                                $this->mysqli = ConnectDB();
                            }

        function getID(){
            return $this->id;
        }
        function getTipo(){
            return $this->tipo;
        }
        function getInformacion(){
            return $this->informacion;
        }
        function getMinIncremento(){
            return $this->minIncremento;
        }
        function getFech_inicio(){
            return $this->fech_inicio;
        }
        function getFech_fin(){
            return $this->fech_fin;

        }
        function getEstado(){
            return $this->estado;
        }
        function getLogin_subastador(){
            return $this->login_subastador;
        }
        function getLogin_Admin(){
            return $this->login_admin;
        }

      

       function add(){
         //Se guarda el fichero de información de la subasta del usuario 
            
            $this->login_admin = !empty($this->login_admin) ? "'$this->login_admin'" : "NULL";
            //Se inserta el usuario en la base de datos y se guarda el resultado en la variable sql
            $sql = "INSERT INTO SUBASTA VALUES(NULL, '$this->tipo', NULL, $this->minIncremento, '$this->fech_inicio', '$this->fech_fin', '$this->estado', '$this->login_subastador', $this->login_admin)";
            
            //Se comprueba si se ha insertado correctamente el usuario y devuelve un mensaje con el resultado
            if($this->mysqli->query($sql)){
                $id = $this->mysqli->insert_id;
                $info = $this->informacion($id);
                $sql = "UPDATE SUBASTA SET `INFORMACION` = '$info' WHERE `ID`=  '$id'";
                $this->mysqli->query($sql);
                return 'Añadida';
            }
            else{
                return 'Error de inserción';
            }
       }

       function edit(){

           $this->login_admin = !empty($this->login_admin) ? "'$this->login_admin'" : "NULL";

           $sql = "UPDATE SUBASTA
           SET 
           `TIPO` = '$this->tipo',
           `INFORMACION` = '$this->informacion',
           `INCREMENTO` = '$this->minIncremento',
           `FECH_INICIO` = '$this->fech_inicio',
           `FECH_FIN` = '$this->fech_fin',
           `ESTADO` = '$this->estado',
           `LOGIN_SUBASTADOR` = '$this->login_subastador',
           `LOGIN_ADMIN` = $this->login_admin
           WHERE `ID` = $this->id";
           

            if(!$this->mysqli->query($sql)){
                return "Error editando";
            }
            else{
                return "Editado";
                }
        }

        function borrarFichero($fichero) {
            unlink($fichero);
            $ficheros = glob($ruta . '/*');
            foreach ($ficheros as $fichero) {
                if(is_dir($fichero)){
                    borrarDirectorio($fichero);
                }
                else{
                    unlink($fichero);
                }
            }
            rmdir($ruta);
            return;
       }

       //Función que devuelve el fichero de información de $this y se crea el directorio del usuario en caso de no existir, guardando el fichero de información en ese directorio
        function informacion($id){
            
            $fichero = '../Files/'. $this->login_subastador .'/Subastas/'. $id.'/'.$this->informacion['name'];
            
            $directorio = '../Files/'. $this->login_subastador .'/Subastas/'. $id;
            
            //Si el directorio no existe, se crea
            if(!file_exists($directorio)){
                mkdir($directorio,0777,true);
            }
       
            move_uploaded_file($this->informacion['tmp_name'], $fichero);
            return $fichero;
        }

        function encontrarPorId(){
            $sql = "SELECT * FROM SUBASTA WHERE ID = '$this->id'";

            $resultado = $this->mysqli->query($sql);
            if($resultado->num_rows == 0){
                return 'id incorrecto';
            }else{
                $tupla = $resultado->fetch_array();
                $this->id = $tupla['ID'];
                $this->tipo = $tupla['TIPO'];
                $this->informacion = $tupla['INFORMACION'];
                $this->minIncremento = $tupla['INCREMENTO'];
                $this->fech_inicio = $tupla['FECH_INICIO'];
                $this->fech_fin = $tupla['FECH_FIN'];
                $this->estado = $tupla['ESTADO'];
                $this->login_subastador = $tupla['LOGIN_SUBASTADOR'];
                $this->login_admin = $tupla['LOGIN_ADMIN'];
                
                return $this;
            }
        }


            
        function encontrarTodos(){
            
            $this->comprobarSubastas();
            
            $sql="SELECT * FROM SUBASTA";
            
            $resultado = $this->mysqli->query($sql);
        
            $subastas_db = $resultado->fetch_All(MYSQLI_ASSOC);
            $subastas = array();

            foreach($subastas_db as $sub){
               
                
                array_push($subastas,new Subasta_Model($sub['ID'],$sub['TIPO'],$sub['INFORMACION'],$sub['INCREMENTO']
                            ,$sub['FECH_INICIO'],$sub['FECH_FIN'],$sub['ESTADO'],$sub['LOGIN_SUBASTADOR'],$sub['LOGIN_ADMIN']));
            }
            
            return $subastas;
        }

        function encontrarSubastasSubastador(){
            $this->comprobarSubastas();
            
            $sql="SELECT * FROM SUBASTA WHERE LOGIN_SUBASTADOR = '$this->login_subastador'";
            $resultado = $this->mysqli->query($sql);
            $subastas_db = $resultado->fetch_All(MYSQLI_ASSOC);
            $subastas = array();

            foreach($subastas_db as $sub){
                
                array_push($subastas,new Subasta_Model($sub['ID'],$sub['TIPO'],$sub['INFORMACION'],$sub['INCREMENTO']
                            ,$sub['FECH_INICIO'],$sub['FECH_FIN'],$sub['ESTADO'],$sub['LOGIN_SUBASTADOR'],$sub['LOGIN_ADMIN']));
            }
            
            return $subastas;
        }

        function validarSubasta($loginAd){
            $notificacion = new Notificacion_Model('APROBADA',$this->login_subastador,$this->id);
            $sql="UPDATE SUBASTA SET `ESTADO` = 'APROBADA', `LOGIN_ADMIN` = '$loginAd' WHERE `ID` = '$this->id'";
            if(!$this->mysqli->query($sql)){
                return "Error editando";
            }else{
                $notificacion = $notificacion->add();
                return "Editado";
            }
        }
        function comprobarSubastas(){
            
            $sql="SELECT * FROM SUBASTA WHERE `ESTADO` <> 'PENDIENTE'";
            $resultado = $this->mysqli->query($sql);
            $subastas_db = $resultado->fetch_All(MYSQLI_ASSOC);
            $subastas = array();

            foreach($subastas_db as $sub){
                $this->comprobarEstado($sub);
                

            }

        }

        function search(){
            
          
            $sql = "SELECT * FROM SUBASTA WHERE  `tipo` LIKE '%$this->tipo%' AND `informacion` 
            LIKE '%$this->informacion%' AND   `fech_inicio` LIKE '%$this->fech_inicio%' AND `fech_fin` LIKE  '%$this->fech_fin%' AND `estado` LIKE '%$this->estado%' AND `login_subastador` LIKE '%$this->login_subastador%' AND `login_admin` LIKE '%$this->login_admin%'";
            $resultado = $this->mysqli->query($sql);
            $subastas_db = $resultado->fetch_All(MYSQLI_ASSOC);
            $subastas = array();

            foreach($subastas_db as $sub){
                
                array_push($subastas,new Subasta_Model($sub['ID'],$sub['TIPO'],$sub['INFORMACION'],$sub['INCREMENTO']
                            ,$sub['FECH_INICIO'],$sub['FECH_FIN'],$sub['ESTADO'],$sub['LOGIN_SUBASTADOR'],$sub['LOGIN_ADMIN']));
            }
            
            return $subastas;
        }

        function comprobarEstado($sub){
            
            $hoy = new DateTime();
            $year = getdate()['year'];
            $mon = getdate()['mon'];
            $day = getdate()['mday'];
            $hoy->setDate($year,$mon,$day);
            $fecha_subasta_inicio = new DateTime($sub['FECH_INICIO']);
            $fecha_subasta_fin =new DateTime($sub['FECH_FIN']);
            
            

            
            switch($sub['ESTADO']){

                case'APROBADA':
                
                       
                        if($fecha_subasta_inicio <= $hoy){
                            $respuesta = $this->cambiarEstado('INICIADA',$sub);                 
                        }
                        if($hoy >= $fecha_subasta_fin){
                            $respuesta = $this->cambiarEstado('FINALIZADA',$sub);
                        }

                        
                break;
                case 'INICIADA':
                
                
                    if($hoy < $fecha_subasta_inicio){
                        $respuesta = $this->cambiarEstado('APROBADA',$sub);
                    }
                    if($hoy >= $fecha_subasta_fin){
                        $respuesta = $this->cambiarEstado('FINALIZADA',$sub);
                    }
                    
                break;

                case 'FINALIZADA':
                
                    
                    $pujador = new Pujas_Model(null,null,null,$sub['ID']);
                    $pujador = $pujador->getLoginPujadorMaxPuj();
                    if($pujador!= NULL){
                    
                    $usuario = new Usuario_Model($pujador);
                    $usuario = $usuario->encontrarPorLogin();
                    
                    
                    $this->notificar('Has ganado la subasta',$pujador,$sub['ID']);
                    $this->notificar('Contacta con el email del pujador '.$usuario->getEmail(),$sub['LOGIN_SUBASTADOR'],$sub['ID']);
                    }else{
                        $this->notificar('No han pujado',$sub['LOGIN_SUBASTADOR'],$sub['ID']);
                    }

                break;
                    
                
                
                

            }


            


        }

        function notificar($estado,$loginPujador,$id){
            $notificacion = new Notificacion_Model($estado,$loginPujador,$id);
            
            $notificacion = $notificacion->add();
        }
        function cambiarEstado($estado,$subasta){
            
            $notificacion = new Notificacion_Model($estado,$subasta['LOGIN_SUBASTADOR'],$subasta['ID']);
            
            $id = $subasta['ID'];
            $sql="UPDATE SUBASTA SET `ESTADO` ='$estado' WHERE `ID` = '$id'";

            if(!$this->mysqli->query($sql)){
                return "Error editando";
            }else{
                
                $notificacion = $notificacion->add();
                
                if($notificacion == "Añadida"){
                    
                    return "Editado";
                }
                return "Error";
            }

        }
    }
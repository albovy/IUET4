<?php
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

        function __construct($login_subastador=null,$id=null,$tipo=null,$informacion=null,$minIncremento=null,$fech_inicio=null
                            ,$fech_fin=null,$estado=null,$login_admin=null){

                                $this->id = $id;
                                $this->tipo = $tipo;
                                $this->informacion = $informacion;
                                $this->minIncremento = $minIncremento;
                                $this->fech_inicio = $fech_inicio;
                                $this->fech_fin = $fech_fin;
                                $this->estado = $estado;
                                $this->login_subastador = $login_subastador;
                                $this->login_admin = $login_admin;


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


            
        function encontrarTodos(){
            $sql="SELECT * FROM SUBASTA";

            $resultado = $this->mysqli->query($sql);
            $subastas_db = $resultado->fetch_All(MYSQLI_ASSOC);
            $subastas = array();

            foreach($subastas_db as $sub){
                array_push($subastas,new Subasta_Model($sub['LOGIN_SUBASTADOR'],$sub['ID'],$sub['TIPO'],$sub['INFORMACION'],$sub['INCREMENTO']
                            ,$sub['FECH_INICIO'],$sub['FECH_FIN'],$sub['ESTADO'],$sub['LOGIN_ADMIN']));
            }
            
            return $subastas;
        }

        function encontrarSubastasSubastador(){
            $sql="SELECT * FROM SUBASTA WHERE LOGIN_SUBASTADOR = '$this->login_subastador'";
            $resultado = $this->mysqli->query($sql);
            $subastas_db = $resultado->fetch_All(MYSQLI_ASSOC);
            $subastas = array();

            foreach($subastas_db as $sub){
                array_push($subastas,new Subasta_Model($sub['LOGIN_SUBASTADOR'],$sub['ID'],$sub['TIPO'],$sub['INFORMACION'],$sub['INCREMENTO']
                            ,$sub['FECH_INICIO'],$sub['FECH_FIN'],$sub['ESTADO'],$sub['LOGIN_ADMIN']));
            }
            
            return $subastas;
        }
    }
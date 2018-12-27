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
        function __construct($login=null, $contraseña=null, $email=null,$dni=null,$direccion=null
                            ,$nombre=null,$apellidos=null,$avatar=null
                            ,$rol=null,$estado=null,$loginadmin=null){


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

            include_once '../Models/Access_DB.php';
	        $this->mysqli = ConnectDB();

        }

        function getEmail(){
            return $this->email;
        }
        function getDNI(){
            return $this->dni;
        }
        function getDir(){
            return $this->direccion;
        }
        function getNombre(){
            return $this->nombre;
        }
        function getApellidos(){
            return $this->apellidos;
        }
        function getAvatar(){
            return $this->avatar;
        }
        function getLogin(){
            return $this->login;
        }
        function getContraseña(){
            return $this->contraseña;
        }
        function getRol(){
            return $this->rol;
        }
      
        function getEstado(){
            return $this->estado;
        }
        function getAdmin(){
            return $this->loginadmin;
        }
        function login(){

            $sql = "SELECT *
                    FROM USUARIO
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
                if ($tupla['PASSWORD'] == $this->contraseña){
                    
                   if($tupla['ESTADO'] == 'CREADO'){
                       return 'true';
                   }else{
                       return 'Usuario en espera de aceptación';
                   }
                }
                else{
                    return 'La contraseña para este usuario no es correcta';
                }
            }
        }//fin metodo login

        //Función que comprueba si un usuario es válido para ser insertado
        function comprobarValidez(){
            //Comprueba que se haya introduc¡do un email, un dni o un login
            if(!isset($this->email) || !isset($this->dni) || !isset($this->login)){
                return "Algunos datos estan vacíos";
            }

            //Comprueba si el usuario ya está insertado en la base de datos
            $sql = "SELECT *
                    FROM USUARIO 
                    WHERE `login` = '$this->login' OR `dni` = '$this->dni' OR `email` = '$this->email'";

            $resultado = $this->mysqli->query($sql);
            //Si ya existia un usuario en la base de datos con esos datos devuelve un mensaje de error
            if($resultado->num_rows == 1){
                return 'Login, Email o DNI ya existentes';
            }
            else{
                return 'true';
            }
        }

        //Funcion que sirve para insertar el usuario en la base de datos
        function register(){
            //Se guarda el avatar del usuario insertado en la variable avatar medianta la llamada a la función avatar
            $avatar = $this->avatar();
            $this->loginadmin = !empty($this->loginadmin) ? "'$this->loginadmin'" : "NULL";
            //Se inserta el usuario en la base de datos y se guarda el resultado en la variable sql
            $sql = "INSERT INTO USUARIO VALUES('$this->login', '$this->contraseña', '$this->email', '$this->dni', '$this->direccion', '$this->nombre', '$this->apellidos',
                    '$avatar', '$this->rol', '$this->estado', $this->loginadmin)";
            //Se comprueba si se ha insertado correctamente el usuario y devuelve un mensaje con el resultado
            if($this->mysqli->query($sql)){
                return 'Registrado';
            }
            else{
                return 'Error de inserción';
            }
        }

        //Función que devuelve el avatar de $this y se crea el directorio del usuario en caso de no existir, guardando el avatar en ese directorio
        function avatar(){
            $picture = '../Files/'. $this->email .'/Avatar/'. $this->avatar['name'];
            $directorio = '../Files/'. $this->email .'/Avatar/';
            //Si el directorio no existe, se crea
            if(!file_exists($directorio)){
                mkdir($directorio,0777,true);
            }
       
            move_uploaded_file($this->avatar['tmp_name'], $picture);
            return $picture;
        }

        //Función que borra un usuario de la base de datos, borrando el directorio en el que se guardaba su avatar
        function delete(){

            $dirAvatar = '../Files/'. $this->email .'/Avatar/';

            $sql = "DELETE FROM USUARIO
                    WHERE `login` = '$this->login' OR `dni`= '$this->dni'";

            if($this->mysqli->query($sql)){
                $this->borrarDirectorio($dirAvatar);
                return 'Usuario eliminado';
            }
            else{
                return 'Error eliminando';
            }
        }

        //Función que edita un usuario de la base de datos
        function edit(){
        
        
            if(isset($this->avatar['name'])){

                $this->borrarDirectorio('../Files/'. $this->email .'/Avatar/');
                $avatar = $this->avatar();
            
            }else{
                $avatar = $this->avatar;
            }
            

            $sql="UPDATE USUARIOS
                 SET `login` = $this->login,  `contraseña` = $this->contraseña, `email` = '$this->email', `dni` = '$this->dni', `direccion` = $this->direccion,`nombre` = $this->nombre
                 ,`apellidos` = $this->apellidos, `avatar` = '$avatar'
                 WHERE `login` = '$this->login'";

            if(!$this->mysqli->query($sql)){
                return "Error editando";
            }else{
        
                return "Editado";
            }



            
        }

        //Función que borra un directorio dado y todo su contenido
        function borrarDirectorio($directorio){
            $ficheros = glob($directorio . '/*');
            foreach ($ficheros as $fichero) {
                //Si uno de los archivos que se encuentra es un directorio, llama recursivamente a la función borrarDirectorio
                if(is_dir($fichero)){
                    borrarDirectorio($fichero);
                }
                else{
                    //Si no es un directorio, borra ese fichero
                    unlink($fichero);
                }
            }
            //Finalmente, borra el directorio original que se pasó como argumento
            rmdir($ruta);
            return;
        }

        //Función que busca un usuario dado su email
        function encontrarPorLogin(){
            //Busca al usuario por su email y guarda el resultado en la variable sql
            $sql = "SELECT * 
                    FROM USUARIO
                    WHERE `login` = '$this->login'";

            $resultado = $this->mysqli->query($sql);
            //Si la búsqueda del usuario no devuelve ningún resultado, se devuelve un mensaje de email incorrecto
            if($resultado->num_rows == 0){
                return 'Login incorrecto';
            }
            else{
                //Guarda cada uno de los atributos del usuario de la búsqueda y devuelve el usuario
                $tupla = $resultado->fetch_array();
                $this->email = $tupla['EMAIL'];
                $this->dni = $tupla['DNI'];
                $this->direccion = $tupla['DIRECCION'];
                $this->nombre = $tupla['NOMBRE'];
                $this->apellidos = $tupla['APELLIDOS'];
                $this->avatar = $tupla['AVATAR'];
                $this->login = $tupla['LOGIN'];
                $this->contraseña = $tupla['PASSWORD'];
                $this->rol = $tupla['ROL'];
                $this->estado = $tupla['ESTADO'];
                $this->loginadmin = $tupla['LOGIN_ADMIN'];
                return $this;
            }
        }

    }
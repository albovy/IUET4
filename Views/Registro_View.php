<?php

    class Register{

        function __construct(){
            $this->render();
        }

        function render(){
            include '../Views/Header.php'; //header necesita los strings
?>
        <form action='../Controller/Registro_Controller.php' method='POST' enctype="multipart/form-data">
        
            <label for="email"><?= $strings['Email'] ?></label>
            <input type="email" id="email" name="email">
            <label for="dni"><?= $strings['DNI'] ?></label>
            <input type="text" id="DNI" name="DNI">
            <label for="direccion"><?= $strings['Dirección'] ?></label>
            <input type="text" id="direccion" name="direccion">
            <label for="nombre"><?= $strings['Nombre'] ?></label>
            <input type="text" id="nombre" name="nombre">
            <label for="apellidos"><?= $strings['Apellidos'] ?></label>
            <input type="text" id="apellidos" name="apellidos">
            <label for="avatar"><?= $strings['Avatar'] ?></label>
            <input type="file" id="avatar" name="avatar">
            <label for="login"><?= $strings['Login'] ?></label>
            <input type="text" id="login" name="login">
            <label for="contraseña"><?= $strings['Contraseña'] ?></label>
            <input type="password" id="contraseña" name="contraseña">
            <label for="rol"><?= $strings['Rol'] ?></label>
            <select id="rol">
                <option value="Administrador"><?= $strings['Administrador'] ?></option>
                <option value="Subastador"><?= $strings['Subastador'] ?></option>
                <option value="Pujador"><?= $strings['Pujador'] ?></option>
            </select>
        
            <a href='../index.php' class="registro"><?= $strings['Volver'] ?></a>
			<button  class="buttonGuardar" onclick="return registrar()"><i class="material-icons" o>check_circle</i></button>
        
        </form>

<?php
        }
    }

?>
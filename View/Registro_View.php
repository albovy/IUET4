<?php

    class Register{

        function __construct(){
            $this->render();
        }

        function render(){
?>
        <form action='../Controller/Registro_Controller.php' method='POST'>
        
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
            <input type="text" name="rol">
            <datalist id="rol">
                <option value="Administrador"><?= $strings['Administrador'] ?></option>
                <option value="Subastador"><?= $strings['Subastador'] ?></option>
                <option value="Pujador"><?= $strings['Pujador'] ?></option>
            </datalist>
        
        <a href="../index.php"></a>
        
        </form>

<?php
        }
    }

?>
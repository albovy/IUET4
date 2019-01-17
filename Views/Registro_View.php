<?php

    class Register{
        var $rol;
        function __construct($rol=null){
            $this->rol = $rol;
            $this->render();
        }

        function render(){
            include '../Views/Header.php'; //header necesita los strings
?>
        <form action='../Controller/Usuario_Controller.php?action=register' method='POST' enctype="multipart/form-data">
        
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
            <div class ="login">
            <label for="rol"><?= $strings['Rol'] ?></label>
            <select id="rol" name="rol">
            <?php if($this->rol == 'ADMINISTRADOR'){
                ?>
                <option value="Administrador"><?= $strings['Administrador'] ?></option>
                <?php
                }
                ?>
                <option value="Subastador"><?= $strings['Subastador'] ?></option>
                <option value="Pujador"><?= $strings['Pujador'] ?></option>
            </select>
            </div>
            <div class ="login">
            <label for="contraseña"><?= $strings['Contraseña'] ?></label>
            <input type="password" id="contraseña" name="contraseña">
            </div>
        
            <a href='../index.php' class="registro"><?= $strings['Volver'] ?></a>
			<button  class="buttonGuardar" onclick=""><i class="material-icons" o>check_circle</i></button>
        
        </form>

<?php
        }
    }

?>
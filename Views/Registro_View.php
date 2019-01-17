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
            <input type="email" id="email" name="email" maxlength="60" size=60  onblur="comprobarEmail(this.id,this.size)">
            <label for="dni"><?= $strings['DNI'] ?></label>
            <input type="text" id="DNI" name="DNI"  maxlength="9" size=9 onblur="comprobarDni(this.id,this.size)">
            <label for="direccion"><?= $strings['Dirección'] ?></label>
            <input type="text" id="direccion" name="direccion"maxlength="200" size=200 onblur="comprobarVacio(this.id)">
            <label for="nombre"><?= $strings['Nombre'] ?></label>
            <input type="text" id="nombre" name="nombre" maxlength="30" size="30"  onblur="comprobarAlfabetico(this.id,this.size)">
            <label for="apellidos"><?= $strings['Apellidos'] ?></label>
            <input type="text" id="apellidos" name="apellidos" maxlength="50" size=50 onblur="comprobarAlfabetico(this.id,this.size)">
            <label for="avatar"><?= $strings['Avatar'] ?></label>
            <input type="file" id="avatar" name="avatar" accept="image/*">
            <label for="login"><?= $strings['Login'] ?></label>
            <input type="text" id="login" name="login" maxlength="15" size=15 onblur="comprobarVacio(this.id)">
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
            <input type="password" id="contraseña" name="contraseña" onblur="comprobarVacio(this.id)">
            </div>
        
            <a href='../index.php' class="registro"><?= $strings['Volver'] ?></a>
			<button  class="buttonGuardar" onclick="return registro()"><i class="material-icons" o>check_circle</i></button>
        
        </form>

<?php
        }
    }

?>
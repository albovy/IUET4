<?php

    class Add_Subastas_View{
        var $rol;
        function __construct($rol=null){
            $this->rol = $rol;
            $this->render();
        }

        function render(){
            include '../Views/Header.php'; //header necesita los strings
?>
        <form action='../Controller/Subasta_Controller.php?action=add' method='POST' enctype="multipart/form-data">
        
            <label for="tipo"><?= $strings['Tipo de subasta'] ?></label>
            <select id="tipo" name="tipo">
                <option value=""><?= $strings['-selecciona-'] ?></option>
                <option value="CIEGA"><?= $strings['Ciega'] ?></option>
                <option value="NO CIEGA"><?= $strings['No ciega'] ?></option>
            </select>
            <label for="informacion"><?= $strings['Información'] ?></label>
            <input type="file" id="informacion" name="informacion">
            <label for="incremento"><?= $strings['Incremento mínimo'] ?></label>
            <input type="number" id="incremento" name="incremento">
            <label for="fech_inicio"><?= $strings['Fecha inicio'] ?></label>
            <input type="text" id="dateAdd" name="fech_inicio" class="tcal" value="" readonly>
            <label for="fech_fin"><?= $strings['Fecha fin'] ?></label>
            <input type="text" id="dateAdd" name="fech_fin" class="tcal" value="" readonly>
            
        
            <a href='../index.php' class="registro"><?= $strings['Volver'] ?></a>
			<button  class="buttonGuardar" onclick=""><i class="material-icons" o>check_circle</i></button>
        
        </form>

<?php
        }
    }

?>
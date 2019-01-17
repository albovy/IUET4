<?php

    class Edit_Subastas_View{
        var $subasta;
        
        function __construct($subasta = null){
            $this->subasta = $subasta;
            $this->render();
        }

        function render(){
            include '../Views/Header.php';
?>
        <form method="POST" action="../Controller/Subasta_Controller.php?action=edit&id=<?=$this->subasta->getID()?>">
        <label for="tipo"><?= $strings['Tipo de subasta'] ?></label>
            <select id="tipo" name="tipo">
            <?php
                if($this->subasta->getTipo() == $strings['Ciega']){
            ?>
                <option value=""><?= $strings['-selecciona-'] ?></option>
                <option value="CIEGA" selected><?= $strings['Ciega'] ?></option>
                <option value="NO CIEGA"><?= $strings['No ciega'] ?></option>
            </select>
            <?php
                }else{
            ?>
            <option value=""><?= $strings['-selecciona-'] ?></option>
                <option value="CIEGA" ><?= $strings['Ciega'] ?></option>
                <option value="NO CIEGA" selected><?= $strings['No ciega'] ?></option>
            </select>
            <?php
                }
            ?>

        <label for="incremento"><?= $strings['Incremento mínimo'] ?></label>
        <input type="number" id="incremento" name="incremento" value="<?=$this->subasta->getMinIncremento()?>">
        <label for="fech_inicio"><?= $strings['Fecha inicio'] ?></label>
        <input type="text" id="fech_inicio" name="fech_inicio"  value="<?=$this->subasta->getFech_inicio()?>" class="tcal" value="" readonly>
        <div class="login">
        <label for="fech_fin"><?= $strings['Fecha fin'] ?></label>
        <input type="text" id="fech_fin" name="fech_fin" class="tcal"   value="<?=$this->subasta->getFech_fin()?>" readonly>
            </div>

        <a href='../index.php' class="registro"><?= $strings['Volver'] ?></a>
		<button  class="buttonGuardar" onclick=""><i class="material-icons" o>check_circle</i></button>
        </form>
<?php
        }
    }
?>
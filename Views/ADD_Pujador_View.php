<?php
    class ADD_Pujador_View{
        var $subasta;
        var $pujaMaxima;

        function __construct($subasta=null,$pujaMaxima=null){
            $this->subasta=$subasta;
            $this->pujaMaxima=$pujaMaxima;
            $this->render();

        }
        function render(){
            include '../Views/Header.php';
            ?>

            <div class="tabla">
		<h2 class="textoForm">ShowCurrent</h2>
		<table class="table">
			<thead>
				<th> </th>
				<th class="thDeleteOrTupla"></th>
			</thead>
			<tbody>
				<tr>
					<td class="tdColDeleteOrTupla">ID:</td>
					<td class="tdDeleteOrTupla"><?= $this->subasta->getID()   ?></td>
				</tr>
				<tr>
					<td class="tdColDeleteOrTupla"><?= $strings['Estado'] ?>:</td>
					<td class="tdDeleteOrTupla"><?= $this->subasta->getEstado()?></td>
				</tr>
				<tr>
					<td class="tdColDeleteOrTupla"><?= $strings['Incremento mínimo']?>:</td>
					<td class="tdDeleteOrTupla"><?= $this->subasta-> getMinIncremento()?></td>
				</tr>
                <?php
                    if($this->subasta->getTipo() != "CIEGA"){
                        ?>
				<tr>
					<td class="tdColDeleteOrTupla"><?= $strings['Puja más alta']?>:</td>
					<td class="tdDeleteOrTupla"><?= $this->pujaMaxima?></td>
                </tr>
                <?php
                    }
                    ?>
				<tr>
					<td class="tdColDeleteOrTupla"><?= $strings['Pujar'] ?>:</td>
					<td class="tdDeleteOrTupla">
                        <form action="../Controller/Puja_Controller.php">
                        <input type="text" id="puja" name="puja">
                        <button  class="buttonGuardar" onclick=""><i class="material-icons" o>check_circle</i></button>
                        </form>
                    
                    </td>
				</tr>
				

			</tbody>
		</table>
		

		<a href="../index.php" class="buttonTablaDeleteAtras"><i class="material-icons">arrow_back</i></a>
		</div>
        <?php
        }
    }
    ?>
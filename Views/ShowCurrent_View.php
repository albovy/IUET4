<?php
    class ShowCurrent{

        var $subasta;
        var $usuario;

        function __construct($subasta,$usuario){
            $this->subasta = $subasta;
            $this->usuario = $usuario;
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
				<th class="thDeleteOrTupla"><?= $strings['Subasta'] ?></th>
			</thead>
			<tbody>
				<tr>
					<td class="tdColDeleteOrTupla"><?= $strings['Tipo de subasta']?>:</td>
					<td class="tdDeleteOrTupla"><?= $this->subasta->getTipo()   ?></td>
				</tr>
				<tr>
					<td class="tdColDeleteOrTupla"><?= $strings['Información'] ?>:</td>
					<td class="tdDeleteOrTupla"><?= $this->subasta->getInformacion()?></td>
				</tr>
				<tr>
					<td class="tdColDeleteOrTupla"><?= $strings['Incremento mínimo']?>:</td>
					<td class="tdDeleteOrTupla"><?= $this->subasta->getMinIncremento()?></td>
				</tr>

				<tr>
					<td class="tdColDeleteOrTupla"><?= $strings['Fecha inicio']?>:</td>
					<td class="tdDeleteOrTupla"><?= $this->subasta->getFech_inicio()?></td>
				</tr>
				<tr>
					<td class="tdColDeleteOrTupla"><?= $strings['Fecha fin'] ?>:</td>
					<td class="tdDeleteOrTupla"><?= $this->subasta->getFech_fin()?></td>
				</tr>
				<tr>
					<td class="tdColDeleteOrTupla"><?= $strings['Avatar']?>:</td>
					<td class="tdDeleteOrTupla"><img src="<?=$this->usuario->getAvatar()?>" alt="avatar"></td>
				</tr>
				
				

			</tbody>
		</table>
		

		<a href="../index.php" class="buttonTablaDeleteAtras"><i class="material-icons">arrow_back</i></a>
		</div>


<?php
    }
}
    ?>
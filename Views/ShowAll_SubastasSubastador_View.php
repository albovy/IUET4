<?php

class ShowAll_Subastador_View{

    var $subastas;

    function __construct($subastas=null){
        $this->subastas=$subastas;
        $this->render();
    }
    function render(){
        include '../Views/Header.php'; 
        if(count($this->subastas) == 0){
            ?>
                <h1><?= $strings['No hay subastas']?></h1>
                <a href="../Controller/Subasta_Controller.php?action=add"><i class="material-icons tdShowIcons">create</i></a>
            <?php
        }else{
            ?>
            <div class="tabla">
				<h2 class="textoForm"><?= $strings['ShowAll subastas'] ?></h2>
				<table class="table">
				<thead>
				
				<th class="thShowAll"><?= $strings['Login'] ?></th>
				<th class="thShowAll"><?= $strings['Información'] ?></th>
				<th class="thShowAll"><?= $strings['Estado'] ?></th>
				<th class="thShowAll"><?= $strings['Fecha inicio'] ?></th>
				<th class="thShowAll"><?= $strings['Fecha fin'] ?></th>
				
			
				
				</thead>
					<tbody>
				<?php 
					foreach($this->subastas as $subasta){
						?>
						<tr>
						
						<td class="tdShowAll"><?= $subasta->getLogin_subastador() ?></td>
						<td class="tdShowAll"><a href="<?= $subasta->getInformacion() ?>"><?= $subasta->getInformacion() ?></a></td>
						<td class="tdShowAll"><?= $strings[$subasta->getEstado()] ?></td>
						<td class="tdShowAll"><?= $subasta->getFech_inicio() ?></td>
						<td class="tdShowAll"><?= $subasta->getFech_fin() ?></td>
						
						<td class="tdShowAll"></a>
						<a href="../Controller/Subasta_Controller.php?action=showcurrent&id=<?=$subasta->getID()?>"><i class="material-icons tdShowIcons">visibility</i></a>
						</td>
						<tr>
<?php
					}
?>
					</tbody>
			</table>
				</div>
<?php
        }
    }
}
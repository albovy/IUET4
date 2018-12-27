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
			
				
				</thead>
					<tbody>
				<?php 
					foreach($this->subastas as $subasta){
						?>
						<tr>
						<td class="tdShowAll"></td>
						<td class="tdShowAll"><?= $subasta->getLogin_subastador() ?></td>
						<td class="tdShowAll"><?= $subasta->getInformacion() ?></td>
						<td class="tdShowAll"><?= $subasta->getEstado() ?></td>
						
						<td class="tdShowAll"><a href="../Controller/Subasta_Controller.php?action=edit&id=<?=$subasta->getID()?>"><i class="material-icons tdShowIcons">create</i></a>
						<a href="../Controller/Subasta_Controller.php?action=showcurrent&id=<?=$subasta->getID()?>"><i class="material-icons tdShowIcons">visibility</i></a>
						<a href="../Controller/Subasta_Controller.php?action=delete&id=<?=$subasta->getID()?>"><i class="material-icons tdShowIcons">delete</i></a></td>
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
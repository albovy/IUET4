<?php
    class Notificacion_View{
        var $notifiaciones;

        function __construct($notifiaciones){
            $this->notificaciones = $notifiaciones;
            $this->render();
        }

        function render(){
            include '../Views/Header.php';

?>
        <div class="tabla">
		<h2 class="textoForm">ShowCurrent</h2>
		<table class="table">
			<thead>
				<th class="thDeleteOrTupla"><?= $strings['Mensaje']?></th>
				<th class="thDeleteOrTupla"><?= $strings['ID Subasta']?></th>
                <th></th>
			</thead>
			<tbody>
            <?php
            foreach($this->notificaciones as $notificacion)
            {
                ?>
				<tr>
            
					<td class="tdColDeleteOrTupla"><?=$notificacion->getMessage()?></td>
					<td class="tdDeleteOrTupla"><?=$notificacion->getID()?></td>

					<td class="tdDeleteOrTupla">
                        <form action="../Controller/Puja_Controller.php?id=<?=$this->subasta->getID()?>" method='POST'>
                        <input type="text" id="puja" name="puja">
                        <button  class="buttonGuardar" onclick=""><i class="material-icons" o>check_circle</i></button>
                        </form>
                    
                    </td>
                </tr>
                <?php
            }
            ?>
				
				

			</tbody>
		</table>
        <?php

        }

    }
    ?>
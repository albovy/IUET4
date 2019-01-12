<?php
    
    class Search_Subastas_View{

	
        function __construct(){
           
            $this->render();

        }

        function render(){

            include '../Views/Header.php'; 

?>
            <div class="formBuscar">
		    <form method='POST' action='../Controller/Subasta_Controller.php?action=search&results=yes'>
			<h2><?= $strings['Buscar subastas']?></h2>
            
					<select id="tipo" name="tipo" >
                		<option value=""><?= $strings['Tipo de subasta'] ?></option>
                		<option value="CIEGA"><?= $strings['Ciega'] ?></option>
                		<option value="NO CIEGA"><?= $strings['No ciega'] ?></option>
           			</select>
                    <br>
				
					<input type="text" id="informacion" name="informacion" placeholder="<?= $strings['Información']?>.."><br>
					
					<input type="number" id="incremento" name="incremento" placeholder="<?= $strings['Incremento mínimo']?>.."><br>
				
            		<input type="text" id="dateAdd" name="fech_inicio" class="tcal" value="" readonly 
            		placeholder="<?= $strings['Fecha inicio']?>.."><br>
            
            		<input type="text" id="dateAdd" name="fech_fin" class="tcal" value="" readonly
            		placeholder="<?= $strings['Fecha fin']?>.."><br>

       
            		<select id="estado" name="estado">
                		<option value=""><?= $strings['Estado'] ?></option>
                		<option value="PENDIENTE"><?= $strings['Pendiente'] ?></option>
                		<option value="APROBADA"><?= $strings['Aprobada'] ?></option>
                		<option value="INICIADA"><?= $strings['Iniciada'] ?></option>
                		<option value="FINALIZADA"><?= $strings['Finalizada'] ?></option>
           			</select><br>

                   
                
					<input type="text" id="subastador" name="subastador" placeholder="<?= $strings['Subastador']?>.."><br>
                   
                

				<button class="buttonBuscar"><i class="material-icons">search</i></button>

		</form>
		</div>
		
		
<?php
        }
    }
?>
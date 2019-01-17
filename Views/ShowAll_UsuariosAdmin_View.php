<?php

class ShowAll_Usuarios_View{

    var $usuarios;

    function __construct($usuarios=null){
        $this->usuarios=$usuarios;
        $this->render();
    }
    function render(){
        include '../Views/Header.php'; 
        if(count($this->usuarios) == 0){
            ?>
                <h1><?= $strings['No hay usuarios']?></h1>
                <a href="../Controller/Usuario_Controller.php?action=register"><i class="material-icons tdShowIcons">create</i></a>
            <?php
        }else{
            ?>
            <div class="tabla">
				<h2 class="textoForm"><?= $strings['ShowAll usuarios'] ?></h2>

                <div class="buscarañadir">
				    <a href="../Controller/Usuario_Controller.php?action=register"><i class="material-icons add" >person_add</i></a>
				    <a href="../Controller/Usuario_Controller.php?action=search" ><i class="material-icons search">search</i></a>
			    </div>
				<table class="table">
				<thead>
				
				<th class="thShowAll"><?= $strings['Nombre'] ?></th>
				<th class="thShowAll"><?= $strings['Apellidos'] ?></th>
				<th class="thShowAll"><?= $strings['Login'] ?></th>
                <th class="thShowAll"><?= $strings['Estado'] ?></th>
				</thead>
					<tbody>
				<?php 
					foreach($this->usuarios as $usuario){
						?>
						<tr>
						
						<td class="tdShowAll"><?= $usuario->getNombre() ?></td>
						<td class="tdShowAll"><?= $usuario->getApellidos() ?></td>
                        <td class="tdShowAll"><?= $usuario->getLogin() ?></td>
						<td class="tdShowAll"><?= $strings[$usuario->getEstado()] ?></td>
						
						<td class="tdShowAll">
                        <?php
                            if($usuario->getEstado() == 'PENDIENTE'){
                        ?>
                            <a href="../Controller/Usuario_Controller.php?action=validar&login=<?=$usuario->getLogin()?>"><i class="material-icons tdShowIcons">done</i></a>
                        <?php
                            }
                        ?>
                        <a href="../Controller/Usuario_Controller.php?action=edit&login=<?=$usuario->getLogin()?>"><i class="material-icons tdShowIcons">create</i></a>
						
						<a href="../Controller/Usuario_Controller.php?action=delete&login=<?=$usuario->getLogin()?>"><i class="material-icons tdShowIcons">delete</i></a>
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
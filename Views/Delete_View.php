<?php
    class deleteUser{
        var $usuario;

        function __construct($usuario){
            $this->usuario = $usuario;
            $this->render();
        }

        function render(){
            include '../Views/Header.php';
        //Tabla que muestra los datos a eliminar antes de eliminarlos
?>
<br>
            <table>
				<tr>
					<th></th>
					<th><?= $strings['Datos a eliminar']?></th>
				</tr>
				<tbody>
                        <tr>
                            <th scope="row"><?=$strings['Email']?></th>
                            <td><?= $this->usuario->getEmail() ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?=$strings['DNI']?></th>
                            <td><?= $this->usuario->getDNI() ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?=$strings['Dirección']?></th>
                            <td><?= $this->usuario->getDir() ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?=$strings['Nombre']?></th>
                            <td><?= $this->usuario->getNombre() ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?=$strings['Apellidos']?></th>
                            <td><?= $this->usuario->getApellidos() ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?=$strings['Avatar']?></th>
                            <td><?= $this->usuario->getAvatar() ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?=$strings['Login']?></th>
                            <td><?= $this->usuario->getLogin() ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?=$strings['Rol']?></th>
                            <td><?= $this->usuario->getRol() ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?=$strings['Estado']?></th>
                            <td><?= $strings[$this->usuario->getEstado()] ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?=$strings['Administrador']?></th>
                            <td><?= $this->usuario->getAdmin() ?></td>
                        </tr>
                    </tbody>
			</table>
            <a href="../index.php" class="buttonTablaDeleteCancelar"><i class="material-icons">clear</i></a>
		<a href="../Controller/Usuario_Controller.php?action=delete&login=<?=$this->usuario->getLogin()?>&delete=si" class="buttonTablaDeleteBorrar" ><i class="material-icons">delete</i></a>





<?php
        }
    }
?>
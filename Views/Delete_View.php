<?php
    class deleteUser{
        var $usuario;

        function __construct($usuario){
            $this->usuario = $usuario;
            $this->render();
        }

        function render(){
            include '../View/Header.php';
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
                            <td><?= $this->participacion->getDNI() ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?=$strings['Dirección']?></th>
                            <td><?= $this->participacion->getDir() ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?=$strings['Nombre']?></th>
                            <td><?= $this->participacion->getNombre() ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?=$strings['Apellidos']?></th>
                            <td><?= $this->participacion->getApellidos() ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?=$strings['Avatar']?></th>
                            <td><?= $this->participacion->getAvatar() ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?=$strings['Login']?></th>
                            <td><?= $this->participacion->getLogin() ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?=$strings['Rol']?></th>
                            <td><?= $this->participacion->getRol() ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?=$strings['Estado']?></th>
                            <td><?= $this->participacion->getEstado() ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?=$strings['Administrador']?></th>
                            <td><?= $this->participacion->getAdmin() ?></td>
                        </tr>
                    </tbody>
			</table>
            <!-- Este botón cancela el borrado de los datos mostrados y redirige a la página principal !-->
            <a href="../index.php"><i class="material-icons">cancel_presentation</i></a>
			<!-- Este botón confirmaría el borrado de los datos mostrados. !-->
            <a href=""><i class="material-icons">delete</i></a>

<?php
        }
    }
?>
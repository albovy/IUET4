<?php

	class Login{


		function __construct(){	
			$this->render();
		}

		function render(){
			include '../Views/Header.php'; //header necesita los strings

?>
            
            <form method='POST' action='../Controller/Login_Controller.php' >
            <div>
				<label><span class="req">*</span><?= $strings['Login'] ?>:</label>
				<input type="text"  name="login" placeholder="<?= $strings['Login']?>..">
			</div>
			<div>
				<label><span class="req">*</span><?= $strings['Contraseña'] ?>:</label>
				<input type="password" name="password" placeholder="<?= $strings['Contraseña']?>..">
			</div>
			
			<a href='../Controller/Registro_Controller.php' class="registro"><?= $strings['Registrate'] ?></a>
            <button><i class="material-icons" o>check_circle</i></button>
            </form>
			
        
<?php
        }

    }
?>
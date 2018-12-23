<?php
	include_once '../Functions/Authentication.php';
	if (!isset($_SESSION['idioma'])) {
		$_SESSION['idioma'] = 'SPANISH';
	}
	else{
	}
	include '../Locale/Strings_' . $_SESSION['idioma'] . '.php';
?>
<html>
<head>

    <meta charset="UTF-8">
	<link rel="stylesheet" href="../Views/css/style.css">
	<!--iconos y fontfamily-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css?family=K2D" rel="stylesheet">
    <!--validaciones-->
    <script src="../Views/js/validaciones.js"></script>
    
    <!--bootstrap js-->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
	 crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
	 crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
	 crossorigin="anonymous"></script>


<head>
<body>
	<header>

            <?php if(isset($_SESSION['login'])){
                ?>
                <button role="link" onclick="window.location='../Functions/Desconectar.php'"><i class="material-icons">power_settings_new</i></button>
                <a href="" class="enlaceHead"><i class="material-icons enlaceIconUser">person</i><?php echo $_SESSION['login']; ?></a>
            <?php
            }
            ?>
			
			<div class="dropdown">
				<button class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="idioma">
					<i class="material-icons">language</i>
				</button>
				<div class="dropdown-menu" aria-labelledby="idioma">
					<a href="../Functions/CambioIdioma.php?idioma=SPANISH" class="dropdown-item"><?= $strings['Español'] ?></a>
					<div class="dropdown-divider"></div>
					<a href="../Functions/CambioIdioma.php?idioma=ENGLISH" class="dropdown-item"><?= $strings['Inglés'] ?></a>
					<div class="dropdown-divider"></div>
					<a href="../Functions/CambioIdioma.php?idioma=GALLAECIAN" class="dropdown-item"><?= $strings['Gallego'] ?></a>
				</div>
			</div>

	</header>
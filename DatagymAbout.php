<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Datagym</title>
	<link rel="shortcut icon" href="../logodatagym.ico" type="image/ico"/>
	<link rel="stylesheet" type="text/css" href="css/DatagymRegister.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/desplegable.css">
	<script src="js/desplegable.js"></script>	
</head>

<body>
	<header>
		<?php 
		if(isset($_SESSION['login'])) {
			?>
			<ul class="topnav" id="myTopnav">
				<li><a href="DatagymLogged.php">Home</a></li>
				<li><a href="DatagymTarifas.php">Tarifas</a></li>
				<li><a href="DatagymMaquinas.php">Maquinas</a></li>
				<li><a href="DatagymProductos.php">Productos</a></li>
				<li><a href="DatagymContact.php">Contact</a></li>
				<li><a class="active" href="DatagymAbout.php">About</a></li>
				<li style="float: right;"><a href="DatagymLogout.php">Logout</a></li>
				<li style="float: right;"><a href="DatagymPerfil.php">Perfil</a></li>
				<li class="icon">
					<a href="javascript:void(0);" style="font-size:15px;" onclick="myFunction()">☰</a>
				</ul>

				<a class="logoCentral" href="DatagymLogged.php"><img class="logoCentral" src="images/logodatagym.png" alt="logoCentral"/></a>

			<?php } else { ?>

				<ul class="topnav" id="myTopnav">
					<li><a href="Datagym.php">Home</a></li>
					<li><a href="DatagymContact.php">Contact</a></li>
					<li><a class="active" href="DatagymAbout.php">About</a></li>
					<li style="float: right;"><a href="DatagymRegister.php">Register</a></li>
					<li style="float: right;"><a href="DatagymLogin.php">Login</a></li>
					<li class="icon">
						<a href="javascript:void(0);" style="font-size:15px;" onclick="myFunction()">☰</a>
					</ul>

					<a class="logoCentral" href="Datagym.php"><img class="logoCentral" src="images/logodatagym.png" alt="logoCentral"/></a>


				<?php } ?>


				
			</header>
			
			
			<div class="texto3" id="texto4">Somos un grupo que cursa la asignatura IISSI2 de Ingeniería Informática del Software en la universidad de Sevilla. Este es nuestro proyecto de la 
				asignatura.
			</div>
			<div class="texto3">En esta página web podras ver todos los productos, máquinas y servicios que ofrece el gimansio
				Seven Gym, así como un sitio para dejar tu opinión de tu experiencia en el gimnasio.
			</div>
			<div class="texto3"> 
				Para poder disfrutar de todos estos servicios que dispone la página web 
				es necesrio estar registrado, si no lo estás no te preocupes, puedes registrarte desde la web con el código de acceso que te proporcionaremos en el gimnasio.
			</div>
			<div class="texto3">Una vez registrado, podrás ver todas las tarifas que dispone SevenGym, las máquinas de última generación que disponemos y 
				la variedad de productos que podemos ofrecer.
			</div>
			
			<div class="ima">
				<img id="projetsii1" src="images/projetsii1.png" height="250px" width="400px">
				<img id="w3c" src="images/w3c.png" height="250px" width="400px" />
				<img id="projetsii2" src="images/projetsii2.png" height="250px" width="400px">
			</div> 

			<div class="ima">
			<img id="LogoUS" src="images/LogoUS.png" height="250px" width="250px" />
			</div> 
			
			<footer>"VEN A SEVENGYM, Y PONTE FUERTOTE"</footer>
			
			

		</body>
		</html>
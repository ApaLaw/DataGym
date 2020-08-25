<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Datagym</title>
	<link rel="shortcut icon" href="../logodatagym.ico" type="image/ico"/>
	<link rel="stylesheet" type="text/css" href="css/Datagym.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/desplegable.css">
	<script src="js/desplegable.js"></script>
</head>



<body>
	<header>
		<?php
		if($_SESSION['login']=="admin@admin.sevengym") {
			?>

			<ul class="topnav" id="myTopnav">
				<li><a class="active" href="DatagymLogged.php">Home</a></li>
				<li><a href="DatagymTarifas.php">Tarifas</a></li>
				<li><a href="DatagymMaquinas.php">Maquinas</a></li>
				<li><a href="DatagymProductos.php">Productos</a></li>
				<li><a href="DatagymUsuarios.php">Usuarios</a></li>
				<li><a href="DatagymTecnicos.php">Técnicos</a></li>
				<li><a href="DatagymReposiciones.php">Reposiciones</a></li>
				<li><a href="DatagymReparaciones.php">Reparaciones</a></li>
				<li><a href="DatagymComentarios.php">Comentarios</a></li>
				<li style="float: right;"><a href="DatagymLogout.php">Logout</a></li>
				<li class="icon">
					<a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
				</ul>

			<?php } else { if (!isset($_SESSION['login']))
			Header("Location: DatagymLogin.php");
			else { ?>

				<ul class="topnav" id="myTopnav">
					<li><a class="active" href="DatagymLogged.php">Home</a></li>
					<li><a href="DatagymTarifas.php">Tarifas</a></li>
					<li><a href="DatagymMaquinas.php">Maquinas</a></li>
					<li><a href="DatagymProductos.php">Productos</a></li>
					<li><a href="DatagymContact.php">Contact</a></li>
					<li><a href="DatagymAbout.php">About</a></li>
					<li style="float: right;"><a href="DatagymLogout.php">Logout</a></li>
					<li style="float: right;"><a href="DatagymPerfil.php">Perfil</a></li>
					<li class="icon">
						<a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
					</ul>
				<?php } } ?>

				<a class="logoCentral" href="DatagymLogged.php"><img class="logoCentral" src="images/logodatagym.png" alt="logoCentral"/></a>

			</header>
			<div id="contenidoPrincipal">

				<div class="FotoTexto">
					
					<img class="FotoID col-4 col-s-10" src="images/mujer_pesas.jpg"/>
					
					<div class="TextID col-8 col-s-8">	
						<p>SevenGym es el gimnasio de Sevilla donde podrás encontrar una amplia gama de actividades tanto si estas empezando como principiante, como si eres experimentado.</p>
					</div>

				</div>
				
				<div class="FotoTexto">
					<div class="TextID col-8 col-s-12">
						<p>Situado en una zona tranquila y segura. Ven a ponerte en forma con nosotros, perder esos kilos de más y fortalecer los músculos como nunca antes lo habías hecho.</p>

					</div>
					<img class="FotoID col-4 col-s-12" src="images/cintas.jpg"/>
					

				</div>
				
				
				<div class="FotoTexto">
					
					<img class="FotoID col-4 col-s-8" src="images/hombre_pesas.webp"/>
					<div class="TextID col-8 col-s-12">
						<p>Con equipo y rutinas personalizadas para el mejor entrenamiento. Además,  contamos con instalaciones y productos suplementarios para trabajar con la mayor comodidad posible.</p>
					</div>

				</div>

			</div>
			<footer>
				"VEN A SEVENGYM, Y PONTE FUERTOTE"
			</footer>

		</body>

		</html>
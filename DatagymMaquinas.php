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
	<link rel="stylesheet" type="text/css" href="css/MaqProd.css">
		
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="js/maquinas.js"></script>
</head>
<body>
	<?php
	if($_SESSION['login']=="admin@admin.sevengym") {
		?>

		<ul class="topnav" id="myTopnav">
			<li><a href="DatagymLogged.php">Home</a></li>
			<li><a href="DatagymTarifas.php">Tarifas</a></li>
			<li><a class="active" href="DatagymMaquinas.php">Maquinas</a></li>
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
				<li><a href="DatagymLogged.php">Home</a></li>
				<li><a href="DatagymTarifas.php">Tarifas</a></li>
				<li><a class="active" href="DatagymMaquinas.php">Maquinas</a></li>
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

			<table>
				<tr>
					<th>
						<div id="imagen">
							<img style="width: 200px; height: 200px;" src="images/CintaEstatica.png" alt="Powerade 500mL">
							<div id="CinCor" class="imagen>div">Cinta de correr</div>
						</div>
					</th>

					<th>
						<div id="imagen">
							<img style="width: 200px; height: 200px;" src="images/BicicletaEstatica.png" alt="Camiseta Oficial Datagym">
							<div id="BicEst" class="imagen>div">Bicicleta Estática</div>
						</div>
					</th>

					<th>
						<div id="imagen">
							<img style="width: 200px; height: 200px;" src="images/Multipawer.png" alt="Proteinas ISO-100 2Kg">
							<div id="MulPow" class="imagen>div">Multi-Power</div>
						</div>
					</th>
				</tr>
				<tr>
					<th>
						<div id="imagen">
							<img style="width: 200px; height: 200px;" src="images/Remo.png" alt="Guantes deportivos de seguridad">
							<div id="Rem" class="imagen>div">Remo</div>
						</div>
					</th>

					<th>
						<div id="imagen">
							<img style="width: 200px; height: 200px;" src="images/Prensa.png" alt="Barrita energética de chocolate OVERTIMS">
							<div id="Pren" class="imagen>div">Prensa</div>
						</div>
					</th>

					<th>
						<div id="imagen">
							<img style="width: 200px; height: 200px;" src="images/PressBanca.png" alt="Aquarius de Naranja 330mL">
							<div id="PreBan" class="imagen>div">Press Banca</div>
						</div>
					</th>
				</tr>
			</table>


			<br><br><br><br><br><br><br><br><br>	

			<p align="center">"VEN A SEVENGYM, Y PONTE FUERTOTE"</p>



		</body>
		</html>
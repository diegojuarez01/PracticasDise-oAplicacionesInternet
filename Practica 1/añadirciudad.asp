
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<head>
		<title> Viajes Young </title>
		<link href="css/fuentes.css" rel="stylesheet" type="text/css">
		<link href="css/pagina.css" rel="stylesheet" type="text/css">
	</head>
	<body>
	<!-- #include file=conexion.asp --> 
	
	<!-- cabecera donde pondremos el logo de la empresa de aviones 
	y un titulo para la pagina
	-->
		<header>
			<div id="imglogo">
				<img src="img/logo.jpg" alt="logo">
			</div>
			<div id="titulo">
				<h1>YOUNG TU WEB PARA VIAJES AEREOS</h1>
			</div>
		</header>
		<!--Menu donde pondremos varios botones con diferentes acciones -->
		<nav>
			<ul>
				<li><a href="inicio.asp"><h4> Inicio </h4></a></li>
				<li><a href="vuelosdisponibles.asp"><h4> Vuelos disponibles </h4></a></li>
				<li><a href="ubicacion.asp"><h4> Ubicacion </h4></a></li>
				<li><a href="consultarreservas.asp"><h4> Consultar reservas </h4></a></li>
				<!-- Si el admin no esta autentifado se mostrara en el menu para que 
				se pueda autenticar sino se mostraran las opciones de administrador-->
				<%
				autentificar= session("autentificado")
				<!-- si autentificar es 0 significa que el usuario no es admin -->
				<!-- por lo que le seguira apareciendo en el menu un login -->
				if autentificar = "0" then
				response.write("<li><a href=""adminlogin.asp""""><h4> Admin login</h4></a></li>")
				<!-- si autentificar es 1 significa que el usuario es admin -->
				<!-- por lo que le aparecera en el menu su panel de admin-->
				elseif autentificar = "1" then
				response.write("<li><a href=""administrador.asp""""><h4> Opciones Admin</h4></a></li>")
				<!-- Por defecto si no hemos intentado logearnos nos aparecera el menu para logearnos -->
				else
				response.write("<li><a href=""adminlogin.asp""""><h4> Admin login</h4></a></li>")
				end if
				%>
			</ul>
		</nav>
		<section>
				<div id="contenido">
				<h3>Añadir una nueva ciudad</h3>
			<%
			<!-- Obtenemos el ultimo valor de la columna IDCIUDAD y la guardamos en ultimo_id -->
			Set consulta = Conexion.Execute("select max(IDCIUDAD) as ultimo_id from CIUDAD")
			<!-- Guardamos en la variable sid_id el valor obtenido + 1 para luego añadirlo automaticamente-->
			sig_id = consulta("ultimo_id") + 1
			%>
			
		<form method="POST" action="añadirciudadform.asp">
		<label for="idciudad">IDCIUDAD:</label>
		<br><input type="text" name="idciudad" readonly value = <% response.write(sig_id) %>></br>
		<label for="idciudad">CIUDAD:</label>
		<br><input type="text" name="ciudad"></br>
		<label for="idciudad">TASA_AEROPUERTO:</label>
		<br><input type="text" name="tasa_aeropuerto"></br>
		<div id="enviar">
		<input type="submit" value="Añadir ciudad">
		<input type="reset" value="Vaciar">
		</form>
		</div>
		</div>	
		</section>
		<!-- Pie de pagina-->
		<footer>
		<div id="titulofoot">
		<h2>DESARROLLADO POR DIEGO JUÁREZ ROMERO </h2>
		</div>
		</footer>
	</body>
</html>

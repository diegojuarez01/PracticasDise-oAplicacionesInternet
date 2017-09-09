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
				<h3>Vuelos disponibles</h3>
				<!-- Formulario para ver los vuelos disponibles dependiendo de lo que seleccione el usuario -->
				<!--Obtenemos los valores introducidos en el formulario recibido-->
				<%ciudadorigen = request.form("CiudadDeOrigen")
				  ciudaddestino = request.form("CiudadDeDestino")
					SentenciadeAjax = "select * from CIUDAD where IDCIUDAD ='"& ciudaddestino &"'"
					Set rs = Conexion.Execute(SentenciadeAjax)
					destino = rs("CIUDAD")
				 <!--Si el usuario ha elegido todas las ciudades de origen y destino se mostraran todos los datos de la tabla LISTA_VUELOS_PRECIO-->
				if((ciudadorigen = "Todas") and (ciudaddestino="Todas")) then
					SentenciaSQL = "select * from LISTA_VUELOS_PRECIO"
				<!--Si el usuario ha elegido todas las ciudades de destino pero una ciudad de origen se mostraran todos los datos-->
				<!--de la tabla LISTA_VUELOS_PRECIO donde la ciudad de origen sea la introcudida en el formulario previo-->
				elseif ((ciudadorigen<>"Todas") and (ciudaddestino="Todas")) then
					SentenciaSQL = "select * from LISTA_VUELOS_PRECIO where CIUDAD_ORIGEN='" & ciudadorigen &"'"
				<!--Si el usuario ha elegido todas las ciudades de origen pero una ciudad de destino se mostraran todos los datos-->
				<!--de la tabla LISTA_VUELOS_PRECIO donde la ciudad de destino sea la introcudida en el formulario previo-->					
				elseif ((ciudadorigen = "Todas") and (ciudaddestino<>"Todas")) then
					SentenciaSQL = "select * from LISTA_VUELOS_PRECIO where CIUDAD_DESTINO='" & destino &"'"
				<!--Si el usuario ha elegido una ciudad de origen y una ciudad de destino se mostraran todos los datos-->
				<!--de la tabla LISTA_VUELOS_PRECIO donde la ciudad de origen y destino sean las introcudida en el formulario previo-->
				elseif ((ciudadorigen<>"Todas") and (ciudaddestino<>"Todas")) then
					SentenciaSQL = "select * from LISTA_VUELOS_PRECIO where CIUDAD_ORIGEN='" & ciudadorigen &"' and CIUDAD_DESTINO='" & destino &"'"
				end if
				Set rs = Conexion.Execute(SentenciaSQL)
				%>
				<table>
				<tr>
				<th scope="col" >CIUDAD ORIGEN</th>
				<th scope="col" >CIUDAD DESTINO</th>
				<th scope="col" >FECHA</th>
				<th scope="col" >PLAZAS DISPONIBLES</th>
				<th scope="col" >PRECIO</th>
				</tr>
				<!--Formulario para crear una nueva reserva debemos pedir al usuario su nombre,apellidos,nif y el nºde asiento que desea reservar-->
				<form method="POST" action="añadirnuevareserva.asp">
				<!-- Se iran añadiendo nuevas filas a la tabla hasta que el rs finalice -->
				<%
				do until rs.Eof%>
				<tr>
				<td scope="col" align="center"><%=rs("CIUDAD_ORIGEN")%></td>
				<td scope="col" align="center"><%=rs("CIUDAD_DESTINO")%></td>
				<td scope="col" align="center"><%=rs("FECHA")%></td>
				<td scope="col" align="center"><%=rs("N_PLAZAS_DISPONIBLES")%></td>
				<td scope="col" align="center"><%=cInt(rs("PRECIO"))%></td>
				<td align="center"><input name="vuelo" type="radio" required="required" value="<%=rs("IDVUELO")%>"></td>
				</tr>
				
				<%
				rs.MoveNext
				loop
				%>
				</table>
				<h3>Introduzca sus datos personales</h3>
				</div>
				<div id="Formularioreserva">
				<label for="nombre">Nombre:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </label>
				<input type="text" name="nombre" required="required"/>
				<label for="apellidos">Apellidos:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </label>
				<input type="text" name="apellidos" required="required"/>
				<label for="nif">NIF:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </label>
				<input type="text" name="nif" required="required"/>
				<label for="nasientos">Numero de asientos:</label>
				<input type="number" name="nasientos" required="required" min=1/>
				</div>
			<!--botones para enviar formulario y para vaciarlo -->
			<div id="reservar">
			<input type="button" value="Volver atras" onclick="location.href='vuelosdisponibles.asp'">
			<input type="submit" value="Reservar">
			</form>
			</div>
		</section>
		
		<!-- Pie de pagina-->
		<footer>
		<div id="titulofoot">
		<h2>DESARROLLADO POR DIEGO JUÁREZ ROMERO </h2>
		</div>
		</footer>
	</body>
	<!--#include file="cerrarconexion.asp"-->
</html>
<!-- #include file=conexion.asp --> 
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<head>
		<title> Viajes Young </title>
		<link href="css/fuentes.css" rel="stylesheet" type="text/css">
		<link href="css/pagina.css" rel="stylesheet" type="text/css">
	</head>
	<body>

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
		
				<div id="contenido" style="overflow-y: auto;">
				<h3>Vuelos disponibles de vuelta</h3>
				<!-- Formulario para ver los vuelos disponibles dependiendo de lo que seleccione el usuario -->
				<!--Obtenemos los valores introducidos en el formulario recibido-->
				<%					 
				<!--Creamos las variables para el idreserva minima y maxima por lo que el idreserva estara dentro de estos valores -->
				Dim max, min
				max=1000000
				min=1
				randomize
				<!--Obtenemos un numero aleatorio entre el intervalo de max y min -->
				aleatorio=(int((max-min+1)*Rnd+min))
				<!--establecemos como idreserva el numero aleatorio
				idreserva = aleatorio
				<!--recibimos los valores del formulario previo -->
				nombre = request.form("nombre")
				apellidos = request.form("apellidos")
				nif = request.form("nif")
				idvuelo = request.form("vuelo")
				nasientos = request.form("nasientos")
				SentenciaSQL = "select * from LISTA_VUELOS_PRECIO where IDVUELO='" & idvuelo &"'"
				Set rs = Conexion.Execute(SentenciaSQL)
				CIUDAD_ORIGEN= rs("CIUDAD_DESTINO")
				CIUDAD_DESTINO= rs("CIUDAD_ORIGEN")
				precio=cInt(rs("precio"))
				
				rs.close
				SentenciaSQL="select * from LISTA_VUELOS_PRECIO where CIUDAD_ORIGEN='" & CIUDAD_ORIGEN &"' AND CIUDAD_DESTINO='" & CIUDAD_DESTINO &"'"
				set rs = Conexion.Execute(SentenciaSQL)
				%>
				<table>
				<tr>
				<th scope="col" >CIUDAD ORIGEN</th>
				<th scope="col" >CIUDAD DESTINO</th>
				<th scope="col" >FECHA</th>
				<th scope="col" >PLAZAS DISPONIBLES</th>
				<th scope="col" >PRECIO</th>
				</tr>
				<!--Formulario para crear una nueva reserva debemos pedir al usuario su nombre,apellidos,nif y el n?de asiento que desea reservar-->
				<form method="POST" action="reservavuelta.asp">
				<!-- Se iran a?adiendo nuevas filas a la tabla hasta que el rs finalice -->
				<%
				do until rs.Eof
				%>
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
		<%
		<!-- mostramos el nº de plazas disponibles para el vuelo que el usuarios quiere reservar-->
		SentenciaSQL = "select N_PLAZAS_DISPONIBLES from VUELO where IDVUELO = '" & idvuelo &"'"
		Set rs = Conexion.Execute(SentenciaSQL)
		<!--Guardamos en nasientosdisponibles las plazas disponibles para ese vuelo-->
		nasientosdisponibles = rs("N_PLAZAS_DISPONIBLES")
		SentenciaSQL = "insert into reserva (idreserva, apellidos, nombre, nif,idvuelo,n_asientos,cancelado) values (" & idreserva & ",'" & apellidos & "','" & nombre & "','" & nif & "'," & idvuelo & "," & nasientos & ",0)"
		Set rs = Conexion.Execute(SentenciaSQL)
		<!--Si el nasientos que quiere el usuario es menor que el nasientosdisponibles se podra realizar la reserva -->
		if(cint(nasientos)<=cint(nasientosdisponibles)) then %>
		<script type="text/javascript">
			<!--
			alert('<%="ID RESERVA: " & idreserva &", esta ID le permitira hacer consultas sobre su reserva realizada por lo que deberia guardarla, el precio total de su reserva es de: " & precio*nasientos & " euros"%>')
			-->
			</script>
			<%
		<!--Si aparece un error significara que el nasientos es mayor que el nasientosdisponibles y no se podra realizar la reserva-->
			elseif Err.Number <> 0 then
				if Err.Description <> "" then
					response.write("<h3> Se ha producido un error en la reserva </h3> ")
					Response.Write("<h7>Error: " & Err.Description & "</h7><br>")
				end if
		end if
		rs.close
		%>
		</div>
		<div id="Formularioreserva">
				<br><label for="nombre" >Nombre:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </label>
				<input type="text" name="nombre" required="required" readonly value=<% response.write(nombre) %>>
				<label for="apellidos" >Apellidos:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </label>
				<input type="text" name="apellidos" required="required" readonly value=<% response.write(apellidos) %>>
				<label for="nif" >NIF:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </label>
				<input type="text" name="nif" required="required" readonly value=<% response.write(nif) %>>
				<label for="nasientos">Numero de asientos:</label>
				<input type="number" name="nasientos" required="required" min=1 value=<% response.write(nasientos) %>>
				<input type="hidden" name="idreserva" value=<% response.write(idreserva) %>>
		</div>
			<!--botones para enviar formulario y para vaciarlo -->
			<div id="reservar">
			<input type="button" value="Volver al inicio" onclick="location.href='inicio.asp'">
			<input type="submit" value="Reservar">
			</form>
			</div>
		</section>
		
		<!-- Pie de pagina-->
		<footer>
		<div id="titulofoot">
		<h2>DESARROLLADO POR DIEGO JU?REZ ROMERO </h2>
		</div>
		</footer>
	</body>
	<!--#include file="cerrarconexion.asp"-->
</html>	 
	
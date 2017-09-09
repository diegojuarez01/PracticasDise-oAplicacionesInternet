<!-- #include file=conexion.asp -->
 <!--recibimos los valores del formulario previo -->
			
<%			nombre = request.form("nombre")
			apellidos = request.form("apellidos")
			nif = request.form("nif")
			idvuelo = request.form("vuelo")
			nasientos = request.form("nasientos")
			idreserva = request.form("idreserva")
			idreserva = idreserva +1
		<!-- mostramos el nยบ de plazas disponibles para el vuelo que el usuarios quiere reservar-->
		SentenciaSQL = "select N_PLAZAS_DISPONIBLES from VUELO where IDVUELO = '" & idvuelo &"'"
		Set rs = Conexion.Execute(SentenciaSQL)
		<!--Guardamos en nasientosdisponibles las plazas disponibles para ese vuelo-->
		nasientosdisponibles = rs("N_PLAZAS_DISPONIBLES")
		SentenciaSQL = "select * from LISTA_VUELOS_PRECIO where IDVUELO='" & idvuelo &"'"
		Set rs = Conexion.Execute(SentenciaSQL)
		precio=cInt(rs("precio"))
		SentenciaSQL = "insert into reserva (idreserva, apellidos, nombre, nif,idvuelo,n_asientos,cancelado) values (" & idreserva & ",'" & apellidos & "','" & nombre & "','" & nif & "'," & idvuelo & "," & nasientos & ",0)"
		Set rs = Conexion.Execute(SentenciaSQL)
		<!--Si el nasientos que quiere el usuario es menor que el nasientosdisponibles se podra realizar la reserva -->
		if(cint(nasientos)<=cint(nasientosdisponibles)) then%>
		<script type="text/javascript">
			<!--
			alert('<%="ID RESERVA: " & idreserva &", esta ID le permitira hacer consultas sobre su reserva realizada por lo que deberia guardarla, el precio total de su reserva es de: " & precio*nasientos & " euros"%>')
		-->
			</script>
			<%server.transfer("inicio.asp")%>
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
			

		<!--#include file="cerrarconexion.asp"-->
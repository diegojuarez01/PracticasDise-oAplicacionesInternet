	<!-- Para establecer la conexion -->
	<!--#include file="conexion.asp"-->

<% 
	dni= session("NIF")
	idreserva= session("IDRESERVA")
	sentenciaSQL = "update Reserva set cancelado=1 where idreserva=" & idreserva 
	Set rs= Conexion.execute(sentenciaSQL)
	if Err.Number <> 0 then
				if Err.Description <>"" then%>
					<script type="text/javascript">
			<!--
			alert('<%="NO SE PUEDE CANCELAR,HA FINALIZADO EL PLAZO MAXIMO"%>')
			-->
			</script>
			<%	end if
			else
			%>
	<script type="text/javascript">
			<!--
			alert('<%="RESERVA: " & idreserva &" cancelada"%>')
			-->
			</script>
	<%
	end if
	session.abandon
	server.transfer("inicio.asp")%>






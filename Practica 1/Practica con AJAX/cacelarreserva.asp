	<!-- Para establecer la conexion -->
	<!--#include file="conexion.asp"-->

<% 
	dni= session("NIF")
	idreserva= session("IDRESERVA")
	sentenciaSQL = "update RESERVA set CANCELADO=1 where IDRESERVA=" & idreserva 
	Set rs= Conexion.execute(sentenciaSQL)%>
	<script type="text/javascript">
			<!--
			alert('<%="RESERVA: " & idreserva &" cancelada"%>')
			-->
			</script>
	<%session.abandon
	server.transfer("inicio.asp")%>






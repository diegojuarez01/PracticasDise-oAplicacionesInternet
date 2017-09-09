<!--#include file="conexion.asp"-->
<%

	CiudadDeOrigen = request.querystring("CiudadDeOrigen")
	SentenciaSQL = "select IDCIUDAD from CIUDAD where CIUDAD = '" & CiudadDeOrigen &"'"
	Set rs = Conexion.Execute(SentenciaSQL)
	IDCiudadDeOrigen = rs("IDCIUDAD")
	SentenciaSQL = "select * from lista_destinos(" & IDCiudadDeOrigen & ")"
	texto = "<label for='CiudadDeDestino'> Seleccione una ciudad de destino: </label> <br/>" 
	texto = texto & "<select name='CiudadDeDestino'>"
	Set rs = Conexion.Execute(SentenciaSQL)
	do while not rs.EOF
		texto = texto & "<OPTION VALUE='" & rs("IDCIUDADDESTINO") & "'>"
		texto = texto & rs("CIUDAD_DESTINO") & "</OPTION>"
		rs.MoveNext
	loop
	texto = texto & "</select>"
	<!-- Despues de haber añadido a texto todo lo necesario lo imprimimos con response.write -->
	response.write(texto)
%>
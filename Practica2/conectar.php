<?php
error_reporting(E_ALL ^ E_DEPRECATED);
$c=0;
// conecto con el servidor
$c=mysql_connect("localhost","root","");
// conecto con la Base de Datos
$c2=mysql_select_db("taller");
// compruebo que se ha realizado la conexión
if (!$c)
{
// error al conectar
echo "<b><center>Error al conectar con el servidor.</center></b>\n";
exit;
}
if (!$c2)
{
// error al conectar
echo "<b><center>Error al conectar con la Base de Datos.</center></b>\n";
exit;
}
// La conexión al servidor y a la BD se ha realizado con éxito
//echo "<b><center>Conexión realizada con éxito.</center></b>\n";
?>
<?php
//Cerramos session y volvemos a la pagina de inicio
session_start();
session_destroy();
echo "<script language='javascript'>window.location='inicio.php'</script>";	
?>
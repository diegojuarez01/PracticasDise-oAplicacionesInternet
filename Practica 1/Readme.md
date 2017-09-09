Aplicaciones Web con ASP, JSP, Ajax y Java Applets.
===
## **Estructura basica de las páginas**
Decidir como estructurar la página (aplicarlo a la página de inicio que servira de guia para las demás)

#### Header (compuesto por 2 elementos)

  1. Una imagen que sera nuestro logo de empresa.
  2. Titulo de la web ("YOUNG TU WEB PARA VIAJES AEREOS").
  
En la parte del CSS se aplica un color similar al del logo siguiendo de ejemplo en toda la web, ademas de los tamaños de los elementos que componen el header.

#### Menú navegacional

Compuesto por listas y enlaces para redireccionar al usuario a otra  de las páginas del proyecto cuando se pulse sobre ellos, con CSS le he dado formato a la letra,cambiado el color de fondo, modificado los bordes, controlado los márgenes y aplicado algún efecto como el que se produce al poner el cursor encima de algún elemento de la lista (cambiando su color a uno más claro y desplazandose el elemento de lista para abajo).

A este menu navegacional le iremos insertando todas las paginas de nuestro proyecto.

#### Section

Ocupara el espacio más grande dentro de la web, en el aparecerá todo el contenido de la web de las diferentes páginas que se irán creando.

En la página de inicio aparecerá un mensaje de bienvenida al usuario además de una explicación de la funcionalidad de la web 
y una imagen que permitirá al usuario acceder directamente a la pagina (“ubicación”) que se creara posteriormente.

Dentro de Section he creado un `<div>` al que le iremos aplicando diferentes estilos dependiendo de la página y
de los elementos dentro de este `<div>`.
  
#### Footer 
  
Por ultimo para acabar con la estructura nuestra web tendremos el Footer en el que aparecerá un texto con el nombre del desarrollador “DESARROLLADO POR DIEGO JUÁREZ ROMERO” al que le aplicaremos un formato `<h2>` modificado en el CSS y manteniendo la sintonia con el estilo de las demás secciones.

## **Desarrollo de la interfaz básica**

Ahora que tenemos la estructura que va a seguir la web, hay que empezar a crear nuevas páginas y darles funcionalidad a estas, se mantendran la estructura para todas las páginas de la web, solo cambiara el contenido dentro de <Section>.

#### Pagina ubicacion.

Ubicación en la que únicamente he añadido un iframe con un enlace a googlemaps y algunas propiedades dentro de este para darle una forma que se adecuara con la que iba a seguir la página.

#### Páginas LOGIN.

Para logearse he creado dos paginas diferentes:
1. Esta pagina consta de un `<form>` donde el usuario introducira el nombre y la password.
2. La pagina que recibe el formulario previo, usando ASP mandara diferentes respuestas dependiendo de si son correctos o no los datos introducidos en el formulario.

Por ejemplo:

Si el usuario o la password introducidos en el formulario no son correctos, se vaciará el formulario y se mantendrá en la misma página donde el usuario podrá volver a introducir los datos.

Si los datos son correctos se creara una variable de sesión que nos indicara que somos administradores y nos mandara a la página `inicio.asp` con estos poderes de ADMIN.

Una vez hemos creado la variable de sesión para el administrador habrá que añadir líneas de comprobación para esta variable en cada una de las páginas que vayamos a crear, de esta manera si la variable de sesión no es correcta el menú se mostrara por defecto (apareciendo la pagina de LOGIN) 

Si la variable de sesión es correcta el menú cambiara, apareciendo una nueva opcion para administradores donde estaba la opcion LOGIN, se trata de la página que vamos a crear a continuación.  

#### Página crear conexion y cerrar conexion.

Ahora vamos a necesitar entrar en la BD por lo que hay que crear dos nuevos archivos, uno será el de conexión a la BD y otro para cerrar la conexión.

Para crear conexión será indispensable esta línea de código ya que se encargará de conectar a la BD de agencia con el user y la password necesarios. 

``Conexion.ConnectionString = "Data Source=agencia; USER=SYSDBA; PASSWORD=masterkey".``

Para finalizar la conexión necesitamos el siguiente archivo.

```
<%  
          Conexion.Close
  
	  Set rs = nothing
  
	  Set Conexion = nothing   
 %>
  ```

Una vez tenemos estos dos archivos creados debemos de añadir las siguientes líneas en todas las paginas ASP en las que vayamos a hacer uso de la BD.

Para establecer la conexión: 	``<!-- #include file=conexion.asp -->``

Para finalizar la conexión: 	``<!--#include file="cerrarconexion.asp"-->``

#### Página Administrador.

Ahora que ya tenemos conexión con la BD vamos a implementar la funcionalidad de las opciones de administrador, según nos pide la practica debemos de poder crear una nueva ciudad, eliminar una ciudad existente y modificar una ciudad existente, además de ver los detalles de cualquier ciudad de la BD.

Por lo que al entrar en opciones de administrador mostraremos una lista desplegable que mostrará todas las ciudades de la tabla ciudad, en el `<select>` le he dado la propiedad de `onchange` y he creado la siguiente función de javascrip:

```
  function enviar(pagina){
				document.ciudades.action = pagina;
				document.ciudades.submit();
				}
        
 ```
        
Esta funcion nos dirigirá a la página donde veremos los detalles de la ciudad, además de mandar el valor de la ciudad seleccionada en el formulario.

He creado un botón para añadir una ciudad nueva en la misma página que `Onclick` ejecutara la misma función pero esta vez mandara el formulario a una página distinta, en la que podremos añadir una nueva ciudad.

En `<detalles.asp>` veremos los detalles de la ciudad seleccionada por el usuario, recibimos del formulario la ciudad elegida por el usuario y la guardamos en una variable y creamos una consulta en la que mostraremos todos los datos de la tabla ciudad cuando ciudad sea igual que la ciudad elegida por el usuario previamente.

Luego ejecutamos la sentencia y creamos tres cada uno para un dato distinto de la tabla ciudad y otros tres `<inputs type>` para que el usuario pueda cambiar sus valores excepto el `idciudad` que será `readonly` ya que su valor no puede cambiarse, estos tres `<inputs>` tendrán por defecto los valores obtenidos en el rs para cada elemento de la tabla.

He añadido dos botones distintos, uno será para cuando el usuario quiera borrar la ciudad y el otro para modificarla.

1. Si el usuario pulsa el botón de borrar ciudad mandará el formulario a la página `<eliminarciudad.asp>` que contendrá código asp para eliminar la ciudad. En esta página recibiremos los tres datos del formulario y los guardaremos en variables, luego crearemos la consulta que borrara todos los datos de la tabla ciudad cuando la `idciudad` sea igual a la obtenida del formulario previo y luego la ejecutamos.
Para terminar, se mostrará un `alert` con javascript que indicara que la ciudad ha sido borrada y por último nos devolverá a la página de `<administrador.asp>`.

2. Si el usuario pulsa el botón de modificar ciudad mandará el formulario a la página `<modificarciudad.asp>` que contendrá código asp para modificar la ciudad de la BD. Esta página sera similar a `<eliminarciudad.asp>` salvo que la consulta que ejecutara será un `update` a ciudad en el que cambiaremos los dos datos obtenidos del formulario cuando la `idciudad` sea la obtenida en el formulario.

3.Si pulsamos en el botón de añadir ciudad mandará el formulario a la página `<añadirciudad.asp>`, en esta página debemos de obtener el `idciudad` máximo para al añadir una nueva ciudad sumarle 1 a ese número, una vez tenemos el `idciudad` que le vamos a asignar a la nueva ciudad creamos un formulario que será semejante al de modificar ciudad excepto que en el `<input>` de `idciudad` vendrá con value `readonly` del `idciudad` obtenido previamente, este formulario se enviara a la página `<añadirciudadform.asp>`.

#### Página Añadirciudadform.asp.

Recibiremos los tres datos del formulario y los guardaremos en variables, luego crearemos la consulta que añadirá una nueva ciudad con los valores recogidos en las variables mediante un `insert`, una vez se ejecute la consulta se volverá a la página de `<administrador.asp>`.

#### Página Reservarvuelos.asp.

Dentro del div de contenido he creado dos listas desplegables con dos `<select>` con la primera opción para cada uno de ellos tengo el valor de Todas que luego nos servirá para mostrar todos los vuelos si el usuario lo dejara por defecto.

Para completar la lista desplegable cada opción se ira rellenando recorriendo el recordset para todas las iteraciones de la consulta `select ciudad from ciudad`, por lo que en cada option mostrara una ciudad de la tabla ciudad tanto para el select de ciudades de origen como para el `<select>` de ciudades de destino.

Una vez mandamos este formulario con las opciones seleccionadas en la página `<reservarvuelos.asp>`, en esta página recogeremos las ciudades de origen y de destino y dependiendo de los valores que obtengamos ejecutaremos una consulta u otra. 

#### Página Vuelosdisponibles.asp.

Para mostrar los valores obtenidos he creado una tabla con los atributos de la `tabla lista_vuelos_precios`, esta tabla se ira rellenando con valores del recorset dependiendo del número de iteraciones para la consulta.

Después de rellenar la tabla y mostrar los vuelos disponibles he creado un formulario de reserva que el usuario tendrá que rellenar con sus datos, además el usuario tendrá que elegir alguno de los vuelos que aparecen en la tabla seleccionando un `radiobutton` para poder reservar.

Una vez el usuario complete el formulario y le dé al botón reservar se realizará un `insert` en la tabla reserva con los datos obtenidos de dicho formulario, excepto el `idreserva` que lo obtendremos de forma aleatoria para cada nueva reserva.

He tenido que calcular el número de plazas disponible del vuelo solicitado ya que si es menor que el número de asientos que solicito el usuario saltara un error que impedirá al usuario hacer la reserva. 

Además, según pedía la practica al hacer una reserva se le mostrara al usuario si hay algún vuelo de vuelta desde la ciudad de destino por lo que habrá que hacer una consulta de todos los vuelos que tengan como `idvuelo` la obtenida en el formulario y guardando las variables de ciudad de origen y ciudad de destino solo tendremos que intercambiarlas en otra consulta para todos los vuelos que tenga como ciudad de origen la ciudad de destino obtenida en la consulta anterior y como ciudad de destino la ciudad de origen.

#### Página Reservarvuelta.asp.

También se mostrará un formulario para rellenar los datos como el de la página reservarvuelos.asp. Este formulario lo mandaremos a la página reservarvuelta.asp que contiene código asp igual al que he usado para hacer el `insert` a la reserva en la página anterior. Además, al realizar las reservas se producirá un `alert` que indicará el identificador de las reservas realizadas y el precio.

#### Página Consultarreservas.asp.

Para que el usuario pueda realizar consultas sobre sus reservas, he creado `<consultarreservas.asp>` se podrá acceder desde el menú navegacional en la que el usuario introduce su DNI y el identificador de reserva podrá acceder a esa reserva, para ello he creado un formulario con dos `<input>`, uno para el DNI y otro para el identificador.

#### Página Verreservas.asp.

El formulario previo se mandará a `<verreservas.asp>` en la que mostraremos los datos de la reserva realizada para el DNI y el identificador introducido, para ello guardamos los dos datos en variables y hacemos una consulta de todos los datos de la tabla reserva, si en alguno de ellos coincide el DNI, pasara a comprobarse el identificador si para ese mismo DNI coincide el identificador entonces se imprimirán los datos de ese momento del recorset de la tabla reserva, estos datos apareceran en una tabla.

Sin embargo, si el DNI no coincide se imprimirá por pantalla un error, al igual que si no coincide el identificador o si la reserva se ha cancelado.

Si todo sale bien crearemos las variables de sesión para DNI y el idreserva.

#### Página CancelarReserva.asp.

Se debe poder cancelar la reserva, le asignamos a dos variables los valores de la variable de sesión de DNI e identificador de reserva y hacemos un `update` en la tabla de reserva, cambiando el valor de cancelado a 1 cuando la `idreserva` corresponde con la obtenida de la variable de sesión, además capturamos el error que debe saltar cuando el vuelo es en menos de 48 horas, por el que no se pueden cancelar reservas y se mostraría un `alert` por pantalla.

Si todo sale bien y se cancela la reserva se mostrara un `alert` que indicara que el `idreserva` se ha cancelado correctamente y volveremos a la página de `<inicio.asp>` con un `server.transfer`.



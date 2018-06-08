<?PHP
$hostname_localhost ="javieribarra.cl";
$database_localhost ="javierib_Asistencia";
$username_localhost ="javierib_user";
$password_localhost ="AplicacionesMoviles";

// Comprobar Inicio Usuario Trabajador
if(isset($_GET["password_trabajador"]) && isset($_GET["email_trabajador"])){
		$password_trabajador=$_GET["password_trabajador"];
		$email_trabajador=$_GET["email_trabajador"];
		
		$json=array();

		$conexion = mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);

		$consulta="SELECT Count(*) AS numero, te.id_empresa FROM Trabajador t, Trabajador_Empresa te WHERE t.password_trabajador='{$password_trabajador}' AND t.email_trabajador='{$email_trabajador}' AND te.email_trabajador=t.email_trabajador";

		$resultado=mysqli_query($conexion,$consulta);
		
		while($registro=mysqli_fetch_array($resultado)){
			$json['Trabajador'][]=$registro;
			
		}
		mysqli_close($conexion);
		echo json_encode($json);
}

// Subir Asistencia a Base de Datos
if (isset($_GET["imagen_asistencia"]) && isset($_GET["entrada_salida"]) && isset($_GET["latitud"]) && isset($_GET["logitud"])){
		$imagen_asistencia=$_GET["imagen_asistencia"];
		$entrada_salida=$_GET["entrada_salida"];
		$latitud=$_Get["latitud"];
		$longitud=$_GET["longitud"];

		$json_2=array();

		$conexion_2 = mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
		
		$consulta_validacion="SELECT Count(*) as id_validacion FROM Validacion";
		$id_validacion=mysqli_query($conexion_2,$consulta_validacion);
		$id_validacion=mysqli_fetch_array($id_validacion);
		$id_validacion=(int)$id_validacion['id_validacion']+1;

		echo "Id Validacion: ".$id_validacion."   ---   ";		
		
		$consultar_hora="SELECT CURTIME() as hora";
		$hora=mysqli_query($conexion_2,$consultar_hora);
		$hora=mysqli_fetch_array($hora);
		$hora=$hora['hora'];

		echo "Hora: ".$hora."   ---   ";

		$consulta_asistencia="SELECT Count(*) as id FROM Asistencia";
		$id_asistencia=mysqli_query($conexion_2,$consulta_asistencia);
		$id_asistencia=mysqli_fetch_array($id_asistencia);
		$id_asistencia=(int)$id_asistencia['id']+1;

		echo "Id Asistencia: ".$id_asistencia."\n";

		$insetar_validacion="INSERT INTO Validacion(id_validacion) VALUES ('{$id_validacion}')";
		$nueva_validacion=mysqli_query($conexion_2,$insertar_validacion);
		
		$insertar_asistencia="INSERT INTO Asistencia(id_asistencia,id_validacion,imagen_asistencia,hora,entrada_salida,latitud,longitud) VALUES ('{$id_asistencia}','{$id_validacion}','{$imagen_asistencia}','{$hora}','{$entrada_salida}','{$latitud}','{$longitud}')";
		$nueva_asistencia=mysqli_query($conexion_2,$nueva_asistencia);
	
		$json_2["Asistencia"][]=["0"=>"{$id_validacion}","id_validacion"=>"{$id_validacion}"];

		mysqli_close($conexion_2);
		echo json_encode($json_2);
}

// Consultar Ubicacion de Hoy		
if (isset($_GET["id_empresa"]) && isset($_GET["ubicacion"])){
		$id_empresa=$_GET["id_empresa"];

		$json_3=array();

		$conexion_3 = mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);

		$consultar_dia="select CURDATE() as dia";
		$dia=mysqli_query($conexion_3,$consultar_dia);
		$dia=mysqli_fetch_array($dia);
		$dia=$dia['dia'];

		//echo "Dia: ".$dia."    ";

		$consultar_localizacion="SELECT a.latitud, a.longitud, t.nombre FROM Asistencia a, Trabajador_Asistencia ta, Trabajador t, Trabajador_Empresa te WHERE te.id_empresa='{$id_empresa}' AND t.email_trabajador=te.email_trabajador AND t.email_trabajador=ta.email_trabajador AND a.id_asistencia=ta.id_asistencia AND ta.dia='{$dia}' AND a.entrada_salida='Entrada'";

		$resultado_3=mysqli_query($conexion_3,$consultar_localizacion);

		while($registro_3=mysqli_fetch_array($resultado_3)){
			$json_3['Ubicacion'][]=$registro_3;
		}
		mysqli_close($conexion_3);
		echo json_encode($json_3);
}

// Obtener Participantes de una Empresa
else if (isset($_GET["id_empresa"])){
		$id_empresa=$_GET["id_empresa"];
		
		$json_1=array();

		$conexion_1 = mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);

		$consulta_1="SELECT t.email_trabajador, t.nombre FROM Trabajador t, Trabajador_Empresa te WHERE te.id_empresa='{$id_empresa}' AND t.email_trabajador=te.email_trabajador";
		$resultado_1=mysqli_query($conexion_1,$consulta_1);
		
		while($registro_1=mysqli_fetch_array($resultado_1)){
			$json_1['Trabajador'][]=$registro_1;
		}
		mysqli_close($conexion_1);
		echo json_encode($json_1);
}

		

?>

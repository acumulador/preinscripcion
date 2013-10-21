<?php
header("Content-Type: text/html;charset=utf-8");
include('conex.php');

$doc = $_POST['txtDocumento'];
$nom = utf8_encode ($_POST['txtNombre']);
$mail = $_POST['txtCorreo'];
$grup = $_POST['txtGrupo'];
$convenio = $_POST['cbConvenio'];

$mensaje = "";

if($convenio == "conservacion")
{
	$cuposSAP = 50;
}
else
{
	if($convenio == "depuracion")
	{
		$cuposSAP = 25;
	}
}

if($_POST['cbHorario'] == "ninguno")
{
	$horario = "NA";
}
else
{
	$horario = $_POST['cbHorario'];
}
$fecha_i = date("Y-m-d H:i:s");

if(isset($_POST['ckSAP']))
{
	$sap = "1";
}
else
{
	$sap = "0";
}

if(isset($_POST['ckExcel']))
{
	$excel = "1";
}
else
{
	$excel = "0";
}

if($excel == "1")
{
	$sqlE = "SELECT COUNT(  `horario` ) AS total FROM  `datos_preins` WHERE  `convenio` =  '$convenio' AND Excel = '1'";
	$resulE = mysql_query($sqlE);

	while($fila = mysql_fetch_array($resulE))
	{
		$totalExcelConv = $fila['total'];
	}

	if($totalExcelConv < 25)
	{
		$query = "INSERT INTO  `edusoftg_preins_cat`.`datos_preins` (
		`id` ,
		`documento` ,
		`nombre` ,
		`correo` ,
		`grupo` ,
		`convenio` ,
		`fecha_insc`,
		`Excel`,
		`horario`
		)
		VALUES 
			(NULL ,  '$doc',  '$nom',  '$mail',  '$grup',  '$convenio',  '$fecha_i', '$excel', 'NA'
		);";

		if(mysql_query($query))
		{
			// echo "Pre registro exitoso." . "<br>". "Recuerde nuestra linea de soporte: soporte@edusoftglobal.com";
			$mensaje = "Registro Exitoso al curso de Excel."."<br>";
		}
		else
		{
			echo "Se encontro el siguiente Error en la consulta ".mysql_error();
		}
	}
	else
	{
		$mensaje = "No hay cupos disponibles para el curso de Excel en el convenio seleccionado."."<br>";
	}
}

if($sap == "1")
{
	$sqlS = "SELECT COUNT(  `horario` ) AS total FROM  `datos_preins` WHERE  `convenio` =  '$convenio' AND SAP = '1'";
	$resulS = mysql_query($sqlS);

	while($fila = mysql_fetch_array($resulS))
	{
		$totalSAPConv = $fila['total'];
	}

	if($totalSAPConv < $cuposSAP)
	{
		$query = "INSERT INTO  `edusoftg_preins_cat`.`datos_preins` (
		`id` ,
		`documento` ,
		`nombre` ,
		`correo` ,
		`grupo` ,
		`convenio` ,
		`fecha_insc` ,
		`SAP`,
		`horario`
		)
		VALUES 
			(NULL ,  '$doc',  '$nom',  '$mail',  '$grup',  '$convenio',  '$fecha_i',  '$sap', '$horario'
		);";

		if(mysql_query($query))
		{
			// echo "Pre registro exitoso." . "<br>". "Recuerde nuestra linea de soporte: soporte@edusoftglobal.com";
			echo "Registro exitoso al curso de SAP."."<br>";
		}
		else
		{
			echo "Se encontro el siguiente Error en la consulta ".mysql_error();
		}
	}
	else
	{
		$mensaje .= "No hay cupos disponibles para el curso de SAP en el convenio seleccionado."."<br>";
	}
}

echo $mensaje .= "<p>Recuerde nuestra linea de atención:<br>soporte@edusoftglobal.com</p>
					<h2>pronto enviaremos un correo electronico informándole sobre su inscripción a los cursos.</h2>
					<hr>";

?>
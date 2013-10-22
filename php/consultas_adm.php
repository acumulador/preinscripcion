<?php
include('conex.php');

$tipoConsulta = $_GET['myTipoCons'];
$parametro = $_GET['myParametro'];

$sql = "";
if($tipoConsulta == '1')
{
	//Consulta por horario
	$sql = "SELECT COUNT( `horario` ) AS total
			FROM `datos_preins` 
			WHERE `horario` = '$parametro'";

	if($res = mysql_query($sql))
	{
		while($fila = mysql_fetch_array($res))
		{
			$mensaje = "Total de alumnos en el horario seleccionado: ".$fila['total'];
		}
	}
	else
	{
		echo "Error: ".mysql_error();
	}
}
else
{
	if($tipoConsulta == '2')
	{
		//Consulta por grupo
		switch ($parametro) 
		{
		    case "sapConser":
		        $sql = "SELECT COUNT(  `SAP` ) AS total
						FROM  `datos_preins` 
						WHERE  `convenio` =  'conservacion'
						AND  `SAP` =  '1'";
		        break;
		    case "sapDepur":
		        $sql = "SELECT COUNT(  `SAP` ) AS total
						FROM  `datos_preins` 
						WHERE  `convenio` =  'depuracion'
						AND  `SAP` =  '1'";
		        break;
		    case "excConser":
		        $sql = "SELECT COUNT(  `Excel` ) AS total
						FROM  `datos_preins` 
						WHERE  `convenio` =  'conservacion'
						AND  `Excel` =  '1'";
		        break;
		    case "excDepur":
		        $sql = "SELECT COUNT(  `Excel` ) AS total
						FROM  `datos_preins` 
						WHERE  `convenio` =  'depuracion'
						AND  `Excel` =  '1'";
		        break;
		}

		if($res = mysql_query($sql))
		{
			while($fila = mysql_fetch_array($res))
			{
				$mensaje = "Total de alumnos en el grupo seleccionado: ".$fila['total'];
			}
		}
		else
		{
			echo "Error: ".mysql_error();
		}
	}
}

echo $mensaje;

?>
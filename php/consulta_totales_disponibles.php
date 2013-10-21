<?php
include('conex.php');

$tipoConsulta = $_GET['myTipoCons'];
//$tipoConsulta = "1";
$parametro = $_GET['myParametro'];
$sqlE = "";
$sqlS = "";
$sqlH = "";
$mensaje = "";

if($parametro == "conservacion")
{
	$cuposSAP = 50;
}
else
{
	if($parametro == "depuracion")
	{
		$cuposSAP = 25;
	}
}

//tipo de consulta:
//1: consulta disponibilidad de convenio
//2: consulta disponibilidad de cupos en curso
if($tipoConsulta == "1")
{
	//convenio
	$sqlE = "SELECT COUNT(  `convenio` ) as total FROM  `datos_preins` WHERE  `convenio` =  '$parametro' AND Excel =  '1'";
	$sqlS = "SELECT COUNT(  `convenio` ) as total FROM  `datos_preins` WHERE  `convenio` =  '$parametro' AND SAP =  '1'";
}
else 
{
	if($tipoConsulta == "2")
	{
		$sqlH = "SELECT COUNT(  `horario` ) AS total FROM  `datos_preins` WHERE  `horario` =  '$parametro'";
	}
}

if($tipoConsulta == "1")
{
	if($resE = mysql_query($sqlE))
	{
		while($filaE = mysql_fetch_array($resE))
		{
			$mensaje = (25 - $filaE['total'])." cupos disponibles de Excel"; //en $parametro";
		}
	}
	else
	{
		echo "Error: ".mysql_error();
	}

	if($resS = mysql_query($sqlS))
	{
		while($filaS = mysql_fetch_array($resS))
		{
			$mensaje .= " y ".($cuposSAP - $filaS['total'])." cupos disponibles de SAP en ".$parametro;
			echo $mensaje;
		}
	}
	else
	{
		echo "Error: ".mysql_error();
	}
}
else
{
	if($tipoConsulta == "2")
	{
		if($resH = mysql_query($sqlH))
		{
			while($filaH = mysql_fetch_array($resH))
			{
				$mensaje = (25 - $filaH['total'])." cupos disponibles en el horario ".$parametro." para el curso de SAP";
				echo $mensaje;
			}
		}
		else
		{
			echo "Error: ".mysql_error();
		}
	}
}

?>
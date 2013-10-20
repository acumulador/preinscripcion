<?php
include('conex.php');

//$tipoConsulta = $_GET['myTipoCons'];
$tipoConsulta = "1";
$parametro = $_GET['myParametro'];
$sql = "";
$resultado= "";
//tipo de consulta:
//1: consulta disponibilidad de convenio
//2: consulta disponibilidad de cupos en curso
if($tipoConsulta == "1")
{
	//convenio
	$sql = "SELECT COUNT(  `convenio` ) AS total FROM  `datos_preins` WHERE  `convenio` =  '$parametro'";
}
else 
{
	if($tipoConsulta == "2")
	{
		// $sql = "SELECT COUNT(  `horario` ) AS total ";
		// $sql += "FROM  `datos_preins` ";
		// $sql += "WHERE  `horario` =  '$parametro'";
	}
}

if($resultado = mysql_query($sql))
{
	while($fila = mysql_fetch_array($resultado))
	{
		echo $fila['total']." cupo(s) disponible en $parametro";
	}
}
else
{
	echo "Error: ".mysql_error()." mi query es: ".$sql." y el tipo consulta es: ".$tipoConsulta." el contenido del parametro es: ".$parametro;
}


?>
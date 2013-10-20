<?php
header("Content-Type: text/html;charset=utf-8");
include('conex.php');

$doc = $_POST['txtDocumento'];
$nom = utf8_encode ($_POST['txtNombre']);
$mail = $_POST['txtCorreo'];
$grup = $_POST['txtGrupo'];
$convenio = $_POST['cbConvenio'];
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

$query = "INSERT INTO  `edusoftg_preins_cat`.`datos_preins` (
	`id` ,
	`documento` ,
	`nombre` ,
	`correo` ,
	`grupo` ,
	`convenio` ,
	`fecha_insc` ,
	`SAP` ,
	`Excel`,
	`horario`
	)
VALUES 
	(NULL ,  '$doc',  '$nom',  '$mail',  '$grup',  '$convenio',  '$fecha_i',  '$sap',  '$excel', '$horario'
);";

if(mysql_query($query))
{
	// echo "Pre registro exitoso." . "<br>". "Recuerde nuestra linea de soporte: soporte@edusoftglobal.com";
	echo "Pre registro exitoso.<br>
			<p>Recuerde nuestra linea de atención:<br>soporte@edusoftglobal.com</p>
			<h2>pronto enviaremos un correo electronico informandole sobre su inscripcion a los cursos solicitados.</h2>
			<hr>";
}
else
{
	echo "Se encontro el siguiente Error en la consulta ".mysql_error();
}

?>
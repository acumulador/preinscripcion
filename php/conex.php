<?php

 $servidor="localhost";
 $usuario="edusoftg_jklos";
 $clave="j123456";
 $bd="edusoftg_preins_cat";
 
 // $servidor="localhost";
 // $usuario="root";
 // $clave="";
 // $bd="preins_cat";

	mysql_connect("$servidor","$usuario","$clave");
	mysql_select_db("$bd");
?>

$(document).on("ready",ini);
var sw = false;
var tipoCons;
var param;
var totConv = "";

function ini()
{
	$("#btnRegistrar").on("click", regCursos);
	$(".fondo-pop").on("click", salePop);
	$(".fondo-pop, .pop").fadeIn("slow");
	$("#btnSalir").on("click",saleReg);
	$("#ckExcel").on("click",clickCheckExcel);
	$("#ckSAP").on("click",clickCheckSAP);
	//Validaciones
	$('#txtNombre').validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéiou');
	$('#txtGrupo').validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéiou');
    $('#txtDocumento').validCampoFranz('0123456789');

    //cupos y disponibilidad
    $("#cbConvenio").on("change", consTotConvenio);
    $("#cbHorario").on("change", consTotHorario);

    //mayusculas
    $("#txtNombre").on("keyup",NomAMayuscula); 
    $("#txtGrupo").on("keyup",GruAMayuscula);
}

function consTotConvenio()
{
	// alert("Si se detecto canbio!!");
	tipoCons = "1";
	param = $('#cbConvenio').val();
    $('#totConvenio').load('php/consulta_totales_disponibles.php?myTipoCons='+tipoCons+'&myParametro='+param);
}

function consTotHorario()
{
	tipoCons = "2";
	param = $('#cbHorario').val();
    $('#totHorario').load('php/consulta_totales_disponibles.php?myTipoCons='+tipoCons+'&myParametro='+param);
}

function NomAMayuscula()
{
	$(this).val($(this).val().toUpperCase());
}

function GruAMayuscula()
{
	$(this).val($(this).val().toUpperCase());
}

function clickCheckExcel()
{
	if($("#ckExcel").is(":checked") == true && $("#ckSAP").is(":checked") == false)
	{
		$("#selHorario").hide();
	}
}

function clickCheckSAP()
{
	if($("#ckSAP").is(":checked") == true)
	{
		$("#selHorario").show();
	}
	else
	{
		$("#selHorario").hide();
	}
}

function validaFormulario()
{
	if($("#txtDocumento").val().length < 5)
	{
		alert("Por favor ingrese el documento valido. Verifique solo numeros, espacios y puntos.");
		$("#txtDocumento").focus();
		sw = false;
	}
	else if($("#txtNombre").val().length < 8 )
	{
		alert("Por favor ingrese nombre valido. Verifique minimo 8 caracteres y solo letras.");
		$("#txtNombre").focus();
		sw = false;
	}
	else if($("#txtCorreo").val().length < 8 )
	{
		alert("Por favor ingrese un correo valido. Verifique el formato correcto de correo electronico y minimo 8 caracteres.");
		$("#txtCorreo").focus();
		sw = false;
	}
	else if($("#txtGrupo").val().length < 4)
	{
		alert("Por favor ingrese un grupo de trabajo valido. Verifique Sistemas, cartografia, avaluos, geodata");
		$("#txtGrupo").focus();
		sw = false;
	}
	else if($("#cbConvenio").val() == "ninguno")
	{
		alert("Por favor seleccione un convenio. Conservación o Depuración");
		sw = false;
	}
	else if($("#ckSAP").is(":checked") == false && $("#ckExcel").is(":checked") == false )
	{
		alert("Por favor seleccione un curso. Excel o SAP");
		sw = false;
	}
	else if($("#cbHorario").val() == "ninguno" && $("#ckSAP").is(":checked") == true)
	{
		alert("Por favor seleccione un Horario. Viernes 4-7, Sabado 8-11 o Sabado 11-2");
		sw = false;
	}
	else
	{
		sw = true;
	}
}

function regCursos()
{
	// Valido los campos
	validaFormulario();
	
	if(sw)
	{
		//envio el formulario con AJAX
		$.ajax({
                type: "POST",
                url: $("#form").attr('action'),
                data: $("#form").serialize(),
                success: function(data) {
                  	$("#mensaReg").html(data);
                },
                error: function() {
                    $("#mensaReg").html(data);
                }
            });
            $("#pop_reg").animate({
        		top: 0
    	    });
	}
}

function saleReg()
{
	$("#pop_reg").animate({
        top: "-115%"
    });
    prLimpiarForm();
}

function salePop()
{
	$(".fondo-pop, .pop").fadeOut("slow");
	prLimpiarForm();
}

function prLimpiarForm()
{
	$("#txtDocumento").val("");
	$("#txtNombre").val("");
	$("#txtCorreo").val("");
	$("#txtGrupo").val("");
	$("#cbConvenio").val("ninguno");
	$("#cbHorario").val("ninguno");
	$("#ckSAP").removeAttr("checked");
	$("#ckExcel").removeAttr("checked");

	$("#selHorario").hide();
	$("#totConvenio").val("");
	$("#totHorario").val("");
}
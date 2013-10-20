$(document).on("ready",ini);

function ini()
{
	$("#btnRegistrar").on("click", regCursos);
	$(".fondo-pop").on("click", salePop);
	$(".fondo-pop, .pop").fadeIn("slow");
	$("#btnSalir").on("click",saleReg);
}

function regCursos()
{
	// Valido los campos
	if($("#txtDocumento").val().length < 5)
	{
		alert("Por favor ingrese el documento valido.");
		$("#txtDocumento").focus();
		return false;
	}
	else if($("#txtNombre").val().length < 15 )
	{
		alert("Por favor ingrese nombre valido.");
		$("#txtNombre").focus();
		return false;
	}
	else if($("#txtCorreo").val().length < 15 )
	{
		alert("Por favor ingrese un correo valido.");
		$("#txtCorreo").focus();
		return false;
	}
	else if($("#txtGrupo").val().length < 5)
	{
		alert("Por favor ingrese un grupo valido.");
		$("#txtGrupo").focus();
		return false;
	}
	else if($("#cbConvenio").val() == "ninguno")
	{
		alert("Por favor seleccione un convenio.");
		return false;
	}
	else if($("#ckSAP").is(":checked") == false && $("#ckExcel").is(":checked") == false )
	{
		alert("Por favor seleccione un curso.");
		return false;
	}
	else
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
	$("#ckSAP").removeAttr("checked");
	$("#ckExcel").removeAttr("checked");
}
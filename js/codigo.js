
$(document).on("ready",ini);
boolean sw = false;

function ini()
{
	$("#btnRegistrar").on("click", regCursos);
	$(".fondo-pop").on("click", salePop);
	$(".fondo-pop, .pop").fadeIn("slow");
	$("#btnSalir").on("click",saleReg);
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
	else if($("#txtGrupo").val().length < 5)
	{
		alert("Por favor ingrese un grupo de trabajo valido. Verifique Sistemas, cartografia, avaluos, geodata");
		$("#txtGrupo").focus();
		return false;
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
	$("#ckSAP").removeAttr("checked");
	$("#ckExcel").removeAttr("checked");
}
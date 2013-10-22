
$(document).on("ready",ini);

function ini()
{
	$("#cbHorario").on("change", consTotHorario);
	$("#cbGrupo").on("change", consTotGrupo);
}

function consTotHorario()
{
	tipoCons = "1";
	param = $('#cbHorario').val();
    $('#resHorario').load('../php/consultas_adm.php?myTipoCons='+tipoCons+'&myParametro='+param);
}

function consTotGrupo()
{
	tipoCons = "2";
	param = $('#cbGrupo').val();
    $('#resGrupo').load('../php/consultas_adm.php?myTipoCons='+tipoCons+'&myParametro='+param);
}
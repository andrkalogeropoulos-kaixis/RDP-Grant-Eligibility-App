function live_searching_katoikia()
{
	var per_enotita = document.getElementById("per_enotita_id").value;
	var dimos = document.getElementById("dimos_id").value;
	var dimot_enotita = document.getElementById("dimot_enotita_id").value;
		
	$.post(
		'lista_katoikia.php' ,
		{ per_enotita_input: per_enotita ,
		 dimos_input: dimos ,
		 dimot_enotita_input: dimot_enotita },
		function(res) { $('#div_katoikia_id').html(res); } 
		)
}


function live_searching_kalliergeies()
{
	var osde_category = document.getElementById("osde_category_id").value;
		
	$.post(
		'lista_kalliergeies.php' ,
		{ osde_category_input: osde_category },
		function(res) { $('#div_kalliergeia_id').html(res); } 
	);
}

function drastiriotites_post()
{
	var osde_category = document.getElementById("osde_category_id").value; 
	var kalliergeia = document.getElementById("kalliergeia_id").value;
	var nea_fyteia = document.getElementById("nea_fyteia_id").checked;
	var ektasi_zwa = document.getElementById("ektasi_zwa_id").value; 
	var idioktisia = document.getElementById("idioktisia_id").value;
	var biologiki = document.getElementById("biologiki_id").checked;
 
	$.post(
		'drastiriotites.php' ,
		{ osde_category_input: osde_category ,
		 kalliergeia_input: kalliergeia ,
		 nea_fyteia_input: nea_fyteia ,
		 ektasi_zwa_input: ektasi_zwa ,
		 idioktisia_input: idioktisia ,
		 biologiki_input: biologiki },
		function(res) { $('#div_form_drast_id').html(res); } 
	);
}

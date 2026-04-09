function rem_drastiriotita(rec)
{
	$.post(
		'remove_drast.php' ,
		{ rec_input: rec } ,
		function(res) { $('#div_table_drast_id').html(res); }
	);
}

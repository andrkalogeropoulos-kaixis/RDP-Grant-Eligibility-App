<!-- ΥΠΟΛΟΓΙΣΜΟΣ ΤΥΠΙΚΗΣ ΑΠΟΔΟΣΗΣ ΓΙΑ ΚΑΘΕ ΔΡΑΣΤΗΡΙΟΤΗΤΑ -->

<?php session_start();

include ('connect_db.php');

$q_apodosi = mysqli_query($link, "SELECT so, standard_outputs.so_code, osde_code FROM standard_outputs, kalliergeies2 WHERE kalliergeies2.so_code = standard_outputs.so_code AND kalliergeies2.id =".$kalliergeia);
$apod = mysqli_fetch_array($q_apodosi);

$apodosi = $apod['so'] * $ektasi_zwa;	//Αρχικός υπολογισμός απόδοσης



if ( substr($apod['so_code'],0,3) == 'C_5' )		//Πουλερικά 
	{$apodosi = $apodosi / 100;}			//(ανά 100 κεφάλια)
	
elseif ( $apod['standard_outputs.so_code'] == 'B_6_1')	//Μανιτάρια με εξαίρεση τις τρούφες 
	{$apodosi = $apodosi * 10;}			//(ανά 100 τμ)

elseif ( substr($osde_category,0,1) == 'f' )	//Υπόλοιπη φυτική παραγωγή 
	{$apodosi = $apodosi * 0.1;}		//(ανά εκτάριο)


if ($nea_fyteia == 'true')
	$apodosi = $apodosi / 2;		//Στις νέες φυτείες, η τυπική απόδοση είναι η μισή

?>



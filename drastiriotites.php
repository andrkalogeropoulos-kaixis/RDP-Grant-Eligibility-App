<!-- ΚΑΤΑΧΩΡΗΣΗ, ΣΕ ΜΕΤΡΑΒΛΗΤΕΣ, ΤΩΝ ΔΡΑΣΤΗΡΙΟΤΗΤΩΝ -->

<?php session_start();

$osde_category = $_POST['osde_category_input'];
$kalliergeia = $_POST['kalliergeia_input'];
$nea_fyteia = $_POST['nea_fyteia_input'];
$ektasi_zwa = $_POST['ektasi_zwa_input'];
$idioktisia = $_POST['idioktisia_input']; if (!$idioktisia) $idioktisia = 0;
$biologiki = $_POST['biologiki_input'];

if ( $osde_category or $kalliergeia or $ektasi_zwa or $idioktisia)
	{
	$_SESSION["subt_rec"] = TRUE; 
	}

if (!$kalliergeia or !$ektasi_zwa or ($idioktisia && !ctype_digit($idioktisia)) or ($ektasi_zwa && !is_numeric($ektasi_zwa)) or $idioktisia>100)
	{
	include('form_drastiriotites.php');	
	exit();
	}

//--------------------------------------------------------------------------

//Το ζωικό και μελισσοκομικό κεφάλαιο πρέπει να είναι ιδιόκτητο
//Υπό αυτή την προϋπόθεση υπολογίζεται η Τυπική Απόδοση της δραστηριότητας
if (substr($osde_category,0,1) == 'z' and $idioktisia<100)
	{$apodosi = 'ΜΗ ΕΠΙΛΕΞΙΜΗ<sup>**</sup>';}
else
	{include('typiki_apodosi.php');}

//--------------------------------------------------------------------------

if (!$_SESSION[ $_SESSION['pinakas'] ]) 
	{$_SESSION[ $_SESSION['pinakas'] ] = array();}

array_push($_SESSION[ $_SESSION['pinakas'] ], array ($osde_category, $kalliergeia, $ektasi_zwa, $idioktisia, $biologiki, $apodosi, $nea_fyteia));

//--------------------------------------------------------------------------

$osde_category = NULL;
$kalliergeia = NULL;
$ektasi_zwa = NULL;
$idioktisia = NULL;
$biologiki = NULL;
$apodosi = NULL;
$nea_fyteia = NULL;

$_SESSION["subt_rec"] = NULL;


?>



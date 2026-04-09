/* * CRITERIA EVALUATION & SCORE CALCULATION ENGINE
 * This script processes all session data, calculates Standard Output (SO),
 * and assigns points based on the official RDP criteria.
 * I have translated it in English
 */

<?php session_start(); 


include ('connect_db.php');

 
//-------------------- Criterion 1.1: Geotechnical Education/Degree --------------------------------

if ($_SESSION['titlos'] == 'y')
	$baryt_1_1 = 1;
$moria['1.1'] = 100 * $baryt_1_1;


//-------------------- Criterion 2.1: Membership in Producer Groups/Organizations ------------------

if ($_SESSION['omades'] == 'y')
	$baryt_2_1 = 1;
$moria['2.1'] = 100 * $baryt_2_1;


//--------------------- Criterion 3.1: Low Individual & Family Income -------------------------------

$_SESSION['oikogeneiako'] = $_SESSION['atomiko'] + $_SESSION['syzygou'];

if ($_SESSION['atomiko'] <= 7500 and $_SESSION['oikogeneiako'] <= 20000)
	$baryt_3_1 = 1;
$moria['3.1'] = 100 * $baryt_3_1;


//--------------------- Criterion 3.2: Long-term Unemployment Months --------------------------------

if ($_SESSION['anergia'] >=12)
	$baryt_3_2 = 1;
$moria['3.2'] = 100 * $baryt_3_2;


//--------------------- Criterion 4.1: Mountainous or Insular Areas (Directives 85/148/EEC) ---------

if ($_SESSION['oreini_nisi'] == 'y')
	$baryt_4_1 = 1;
$moria['4.1'] = 100 * $baryt_4_1;


//-------------------- Criterion 4.2: Small Local Communities (Population < 2,500) -------------------

$pop_query = mysqli_query($link, "SELECT population FROM topikes_koinotites WHERE code =".$_SESSION['topiki_koinotita']);

$population = mysqli_fetch_array($pop_query);
if ($population[0] <= 2500)
	{$baryt_4_2 = 1;}
elseif ($population[0] <= 5000)
	{$baryt_4_2 = 0.5;}
$moria['4.2'] = 100 * $baryt_4_2;



/// --- Calculation of Initial Standard Output (Present State) ---
// Loop through all registered activities and sum their economic value (SO)

// --- Sector Specific Analysis (Criterion 5.1, 5.2, 5.3) ---
// Identifying if the farm is specialized in specific sectors (e.g., Livestock, Permanent Crops)
// Points are awarded if a specific sector exceeds 50% of the total SO.


$sum_so_arx=0; //Συνολική Τυπική Απόδοση

$idiokt_so=0; //Σύνολο τυπικής απόδοσης που προέρχεται από ιδιόκτητη γη και ζωικό κεφάλαιο

foreach($_SESSION['drastiriotites'] as $drastiriotita){
	$sum_so_arx = $sum_so_arx + $drastiriotita[5];	
	$idiokt_so = $idiokt_so + ($drastiriotita[5]/*apodosi*/*$drastiriotita[3]/*idioktisia*//100);
	}	


//-------------------- Criterion 5.1 ------------------------------------------------------
	
	$pososto = $idiokt_so / $sum_so_arx;
	
	if ($pososto <= 0.25)
		{$baryt_5_1 = 0;}
	else
		{$baryt_5_1 = $pososto;}
	
	$moria['5.1'] = 100 * $baryt_5_1;


//-------------------- Criterion 5.2 ------------------------------------------------------
	
	if ($sum_so_arx >= 8000 and $sum_so_arx <= 10000)
		{$baryt_5_2 = 0.5;}
	elseif ($sum_so_arx > 10000 and $sum_so_arx <= 15000)
		{$baryt_5_2 = 0.8;}
	elseif ($sum_so_arx > 15000 and $sum_so_arx <= 25000)
		{$baryt_5_2 = 1;}
	
	$moria['5.2'] = 100 * $baryt_5_2;


//---------------------- Criterion 5.3 ---------------------------------

//Αρχικοποίηση της Τυπικής απόδοσης για κάθε κλάδο
$so_paa1 = 0;
$so_paa2 = 0;
$so_paa3 = 0;
$so_paa4 = 0;

//Παίρνουμε τον πίνακα που δείχνει σε ποιούς προωθούμενους κλάδους ανήκει κάθε δραστηριότητα
foreach($_SESSION['drastiriotites'] as $drastiriotita){
	$sql=mysqli_query($link, "SELECT paa1, paa2, paa3, paa4 FROM kalliergeies2, kladoi_paa WHERE kalliergeies2.kladoi_paa = kladoi_paa.id AND kalliergeies2.id=".$drastiriotita[1]/*kalliergeia*/);
	$kl_paa = mysqli_fetch_array($sql);
	foreach($kl_paa as $key => $value){
		if ($value == 1)
			${'so_'.$key} = ${'so_'.$key} + $drastiriotita[5]; //Αν ο κλάδος είναι προωθούμενος προσθέτουμε την Τυπική Απόδοση της δραστηριότητας στη Συνολική του κλάδου
	}
}


//Τοποθέτηση των τυπικών αποδόσεων σε σειρές ώστε να αποθηκευτεί το όνομα της μεταβλητής
$arr[$so_paa1] = 'paa1';
$arr[$so_paa2] = 'paa2';
$arr[$so_paa3] = 'paa3';
$arr[$so_paa4] = 'paa4';

//Επιλέγουμε τη μέγιστη Τυπική Απόδοση και υπολογίζουμε το ποσοστό αυτής επί της συνολικής
$so_paa = max($so_paa1, $so_paa2, $so_paa3, $so_paa4);

$pososto_so = $so_paa / $sum_so_arx;

//Αν το ποσοστό είναι μεγαλύτερο του 50% παίρνει τα μόρια του αντίστοιχου κλάδου
if ($pososto_so >= 0.5){
	$sql=mysqli_query($link, 'SELECT barytita FROM kladoi WHERE code ="'.$arr[$so_paa].'"');
	$arr_baryt_5_3 = mysqli_fetch_array($sql);
	$baryt_5_3 = $arr_baryt_5_3[0] * $pososto_so;
}

$moria['5.3']= 100 * $baryt_5_3;				



//---------------------- Criterion 5.4 ---------------------------------

//Αρχικοποίηση της Τυπικής απόδοσης για κάθε κλάδο
$so_att1 = 0;
$so_att2 = 0;
$so_att3 = 0;
$so_att4 = 0;
$so_att5 = 0;

//Παίρνουμε τον πίνακα που δείχνει σε ποιούς προωθούμενους κλάδους ανήκει κάθε δραστηριότητα
foreach($_SESSION['drastiriotites'] as $drastiriotita){
	$sql=mysqli_query($link, "SELECT att1, att2, att3, att4, att5 FROM kalliergeies2, kladoi_att WHERE kalliergeies2.kladoi_att = kladoi_att.id AND kalliergeies2.id=".$drastiriotita[1]/*kalliergeia*/);
	$kl_att = mysqli_fetch_array($sql);
	foreach($kl_att as $key => $value){
		if ($value == 1)
			${'so_'.$key} = ${'so_'.$key} + $drastiriotita[5]; //Αν ο κλάδος είναι προωθούμενος προσθέτουμε την Τυπική Απόδοση της δραστηριότητας στη Συνολική του κλάδου
	}
}


//Τοποθέτηση των τυπικών αποδόσεων σε σειρές ώστε να αποθηκευτεί το όνομα της μεταβλητής
$arr[$so_att1] = 'att1';
$arr[$so_att2] = 'att2';
$arr[$so_att3] = 'att3';
$arr[$so_att4] = 'att4';
$arr[$so_att5] = 'att5';

//Επιλέγουμε τη μέγιστη Τυπική Απόδοση και υπολογίζουμε το ποσοστό αυτής επί της συνολικής
$so_att = max($so_att1, $so_att2, $so_att3, $so_att4, $so_att5);

$pososto_so = $so_att / $sum_so_arx;

//Αν το ποσοστό είναι μεγαλύτερο του 50% παίρνει τα μόρια του αντίστοιχου κλάδου
if ($pososto_so >= 0.5){
	$sql=mysqli_query($link, 'SELECT barytita FROM kladoi WHERE code ="'.$arr[$so_att].'"');
	$arr_baryt_5_4 = mysqli_fetch_array($sql);
	$baryt_5_4 = $arr_baryt_5_4[0] * $pososto_so;
}

$moria['5.4'] = 100 * $baryt_5_4;				



// --- Quality Systems (Criterion 6.1, 6.2, 6.3) ---
// Points for Organic Farming, GlobalGap, PDO, or PGI products.


$sum_so_epix=0; //Συνολική Τυπική Απόδοση

$biol_so=0; //Σύνολο τυπικής απόδοσης που προέρχεται από προϊόντα βιολογικά ή ολοκληρωμένης διαχείρισης

foreach($_SESSION['epixeirimatiko'] as $drastiriotita){
	$sum_so_epix = $sum_so_epix + $drastiriotita[5];	
	$biol_so = $biol_so + ($drastiriotita[5]/*apodosi*/*$drastiriotita[4]/*biologiki*/);
	}	


//-------------------- Criterion 6.1 ------------------------------------------------------
	
	$pososto = $biol_so / $sum_so_epix;
	
	if ($pososto >= 0.4)
		{$baryt_6_1 = 1;}
		
	$moria['6.1'] = 100 * $baryt_6_1;



//---------------------- Criterion 6.2 ---------------------------------

//Αρχικοποίηση της Τυπικής απόδοσης για κάθε κλάδο
$so_paa1 = 0;
$so_paa2 = 0;
$so_paa3 = 0;
$so_paa4 = 0;

//Παίρνουμε τον πίνακα που δείχνει σε ποιούς προωθούμενους κλάδους ανήκει κάθε δραστηριότητα
foreach($_SESSION['epixeirimatiko'] as $drastiriotita){
	$sql=mysqli_query($link, "SELECT paa1, paa2, paa3, paa4 FROM kalliergeies2, kladoi_paa WHERE kalliergeies2.kladoi_paa = kladoi_paa.id AND kalliergeies2.id=".$drastiriotita[1]/*kalliergeia*/);
	$kl_paa = mysqli_fetch_array($sql);
	foreach($kl_paa as $key => $value){
		if ($value == 1)
			${'so_'.$key} = ${'so_'.$key} + $drastiriotita[5]/*apodosi*/; //Αν ο κλάδος είναι προωθούμενος προσθέτουμε την Τυπική Απόδοση της δραστηριότητας στη Συνολική του κλάδου
	}
}


//Τοποθέτηση των τυπικών αποδόσεων σε σειρές ώστε να αποθηκευτεί το όνομα της μεταβλητής
$arr[$so_paa1] = 'paa1';
$arr[$so_paa2] = 'paa2';
$arr[$so_paa3] = 'paa3';
$arr[$so_paa4] = 'paa4';

//Επιλέγουμε τη μέγιστη Τυπική Απόδοση και υπολογίζουμε το ποσοστό αυτής επί της συνολικής
$so_paa = max($so_paa1, $so_paa2, $so_paa3, $so_paa4);

$pososto_so = $so_paa / $sum_so_epix;

//Αν το ποσοστό είναι μεγαλύτερο του 50% παίρνει τα μόρια του αντίστοιχου κλάδου
if ($pososto_so >= 0.5){
	$sql=mysqli_query($link, 'SELECT barytita FROM kladoi WHERE code ="'.$arr[$so_paa].'"');
	$arr_baryt_6_2 = mysqli_fetch_array($sql);
	$baryt_6_2 = $arr_baryt_6_2[0] * $pososto_so;
}

$moria['6.2'] = 100 * $baryt_6_2;				



//---------------------- Criterion 6.3 ---------------------------------

//Αρχικοποίηση της Τυπικής απόδοσης για κάθε κλάδο
$so_att1 = 0;
$so_att2 = 0;
$so_att3 = 0;
$so_att4 = 0;
$so_att5 = 0;

//Παίρνουμε τον πίνακα που δείχνει σε ποιούς προωθούμενους κλάδους ανήκει κάθε δραστηριότητα
foreach($_SESSION['epixeirimatiko'] as $drastiriotita){
	$sql=mysqli_query($link, "SELECT att1, att2, att3, att4, att5 FROM kalliergeies2, kladoi_att WHERE kalliergeies2.kladoi_att = kladoi_att.id AND kalliergeies2.id=".$drastiriotita[1]/*kalliergeia*/);
	$kl_att = mysqli_fetch_array($sql);
	foreach($kl_att as $key => $value){
		if ($value == 1)
			${'so_'.$key} = ${'so_'.$key} + $drastiriotita[5]; //Αν ο κλάδος είναι προωθούμενος προσθέτουμε την Τυπική Απόδοση της δραστηριότητας στη Συνολική του κλάδου
	}
}


//Τοποθέτηση των τυπικών αποδόσεων σε σειρές ώστε να αποθηκευτεί το όνομα της μεταβλητής
$arr[$so_att1] = 'att1';
$arr[$so_att2] = 'att2';
$arr[$so_att3] = 'att3';
$arr[$so_att4] = 'att4';
$arr[$so_att5] = 'att5';

//Επιλέγουμε τη μέγιστη Τυπική Απόδοση και υπολογίζουμε το ποσοστό αυτής επί της συνολικής
$so_att = max($so_att1, $so_att2, $so_att3, $so_att4, $so_att5);

$pososto_so = $so_att / $sum_so_epix;

//Αν το ποσοστό είναι μεγαλύτερο του 50% παίρνει τα μόρια του αντίστοιχου κλάδου
if ($pososto_so >= 0.5){
	$sql=mysqli_query($link, 'SELECT barytita FROM kladoi WHERE code ="'.$arr[$so_att].'"');
	$arr_baryt_6_3 = mysqli_fetch_array($sql);
	$baryt_6_3 = $arr_baryt_6_3[0];
}

$moria['6.3'] = 100 * $baryt_6_3;				



//---------------------------------------------------------------------
// ----------------------- Final Point Weighting ----------------------
// Multiplying base points by the official weighting factors from the database.


foreach ($moria as $key => $value) {
	$sql=mysqli_query($link, 'SELECT barytita FROM kritiria1 WHERE a_a ='.$key);
	$barytita = mysqli_fetch_array($sql);
	$t_moria[$key] = $value * $barytita[0];
}



//------------------------ Total Score Summation ----------------

$sum_moria = 0;
foreach ($t_moria as $value)
	$sum_moria = $sum_moria + $value;


// ----------------------- Eligibility Logic Gate ---------------
// Minimum requirement: 8,000 EUR < Total SO < 100,000 EUR.

$sql=mysqli_query($link, "SELECT a_a, kritirio, analysi FROM kritiria1");

//---------------------------------------------------------------------

include ('sima.php');

//---------------------------------------------------------------------

if ($sum_so_arx < 8000 or $sum_so_arx > 100000){
	echo "
<br>
<table border = 1><tr><td>
<p>Η Τυπική Απόδοση της εκμετάλλευσής σας είναι <b>".$sum_so_arx." €</b></p>
<p>Η  γεωργική  εκμετάλλευση  πρέπει  να  έχει  μέγεθος  παραγωγικής  δυναμικότητας  (εκφρασμένη  ως  τυπική 
απόδοση) τουλάχιστον ίσο με <b>8.000 €</b> έως και <b>100.000 €</b></p><br>
<h1><font color='red'><b>Δυστυχώς δεν πληρείτε τα κριτήρια επιλεξιμότητας!</b></font></h1>
</td></tr></table>
<br>
";
}else{
include('table_kritiria.php');
}
?>

<html>
<body>
<br>
<button type="button" onclick="location.href='page_5.php';"><< Προηγούμενο</button>
<button type="button" style="width: 150px; height: 100px;" onclick="location.href='logout.php';"><h2>ΕΞΟΔΟΣ >></h2></button>

</body>
</html>


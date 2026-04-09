<!-- 5η ΣΕΛΙΔΑ: ΑΝΑΚΕΦΑΛΑΙΩΣΗ ΣΤΟΙΧΕΙΩΝ ΠΟΥ ΕΙΣΗΓΑΓΕ Ο ΧΡΗΣΤΗΣ -->

<?php session_start(); 

//--------------------------------------------------------------------------

$_SESSION['page']= 5;

//--------------------------------------------------------------------------

include ('connect_db.php');

$perifereies = mysqli_query($link, "SELECT descr FROM perifereies WHERE id =".$_SESSION['perifereia']);
$per_enotites = mysqli_query($link, "SELECT descr FROM per_enotites WHERE code =".$_SESSION['per_enotita']);
$dimoi = mysqli_query($link, "SELECT descr FROM dimoi WHERE code =".$_SESSION['dimos']);
$dimot_enotites = mysqli_query($link, "SELECT descr FROM dimot_enotites WHERE code =".$_SESSION['dimot_enotita']);
$topikes_koinotites = mysqli_query($link, "SELECT descr FROM topikes_koinotites WHERE code =".$_SESSION['topiki_koinotita']);
$oikismoi = mysqli_query($link, "SELECT descr FROM oikismoi WHERE code =".$_SESSION['oikismos']);

$perifereia = mysqli_fetch_array($perifereies);
$per_enotita = mysqli_fetch_array($per_enotites);
$dimos = mysqli_fetch_array($dimoi);
$dimot_enotita = mysqli_fetch_array($dimot_enotites);
$topiki_koinotita = mysqli_fetch_array($topikes_koinotites);
$oikismos = mysqli_fetch_array($oikismoi);

include ('sima.php');

?>

<html>
<body>
<br>
<b><u>ΕΙΣΑΓΑΤΕ ΤΑ ΕΞΗΣ ΣΤΟΙΧΕΙΑ:</u></b>

<br><br>

<table border=1><tr><td>

<p>Πτυχίο - Τίτλος Σπουδών Γεωτεχνικής Κατεύθυνσης ανώτερο ή ίσο με επίπεδο 5 του Εθνικού Πλαισίου Προσόντων: <b><?php echo ($_SESSION['titlos']=='y') ? 'ΝΑΙ' : 'ΟΧΙ'?></b></p>

<p>Συμμετοχή σε Ομάδες ή Οργανώσεις Παραγωγών: <b><?php echo ($_SESSION['omades']=='y') ? 'ΝΑΙ' : 'ΟΧΙ'?></b></p>

<br><p>Eτήσιο εισόδημα που δηλώσατε στο Ε1 της τελευταίας χρονιάς:</p>
<?php echo '<p><b>Το δικό σας:     '.htmlspecialchars($_SESSION['atomiko']).'€ </b></p>';
      echo '<p><b>Του/Της συζύγου: '.htmlspecialchars($_SESSION['syzygou']).'€ </b></p>'; ?>

<br><p>Μήνες ανεργίας κατά το τελευταίο 18μηνο πριν την υποβολή της αίτησης ενίσχυσης: <b><?php echo htmlspecialchars($_SESSION['anergia'])?></b></p>

<br>
<p><b>Ο τόπος μόνιμης κατοικίας σας βρίσκεται:</b></p>
<p><?php echo $perifereia[0]?></p>
<p><?php echo $per_enotita[0]?></p>
<p><?php echo $dimos[0]?></p>
<p><?php echo $dimot_enotita[0]?></p>
<p><?php echo $toppiki_koinotita[0]?></p>
<p><?php echo $oikismos[0]?></p>

<br>
<p><b>Οι δραστηριότητες της εκμετάλλευσής σας <u>(χαρ/κα ΕΙΣΟΔΟΥ)</u> είναι οι εξής:</b></p>
<table border=0>
<?php include('titles_drastiriotites.php'); ?>

<?php	
	foreach($_SESSION['drastiriotites'] as $drastiriotita){
		include('table_drast.php');
		echo "</tr>";
	}		
?>

</table>

<br>
<p><b>Οι δραστηριότητες της εκμετάλλευσής σας (και το ποσοστό ιδιοκτησίας για κάθε μονάδα) σύμφωνα με το <u>ΕΠΙΧΕΙΡΗΜΑΤΙΚΟ ΣΧΕΔΙΟ</u> (ΜΕΛΛΟΝΤΙΚΗ ΚΑΤΑΣΤΑΣΗ) είναι οι εξής:</b></p>
<table border=0>
<?php include('titles_drastiriotites.php'); ?>

<?php	
	foreach($_SESSION['epixeirimatiko'] as $drastiriotita){
		include('table_drast.php');
		echo "</tr>";
	}		
?>

</table>

</td></tr></table>

<br><br>
<p><b>Αν τα στοιχεία είναι σωστά πατήστε "<u>Υποβολή</u>", αλλιώς γυρίστε σε προηγούμενες σελίδες για να κάνετε διορθώσεις</b></p>
<button type="button" onclick="location.href='page_4.php';"><< Προηγούμενο</button>
<button type="button" style="width: 150px; height: 100px;" onclick="location.href='proccess.php';"><h2>Υποβολή</h2></button>


</body>
</html>


<!-- 3η ΣΕΛΙΔΑ: ΔΡΑΣΤΗΡΙΟΤΗΤΕΣ ΠΑΡΟΥΣΑΣ ΚΑΤΑΣΤΑΣΗΣ -->

<?php session_start(); 

//--------------------------------------------------------------------------------

if ($_POST){
	$osde_category = $_POST['osde_category'];
	$_SESSION['subt_p3'] = TRUE;
}

if ( !$osde_category and $_SESSION['page']== 3 and !empty($_SESSION['drastiriotites']) )
	{

		echo '<script language="JavaScript">
		self.location="page_4.php";
		</script>';
	}

//--------------------------------------------------------------------------------

include ('connect_db.php');

$_SESSION['pinakas'] = 'drastiriotites'; 
$_SESSION['page']= 3;

include ('sima.php');

?>


<html>
<body>
<form method=post action='page_3.php'>
<table border=1>
<!-------------------------------------------------------------------------------->
<tr>
<td width=300 <?php if (isset($_SESSION['subt_p3']) and isset($_SESSION['subt_rec']) and empty($_SESSION['drastiriotites'])) echo "bgcolor='yellow'"?>><font color='red'><b><?php if (isset($_SESSION['subt_p3']) and isset($_SESSION['subt_rec']) and empty($_SESSION['drastiriotites'])) echo "ΔΕΝ ΕΧΕΤΕ ΣΥΜΠΛΗΡΩΣΕΙ ΚΑΜΙΑ ΔΡΑΣΤΗΡΙΟΤΗΤΑ"?></b></font></td>
<td width=300></td>
<td width=50></td>
<td width=50></td>
<td width=50></td>
<td width=50></td>
<td width=100></td>
</tr>
<tr>
<td colspan=7>
	<p><b>Συμπληρώστε τις δραστηριότητες της εκμετάλλευσής <font color='red'><u>(χαρ/κά ΕΙΣΟΔΟΥ)</u></font> σας και το ποσοστό ιδιοκτησίας για κάθε μονάδα</b></p>
</td>
</tr>
<!------------------ Τίτλοι Πίνακα-------------------------------------------------->

<?php include('titles_drastiriotites.php'); ?>

<!---------------- Καταχωρημένες Δραστηριότητες----------------------------------->

<?php
	foreach($_SESSION['drastiriotites'] as $drastiriotita){
		include('table_drastiriotites.php');
	}
?>

<!----------------- Φόρμα Συμπλήρωσης Νέων Δραστηριοτήτων -------------------------->

<?php include('form_drastiriotites.php'); ?>

<!-------------------------------------------------------------------------------->
<tr>
<td colspan=6 align=center><button type="button" onclick="location.href='page_2.php';"><< Προηγούμενο</button><input type=submit value="Επόμενο >>" formAction='page_3.php'></td>
</tr>
</table>
</form>
<p><b><sup>*</sup>Για Μελισσοκομία: Αριθμός Κυψελών  |  Για Σηροτροφία: Αριθμός Κουτιών</b></p>
<p><b><sup>**</sup>Το ζωικό και μελισσοκομικό κεφάλαιο πρέπει να είναι ιδιόκτητο</b></p>
<p><b><sup>***</sup>Νέες φυτείες (πχ νεαρά δένδρα, αμπελώνες), για τις μόνιμες καλλιέργειες, είναι αυτές που δεν έχουν μπει σε παραγωγή</b></p>
</body>
</html>


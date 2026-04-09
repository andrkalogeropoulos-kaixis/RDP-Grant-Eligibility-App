<!-- 1η ΣΕΛΙΔΑ: ΕΚΠΑΙΔΕΥΣΗ, ΟΜΑΔΕΣ, ΕΙΣΟΔΗΜΑ, ΑΝΕΡΓΙΑ -->

<?php 

session_start();

if (!$_POST){// If coming from a previous session or page

	$titlos = $_SESSION['titlos'];
	$omades = $_SESSION['omades'];
	$atomiko = $_SESSION['atomiko'];
	$syzygou = $_SESSION['syzygou'];
	$anergia = $_SESSION['anergia'];

}

elseif ($_POST){// If data is submitted via POST

	$titlos = $_POST['titlos'];
	$omades = $_POST['omades'];	
	$atomiko = $_POST['atomiko']; if (!$atomiko) {$atomiko=0;}
	$syzygou = $_POST['syzygou']; if (!$syzygou) {$syzygou=0;}
	$anergia = $_POST['anergia']; if (!$anergia) {$anergia=0;}

}

//--------------------------------------------------------------------------

if ( $titlos or $omades or $atomiko or $syzygou or $anergia ){
	$_SESSION["subt_p1"] = TRUE; 
}

//--------------------------------------------------------------------------
 
if ( $_POST and $titlos and $omades and (!$atomiko || ctype_digit($atomiko)) and (!$syzygou || ctype_digit($syzygou)) and (!$anergia || ctype_digit($anergia)) ){
	$_SESSION['compl_1']=TRUE;

	$_SESSION['titlos'] = $titlos;
	$_SESSION['omades'] = $omades;
	$_SESSION['atomiko'] = $atomiko;
	$_SESSION['syzygou'] = $syzygou;
	$_SESSION['anergia'] = $anergia;

	echo '<script language="JavaScript">
		self.location="page_2.php";
		</script>';
}

//--------------------------------------------------------------------------

include ('sima.php');

?>

<html>
<body>
<form action="page_1.php" method=post>
<table border=1>
<!----------------- (Έλεγχος πληρότητας) ----------------------------------------->
<tr>
<td width=450 <?php if (isset($_SESSION['subt_p1']) and !$_SESSION['compl_1']) echo "bgcolor='yellow'"?>><font color='red'><b><?php if (isset($_SESSION['subt_p1']) and !$_SESSION['compl_1']) echo "ΔΕΝ ΕΧΕΤΕ ΣΥΜΠΛΗΡΩΣΕΙ ΟΛΑ ΤΑ ΣΤΟΙΧΕΙΑ"?></b></font></td>
<td width=150></td>
</tr>
<!----------------- Τίτλος Σπουδών ----------------------------------------------->
<tr>
<td>	<p><b>Κατέχετε Πτυχίο - Τίτλο Σπουδών Γεωτεχνικής Κατεύθυνσης ανώτερο ή ίσο με επίπεδο 5 του Εθνικού Πλαισίου Προσόντων;</b></p>
	<p><a href="Τίτλοι Σπουδών.pdf" target="_blank">Σε αυτό το σύνδεσμο</a> μπορείτε να δείτε τους τίτλους σπουδών που πληρούν τις προϋποθέσεις</p>
</td>
<td <?php if (isset($_SESSION['subt_p1']) and !$titlos) echo "bgcolor='yellow'" ?>>
	<input type="radio" name="titlos" value='y' <?php if ($titlos=='y') echo 'checked="checked"'; ?>> Ναι<br>
	<input type="radio" name="titlos" value='n' <?php if ($titlos=='n') echo 'checked="checked"'; ?>> Όχι
</td>
</tr>
<!----------------- Ομάδες Παραγωγών --------------------------------------------->
<tr>
<td>
	<p><b>Συμμετέχετε σε Ομάδες ή Οργανώσεις Παραγωγών;</b></p>
	<p>(Δεν αφορά τη συμμετοχή σε άλλα συλλογικά όργανα πχ. σε Συνεταιρισμούς)</p>
</td>
<td <?php if (isset($_SESSION['subt_p1']) and !$omades) echo "bgcolor='yellow'" ?>>	
	<input type="radio" name="omades" value='y' <?php if ($omades=='y') echo 'checked="checked"'; ?>> Ναι<br>
	<input type="radio" name="omades" value='n' <?php if ($omades=='n') echo 'checked="checked"'; ?>> Όχι
</td>
</tr>
<!----------------- Εισόδημα ---------------------------------------------------->
<tr>
<td>
	<p><b>Ποιό είναι το ετήσιο εισόδημα που δηλώσατε στο Ε1 της τελευταίας χρονιάς;</b></p>
</td>
<td <?php if ( ($atomiko && !ctype_digit($atomiko)) or ($syzygou && !ctype_digit($syzygou)) ) {echo "bgcolor='red'";}?>>
	<br>
	<p>Το δικό σας</p>
	<input type="text" name="atomiko" value="<?php echo htmlspecialchars($atomiko); ?>" size=8> <b>€</b> <br>
	<p>Του/Της Συζύγου</p>
	<input type="text" name="syzygou" value="<?php echo htmlspecialchars($syzygou); ?>" size=8> <b>€</b> <br>
	</td>
</tr>
<!----------------- Ανεργία ---------------------------------------------------->
<tr>
<td>
	<p><b>Κατά το τελευταίο 18μηνο πριν την υποβολή της αίτησης ενίσχυσης, πόσους μήνες ανεργίας είχατε συμπληρώσει;</b></p>
	<p>- Πρέπει να έχετε θεωρημένη κάρτα ανεργίας γι αυτούς τους μήνες</p>
	<p>- Δεν απαιτείται να είναι συνεχόμενοι</p>
</td>
<td align=center <?php if ($anergia && !ctype_digit($anergia)) echo "bgcolor='red'";?>>
	<br>
	<input type="text" name="anergia" value="<?php echo htmlspecialchars($anergia); ?>" size=3>
	
</td>
</tr>
<!----------------- Υποβολή --------------------------------------------------->
<tr>
<td colspan=2 align=center><input type=submit value="Επόμενο >>"></td>
</tr>
</table>
</form>
</body>
</html>


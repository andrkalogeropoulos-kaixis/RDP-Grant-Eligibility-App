<!-- 2η ΣΕΛΙΔΑ: ΤΟΠΟΣ ΜΟΝΙΜΗΣ ΚΑΤΟΙΚΙΑΣ -->

<?php

session_start();

if (!$_POST){       // Coming from another page

	$perifereia = $_SESSION['perifereia'];
	$per_enotita = $_SESSION['per_enotita'];
	$dimos = $_SESSION['dimos'];
	$dimot_enotita = $_SESSION['dimot_enotita'];
	$topiki_koinotita = $_SESSION['topiki_koinotita'];

	$oreini_nisi = $_SESSION['oreini_nisi'];

}

elseif ($_POST){	// Data submitted from this page
	
	$perifereia = $_POST['perifereia'];
	$per_enotita = $_POST['per_enotita'];
	$dimos = $_POST['dimos'];
	$dimot_enotita = $_POST['dimot_enotita'];
	$topiki_koinotita = $_POST['topiki_koinotita'];

	$oreini_nisi = $_POST['oreini_nisi'];
}



if ($topiki_koinotita) 
{
$_SESSION["subt_p2"] = TRUE;
}


if ($_POST and $topiki_koinotita and $oreini_nisi)
	{

	$_SESSION['compl_2'] = TRUE;
		
	$_SESSION['perifereia'] = $perifereia;
	$_SESSION['per_enotita'] = $per_enotita;
	$_SESSION['dimos'] = $dimos;
	$_SESSION['dimot_enotita'] = $dimot_enotita;
	$_SESSION['topiki_koinotita'] = $topiki_koinotita;

	$_SESSION['oreini_nisi'] = $oreini_nisi;


	echo '	<script language="JavaScript">
			self.location="page_3.php";
		</script>';
	}

	
//--------------------------------------------------------------------------

$_SESSION['page']= 2;

//--------------------------------------------------------------------------

if (!$perifereia) {$perifereia = 10;}

//--------------------------------------------------------------------------

include ('connect_db.php');

//--------------------------------------------------------------------------

$perifereies = mysqli_query($link, "SELECT id, descr FROM perifereies");
$per_enotites = mysqli_query($link, "SELECT code, descr FROM per_enotites WHERE perifereia =".$perifereia);
$dimoi = mysqli_query($link, "SELECT code, descr FROM dimoi WHERE per_enotita =".$per_enotita);
$dimot_enotites = mysqli_query($link, "SELECT code, descr FROM dimot_enotites WHERE dimos =".$dimos);
$topikes_koinotites = mysqli_query($link, "SELECT code, descr FROM topikes_koinotites WHERE dimot_enotita =".$dimot_enotita);


include ('sima.php');

?>


<html>

<body>
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/fun_katoikia.js"></script>

<form action="page_2.php" method=post>
<table border=1>
<!----------------- (Έλεγχος πληρότητας) ----------------------------------------->
<tr>
<td width=450 <?php if (isset($_SESSION['subt_p2']) and !$_SESSION['compl_2']) echo "bgcolor='yellow'"?>><font color='red'><b><?php if (isset($_SESSION['subt_p2']) and !$_SESSION['compl_2']) echo "ΔΕΝ ΕΧΕΤΕ ΣΥΜΠΛΗΡΩΣΕΙ ΟΛΑ ΤΑ ΣΤΟΙΧΕΙΑ"?></b></font></td>
<td width=150></td>
</tr>

<!-------------------------------------------------------------------------------->
<tr>
<td>
	<p><b>Που βρίσκεται ο τόπος μόνιμης κατοικίας σας;</b></p>
	<p>Μπορείτε να επιλέξετε <u>μόνο περιοχές εφαρμογής του Προγράμματος</u>. Στις υπόλοιπες η επιλογή είναι απενεργοποιημένη</p>
</td>
<td <?php if (isset($_SESSION['subt_p2']) and !$topiki_koinotita) echo "bgcolor='yellow'" ?> align=left>
	<br>
	<div name='_div_perifereia' id="div_perifereia_id">
	<select name='perifereia' id="perifereia_id">
	<option selected disabled>ΠΕΡΙΦΕΡΕΙΑ</option>
        <?php
	while($rs=mysqli_fetch_array($perifereies)){
      	echo '<option'.($rs['id']==$perifereia ? ' selected="selected"':'disabled').' value="'.$rs['id'].'">'.$rs['descr'].'</option>';
  	}
	?>
	</select>
	<noscript><input type="submit" value="Submit"></noscript>
	</div>	

	<br>
	<div name='div_per_enotita' id="div_per_enotita_id">	
	<select name='per_enotita' id="per_enotita_id" onchange="live_searching_katoikia()">
	<option selected disabled>ΠΕΡΙΦΕΡΕΙΑΚΗ ΕΝΟΤΗΤΑ</option>
        <?php  
	while($rs=mysqli_fetch_array($per_enotites))
	{
      	echo '<option'.($rs['code']==$per_enotita ? ' selected="selected"':'').(in_array($rs['code'], array(1045, 1046, 1047, 1048, 1051)) ? ' disabled':'').' value="'.$rs['code'].'">'.$rs['descr'].'</option>';
  	}	
	?>
        </select>
	<noscript><input type="submit" value="Submit"></noscript>
	</div>

	<div name='div_katoikia' id="div_katoikia_id">	

	<br>	
	<select id="dimos_id" name='dimos'>
	<option value=0>ΔΗΜΟΣ</option>
	<?php
	while($rs=mysqli_fetch_array($dimoi)){
      	echo '<option'.($rs['code']==$dimos ? ' selected="selected"':'').(in_array($rs['code'], array(104901, 105005)) ? ' disabled':'').' value="'.$rs['code'].'">'.$rs['descr'].'</option>';
  	}	
	?>
        </select>
	<noscript><input type="submit" value="Submit"></noscript>
	

	<br><br>
	<select name='dimot_enotita' id="dimot_enotita_id">
	<option value=0>ΔΗΜΟΤΙΚΗ ΕΝΟΤΗΤΑ</option>
	<?php  
	while($rs=mysqli_fetch_array($dimot_enotites)){
      	echo '<option'.($rs['code']==$dimot_enotita ? ' selected="selected"':'').(in_array($rs['code'], array(10491104, 10491105, 10490301, 10490303, 10490304, 10490306, 10490307, 10491306, 10490201, 10490203, 10490604, 10490502, 10490501, 10490802, 10500302, 10500301)) ? ' disabled':'').' value="'.$rs['code'].'">'.$rs['descr'].'</option>';
  	}	
	?>

        </select>
	<noscript><input type="submit" value="Submit"></noscript>
	

	<br><br>
	<select name='topiki_koinotita' id="topiki_koinotita_id">
	<option value=0>ΤΟΠΙΚΗ ΚΟΙΝΟΤΗΤΑ</option>
	<?php  
	while($rs=mysqli_fetch_array($topikes_koinotites)){
      	echo '<option'.($rs['code']==$topiki_koinotita ? ' selected="selected"':'').' value="'.$rs['code'].'">'.$rs['descr'].'</option>';
  	}	
	?>
        </select>
	<noscript><input type="submit" value="Submit"></noscript>
	
	</div>

	
</td>
</tr>
<!-------------------------------------------------------------------------------->
<tr>
<td>
	<p><b>Η εν λόγω περιοχή θεωρείται Ορεινή ή Νησιωτική;</b></p>
	<p>- Οι θεωρούμενες ως <b>ορεινές</b> περιοχές αναφέρονται στην <a href="odhgia85148.pdf" target="_blank">Οδηγία 85/148/ΕΟΚ</a> </p>
	<p>- Οι <b>νησιωτικές περιοχές</b> που μοριοδοτούνται είναι αυτές που βρίσκονται σε <u>Νησιά με πληθυσμό έως και 3000 κατοίκους</u> ή σε <u>Νησιά που ανήκουν σε μη νησιωτικές Περιφέρειες</u>.<br>
<a href="monimos.xlsx">Σε αυτό το σύνδεσμο</a> βρίσκεται ο πίνακας με το μόνιμο πληθυσμό όλων των οικισμών της Ελλάδας</p>
</td>
<td <?php if (isset($_SESSION['subt_p2']) and !$oreini_nisi) echo "bgcolor='yellow'" ?>>
	
	<input type="radio" name="oreini_nisi" value='y' <?php if ($oreini_nisi=='y') echo 'checked="checked"'; ?>> Ναι<br>
	<input type="radio" name="oreini_nisi" value='n' <?php if ($oreini_nisi=='n') echo 'checked="checked"'; ?>> Όχι
</td>
</tr>
<!-------------------------------------------------------------------------------->
<tr>
<td colspan=2 align=center><button type="button" onclick="location.href='page_1.php';"><< Προηγούμενο</button><input type=submit value="Επόμενο >>"></td>
</tr>
</table>
</form>
</body>
</html>


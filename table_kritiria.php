<!-- ΕΜΦΑΝΙΣΗ ΠΙΝΑΚΑ ΚΡΙΤΗΡΙΩΝ ΜΕ ΤΗ ΒΑΘΜΟΛΟΓΙΑ ΠΟΥ ΣΥΓΚΕΝΤΡΩΝΕΙ Ο ΧΡΗΣΤΗΣ ΓΙΑ ΚΑΘΕΝΑ -->

<?php session_start();

if ($sum_moria < 45)
	echo "
<table border = 1><tr><td>
<p>Η βαθμολογία που συγκεντρώνετε είναι <b>".round($sum_moria, 1)." βαθμοί</b>.</p>
<p>Η βαθμολογία που επιτυγχάνεται δεν πέφτει σε καμμία περίπτωση κάτω των <b>45 βαθμών</b></p>
<h1><font color='red'><b>Δυστυχώς δεν πληρείτε τα κριτήρια επιλεξιμότητας!</b></font></h1>
</td></tr></table>
<br>
";

?>

<table border =1>
<tr>
	<td><b>α/α</b></td>
	<td><b>ΚΡΙΤΗΡΙΟ</b></td>
	<td><b>ΑΝΑΛΥΣΗ ΤΙΜΩΝ - ΚΑΤΑΣΤΑΣΗΣ ΚΡΙΤΗΡΙΟΥ</b></td>
	<td><b>ΒΑΘΜΟΙ</b></td>
</tr>

<?php
while ($kritiria = mysqli_fetch_array($sql) ) {
echo "
<tr>
	<td>".$kritiria['a_a']."</td>
	<td>".$kritiria['kritirio']."</td>
	<td>".$kritiria['analysi']."</td>
	<td>".round($t_moria[$kritiria['a_a']], 1)."</td>
</tr>
";
}
?>

<tr body style="background-color:Black ;">
	<td colspan=4></td>
</tr>
<tr>
	<td colspan=3 <?php echo ($sum_moria<45 ? 'bgcolor="red"':'')?>><h2>ΣΥΝΟΛΙΚΗ ΒΑΘΜΟΛΟΓΙΑ</h2></td>
	<td <?php echo ($sum_moria<45 ? 'bgcolor="red"':'')?>><h1><b><?php echo round($sum_moria, 1)?></b></h1></td>
</tr>
</table>


<?php echo (!in_array($osde_category, array('f_15', 'f_19', 'f_21', 'f_29', 'f_37', 'f_49', 'f_66', 'f_67', 'f_20.2', 'f_28.1', 'f_36.2', 'f_36.3', 'f_45.2')) ? 'style = "visibility: hidden"' : '') ?>
<!-- ΦΟΡΜΑ ΕΙΣΑΓΩΓΗΣ ΔΡΑΣΤΗΡΙΟΤΗΤΩΝ -->

<?php session_start(); 


$osde_categories = mysqli_query($link, "SELECT gen_cod_osde, osde_category FROM osde_categories");

$kalliergeies = mysqli_query($link, "SELECT id, osde_code, kallierg_descr FROM kalliergeies2 WHERE gen_code_osde ='".$osde_category."'");


?>
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/fun_drastiriotites.js"></script>

<tr body style="background-color:Black ;"><td colspan=7 color = 'black'></td></tr>
<tr>
<!------------- Κατηγορία ΟΣΔΕ --------------------------------------------------->
<td>	
	<select name='osde_category' id='osde_category_id' style="width:100%;" onchange="live_searching_kalliergeies()">
	<option selected disabled>(επιλέξτε)</option>
        <?php
	while($rs=mysqli_fetch_array($osde_categories)){
      	echo '<option'.( ($rs['gen_cod_osde']==$osde_category) ? ' selected="selected"':'').' value="'.$rs['gen_cod_osde'].'">'.$rs['gen_cod_osde'].' '.$rs['osde_category'].'</option>';
  	}
	?>
	</select>
	<noscript><input type="submit" value="Submit"></noscript>
</td>
<!--------------- Καλλιέργεια ---------------------------------------------------->
<td>
	<div name='div_kalliergeia' id='div_kalliergeia_id'>	
	<select name='kalliergeia' id='kalliergeia_id' style="width:100%;">
	<option value=0>(καλλιέργειες)</option>
        <?php
	while($rs=mysqli_fetch_array($kalliergeies)){
      	echo '<option '.($rs['id']==$kalliergeia ? ' selected="selected"':'').' value="'.$rs['id'].'">'.$rs['osde_code'].' '.$rs['kallierg_descr'].'</option>';
  	}
	?>
	</select>
	<noscript><input type="submit" value="Submit"></noscript>
	<div name="div_nea_fyteia id=" id="div_nea_fyteia_id" <?php echo (!in_array($osde_category, array('f_15', 'f_19', 'f_21', 'f_29', 'f_37', 'f_49', 'f_66', 'f_67', 'f_20.2', 'f_28.1', 'f_36.2', 'f_36.3', 'f_45.2')) ? 'style = "visibility: hidden"' : '') ?>><font color="blue"><b>Νέα Φυτεία;<sup>***</sup></b></font> <input type="checkbox" name="nea_fyteia" id="nea_fyteia_id" value=1></div>
	</div>
</td>
<!------------------- Έκταση ή αριθμός ζώων -------------------------------------->
<td align=center <?php if (isset($_SESSION['subt_rec']) and !$ektasi_zwa) {echo "bgcolor='yellow'";} elseif ($ektasi_zwa && !ctype_digit($ektasi_zwa)) {echo "bgcolor='red'";} ?>>
	<input type="text" name="ektasi_zwa" id="ektasi_zwa_id" value="<?php echo htmlspecialchars($ektasi_zwa); ?>" size=3>	
</td>
<!------------------- Ποσοστό ιδιοκτησίας ---------------------------------------->
<td align=center <?php if ($idioktisia>100 or ($idioktisia && !ctype_digit($idioktisia))) echo "bgcolor='red'" ?>>
	<input type="text" name="idioktisia" id="idioktisia_id" value="<?php echo htmlspecialchars($idioktisia); ?>"  size=3> %</input>
</td>
<!-------------------- Βιολογική ή ολοκληρωμένη ---------------------------------->
<td align=center>
	<input type="checkbox" name="biologiki" id="biologiki_id" value=1><br>
</td>



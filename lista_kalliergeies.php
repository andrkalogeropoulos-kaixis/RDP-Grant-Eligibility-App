<?php 

include ('connect_db.php');

$osde_category = $_POST['osde_category_input'];

$kalliergeies = mysqli_query($link, "SELECT id, osde_code, kallierg_descr FROM kalliergeies2 WHERE gen_code_osde ='".$osde_category."'");

?>
	
	<select name='kalliergeia' id='kalliergeia_id' style="width:100%;">
	<option selected disabled>(επιλέξτε)</option>
        <?php
	while($rs=mysqli_fetch_array($kalliergeies)){
      	echo '<option '.($rs['id']==$_SESSION['kalliergeia'] ? ' selected="selected"':'').' value="'.$rs['id'].'">'.$rs['osde_code'].' '.$rs['kallierg_descr'].'</option>';
  	}
	?>
	</select>
	<noscript><input type="submit" value="Submit"></noscript>
	<div name="div_nea_fyteia" id="div_nea_fyteia_id" <?php echo (!in_array($osde_category, array('f_15', 'f_19', 'f_21', 'f_29', 'f_37', 'f_49', 'f_66', 'f_67', 'f_20.2', 'f_28.1', 'f_36.2', 'f_36.3', 'f_45.2')) ? 'style = "visibility: hidden"' : '') ?>><font color="blue"><b>Νέα Φυτεία;<sup>***</sup></b></font> <input type="checkbox" name="nea_fyteia" id="nea_fyteia_id" value=1></div>

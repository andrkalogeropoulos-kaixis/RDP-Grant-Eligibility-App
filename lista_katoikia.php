<?php 

include ('connect_db.php');

$per_enotita = $_POST['per_enotita_input'];

$dimos = $_POST['dimos_input'];
if (substr($dimos,0,4) != $per_enotita)
		{$dimos = NULL;}

$dimot_enotita = $_POST['dimot_enotita_input'];
if (substr($dimot_enotita,0,6) != $dimos)
		{$dimot_enotita = NULL;}


$dimoi = mysqli_query($link, "SELECT code, descr FROM dimoi WHERE per_enotita =".$per_enotita);
$dimot_enotites = mysqli_query($link, "SELECT code, descr FROM dimot_enotites WHERE dimos =".$dimos);
$topikes_koinotites = mysqli_query($link, "SELECT code, descr FROM topikes_koinotites WHERE dimot_enotita =".$dimot_enotita);

?>
	
	<br>
	<select name='dimos' id="dimos_id" onchange="live_searching_katoikia()">
	<option selected disabled>ΔΗΜΟΣ</option>
        <?php
	while($rs=mysqli_fetch_array($dimoi)){
      	echo '<option'.($rs['code']==$dimos ? ' selected="selected"':'').(in_array($rs['code'], array(104901, 105005)) ? ' disabled':'').' value="'.$rs['code'].'">'.$rs['descr'].'</option>';
  	}	
	?>
	</select>
	<noscript><input type="submit" value="Submit"></noscript>


	<br><br>
	<select name='dimot_enotita' id="dimot_enotita_id" onchange="live_searching_katoikia()">
	<option selected disabled>ΔΗΜΟΤΙΚΗ ΕΝΟΤΗΤΑ</option>
        <?php  
	while($rs=mysqli_fetch_array($dimot_enotites)){
      	echo '<option'.($rs['code']==$dimot_enotita ? ' selected="selected"':'').(in_array($rs['code'], array(10491104, 10491105, 10490301, 10490303, 10490304, 10490306, 10490307, 10491306, 10490201, 10490203, 10490604, 10490502, 10490501, 10490802, 10500302, 10500301)) ? ' disabled':'').' value="'.$rs['code'].'">'.$rs['descr'].'</option>';
  	}	
	?>
	</select>
	<noscript><input type="submit" value="Submit"></noscript>


	<br><br>
	<select name='topiki_koinotita' id="topiki_koinotita_id">
	<option selected disabled>ΤΟΠΙΚΗ ΚΟΙΝΟΤΗΤΑ</option>
        <?php  
	while($rs=mysqli_fetch_array($topikes_koinotites)){
      	echo '<option'.($rs['code']==$topiki_koinotita ? ' selected="selected"':'').' value="'.$rs['code'].'">'.$rs['descr'].'</option>';
  	}	
	?>
	</select>
	<noscript><input type="submit" value="Submit"></noscript>

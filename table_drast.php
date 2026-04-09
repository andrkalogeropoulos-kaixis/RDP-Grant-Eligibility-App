<!-- ΕΜΦΑΝΙΣΗ ΟΛΩΝ ΤΩΝ ΔΡΑΣΤΗΡΙΟΤΗΤΩΝ ΣΕ ΠΙΝΑΚΑ ΕΚΤΟΣ ΑΠΟ ΤΟ ΚΟΥΜΠΙ ΤΗΣ ΑΦΑΙΡΕΣΗΣ-->

<?php	
	$sql_gco = mysqli_query($link, "SELECT gen_cod_osde, osde_category FROM osde_categories WHERE gen_cod_osde = '$drastiriotita[0]'");
	$sql_kal = mysqli_query($link, "SELECT osde_code, kallierg_descr FROM kalliergeies2 WHERE id = '$drastiriotita[1]'");
	$rs_gco = mysqli_fetch_array($sql_gco);
	$rs_kal = mysqli_fetch_array($sql_kal);

	echo "<tr>
		<td>".$rs_gco['gen_cod_osde']." ".$rs_gco['osde_category']."</td>
		<td>".$rs_kal['osde_code']." ".$rs_kal['kallierg_descr'].($drastiriotita[6]=='true' ? "<i> (ΝΦ)</i>" : "")."</td>
		<td align=center>".$drastiriotita[2]."</td>
		<td align=center>".$drastiriotita[3]." %</td>
		<td align=center>".(($drastiriotita[4]=='true')? "√":"")."</td>
		<td align=center>".$drastiriotita[5].((is_numeric($drastiriotita[5]))? " €":"")."</td>";

?>


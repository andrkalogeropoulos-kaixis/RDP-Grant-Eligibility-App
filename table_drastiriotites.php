<!-- ΕΜΦΑΝΙΣΗ ΟΛΩΝ ΤΩΝ ΔΡΑΣΤΗΡΙΟΤΗΤΩΝ ΣΕ ΠΙΝΑΚΑ -->

<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/fun_rem_drast.js"></script>

<div name='div_table_drast' id='div_table_drast_id'>

<?php	
	include('table_drast.php');
	
	$record = array_search($drastiriotita, $_SESSION[ $_SESSION['pinakas'] ]);
	echo "<td align=center><input type='submit' id=".$record." value='Αφαίρεση' onClick='rem_drastiriotita(".$record.")'/></td></tr>"; // Αφαίρεση	
?>
</div>

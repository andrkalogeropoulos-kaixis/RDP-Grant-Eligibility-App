<!-- ΑΦΑΙΡΕΣΗ ΕΓΓΡΑΦΗΣ ΔΡΑΣΤΗΡΙΟΤΗΤΑΣ -->

<?php

session_start();

$record = $_POST['rec_input'];

unset($_SESSION[ $_SESSION['pinakas'] ][ $record ]);
$_SESSION[ $_SESSION['pinakas'] ]  = array_values($_SESSION[ $_SESSION['pinakas'] ]);

include('table_drastiriotites.php');

?>

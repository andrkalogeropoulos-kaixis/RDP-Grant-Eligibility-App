<!-- ΤΕΛΟΣ ΣΥΝΕΔΡΙΑΣ ΚΑΙ ΕΞΟΔΟΣ ΑΠΟ ΤΗΝ ΕΦΑΡΜΟΓΗ -->

<?php
// Initialize the session.
session_start();

// Unset all of the session variables.
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.
session_destroy();

include ('sima.php');

?>
<html>
<body>
<br><br>
<p><b><u><i>ΤΕΛΟΣ ΥΠΟΛΟΓΙΣΜΟΥ</u></i></b></p><br>		

<br><br>
<button type="button" style="width: 200px; height: 80px;" onclick="location.href='page_1.php';"><h2>Έναρξη νέου υπολογισμού</h2></button>


</body>
</html>


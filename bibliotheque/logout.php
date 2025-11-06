<?php
// Config pour se déconnecter
session_start();

if (isset($_SESSION['utilisateur_id'])) { 
    $_SESSION = array();                 
    session_destroy();
}
header("Location : login.php");
exit;
?>
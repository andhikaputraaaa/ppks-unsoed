<?php
if (!isset($_SESSION)) {
    session_start(); 
}

function isSatgas() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'satgas';
}

if (!isSatgas()) {
    header("Location: admin.php"); 
    exit();
}
?>

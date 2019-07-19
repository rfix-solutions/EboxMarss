<?php
unset ($SESSION['username']);
session_destroy();
header('Location: ../../login/');
?>

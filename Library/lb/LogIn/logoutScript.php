<?php
// Unset or clear the cookies
setcookie('userId', '', time() - 3600, '/');
setcookie('userEmail', '', time() - 3600, '/');
setcookie('firstName', '', time() - 3600, '/');
setcookie('lastName', '', time() - 3600, '/');
setcookie('role', '', time() - 3600, '/');
// Redirect to the login page or any other desired page
header("Location: /projet.php");
exit();

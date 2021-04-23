<?php
session_start();
session_destroy();
header('Location: /EZCUT/index.php');
exit;
 ?>

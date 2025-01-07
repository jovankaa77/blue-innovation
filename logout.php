<?php
session_start();
session_unset();
session_destroy();
header("Location: /web_kuliah_test/index.php");
exit();
?>
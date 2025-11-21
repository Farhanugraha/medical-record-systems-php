<?php
require_once "../_config/config.php";
session_destroy();
session_unset();
header("Location: ".base_url('auth/login.php'));
exit;
?>
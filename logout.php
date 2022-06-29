<?php
require_once __DIR__ . "/vendor/autoload.php";

setcookie('X-IQBAL-SESSION', 'LOGOUT');
header('Location: login.php');

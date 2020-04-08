<?php
// refers to a file with delicate information
include "secret.php";

/* Maak de database connectie */
$connectStr = 'mysql: host=' . $host . ';dbname=' . $dbname . ';charset=utf8';

$db = new PDO($connectStr, $username, $password);

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
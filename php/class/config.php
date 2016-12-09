<?php

session_start();

$DB_host = "localhost"; // "ninibocom.globatmysql.com"
$DB_user = "root";
$DB_pass = "";
$DB_name = "thebridge";

try
{
     $DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
     $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
     echo $e->getMessage();
}
include_once 'User.php';
$user = new USER($DB_con);
?>

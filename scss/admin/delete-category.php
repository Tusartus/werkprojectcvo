<?php
session_start();
require_once('../includes/connect.php');
include('inc/check-login.php');

$DelSql = "DELETE FROM categories WHERE id=?";
$result = $db->prepare($DelSql);
$res = $result->execute(array($_GET['id']));


if($res){

header("location: view-categories.php");

}else{

echo "Failed to Delete Record";
header("location: view-categories.php");

}

?>




?>
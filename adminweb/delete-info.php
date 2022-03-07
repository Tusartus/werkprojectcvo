<?php

session_start();

include ('../includes/connect.php');



//protect index page only for login as admin role in users databank
require_once( "config/if-loggin.php");


//include classes
include_once "includes/config.inc.php";

if(isset($_GET['id'])){
     $info= Infogegeven::findById($_GET['id']);
     $info->delete();
}

header('location: index.php');
exit;
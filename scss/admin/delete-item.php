
<?php
session_start();
include('inc/check-login.php');
require_once('../includes/connect.php');
if(isset($_GET['id']))
{
 // select image from db to delete
 $stmt_select = $db->prepare('SELECT pic FROM  posts WHERE id =:id');
 $stmt_select->execute(array(':id'=>$_GET['id']));
 $imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
 unlink("user_images/".$imgRow['userPic']);

}

switch ($_GET['item']) {
    case 'category':
        $table = 'categories';
        $redirect = 'view-categories.php';
        break;
      /*
    case 'article':
        $table = 'posts';
        $redirect = 'view-articles.php';
        break;
    */
    
    case 'user':
        $table = 'users';
        $redirect = 'view-users.php';
        break;
    case 'widget':
        $table = 'widget';
        $redirect = 'view-widgets.php';
        break;
    default:
        $redirect = 'dashboard.php';
        break;
}



   
    
    $DelSql = "DELETE FROM $table WHERE id=?";
    $result = $db->prepare($DelSql);
    $res = $result->execute(array($_GET['id']));
    
    
    if($res){
    
    header("location:  $redirect");
    
    }else{
    
    echo "Failed to Delete Record";
    header("location: $redirect");
    
    }

    







?>




<?php

/*

if(isset($_GET['delete_id'])  && !empty($_GET['delete-id']))
{

  $id = $_GET['delete-id'];

 // select image from db to delete
 $stmt_select = $db->prepare('SELECT pic FROM posts WHERE id =:id');
 $stmt_select->execute(array(':id'=>$_GET['delete_id']));
 $imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
 unlink("../media-posts/".$imgRow['pic']);
 
 // it will delete an actual record from db
 $stmt_delete = $db->prepare('DELETE FROM posts WHERE id =:id');
 $stmt_delete->bindParam(':id',$_GET['delete_id']);
 $stmt_delete->execute();
 
 header("Location: view-articles.php");
}

*/



?>




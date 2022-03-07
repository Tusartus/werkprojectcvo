<?php
session_start();
require_once('../includes/connect.php');
include('inc/check-login.php');

if(isset($_GET['id']) && !empty($_GET['id']))
{

    
 $id = $_GET['id'];

// delete post_categories on pid cid

 foreach ($_POST['categories'] as $category) {
    $catsql = "DELETE FROM post_categories WHERE pid=:pid AND cid=:cid";
    $catresult = $db->prepare($catsql);
    $values = array(':pid'      => $pid,
                    ':cid'      => $category
       );
    $catresult->execute($values);

    }
  // select image from db to delete
 $stmt_del = $db->prepare('SELECT title, content, slug, pic FROM posts WHERE id = :id');
 $stmt_del->execute(array(':id'=>$id));
 $delete_row = $stmt_del->fetch(PDO::FETCH_ASSOC);
 extract($delete_row);

 unlink("../media-posts/".$delete_row['pic']);

 
 // it will delete an actual record from db
 $stmt_delete = $db->prepare('DELETE FROM posts WHERE id=:id');
 $stmt_delete->bindParam(':id',$_GET['id']);
 $stmt_delete->execute();
 
 header("Location: view-articles.php");
}






?>
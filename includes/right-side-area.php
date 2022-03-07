<?php

require_once('./includes/connect.php');

  $catsql = "SELECT * FROM categories";
  $catresult = $db->prepare($catsql);
  $catresult->execute();
  $catres = $catresult->fetchAll(PDO::FETCH_ASSOC);

  
  
?>
  <div class="single_widget cat_widget">


      <h4 class="text-uppercase pb-20">post categories</h4>
      <ul>
          <li>
              <a href="#">Technology no db <span></span></a>
          </li>

            <?php foreach ($catres as $cat) { ?>
            <li>
              <a href="category?id=<?php echo $cat['id']; ?>/<?php echo $cat['slug']; ?>"><?php echo $cat['title']; ?></a>
            </li>
            <?php }  ?>
         
         
     
      </ul>
  </div>

  <div class="single_widget recent_widget">
      <h4 class="text-uppercase pb-20">Recent Posts</h4>
      <div class="active-recent-carusel">

      <?php					   
// fetch the results
$sql = "SELECT * FROM posts ORDER BY created DESC LIMIT 4";
$result = $db->prepare($sql);
$result->execute();
$posts = $result->fetchAll(PDO::FETCH_ASSOC);
 foreach ($posts as $post) {
?>

          <div class="item">
              <img src="./media-posts/<?php echo $post['pic']; ?>" alt="" width="230" height="120">
              <p class="mt-20 title text-uppercase"> 
              <?php echo $post['title']; ?> </p>
              <p> <?php echo date("d-m-Y", strtotime($post['created'])); ?> 
              <p><span class=""> <a class="btn btn-info" href="single-view?id=<?php echo $post['id']; ?>-<?php echo $post['slug']; ?>">read more</a></span> </p>
              </p>
          </div>
<?php } ?>	
      

      

      </div>
  </div>


  <div class="single_widget cat_widget">
    
 
  </div>

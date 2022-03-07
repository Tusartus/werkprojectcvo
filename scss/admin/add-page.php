<?php include ('inc/header.php'); ?>
<?php include ('inc/navbar.php'); ?>




    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
       
      
        </div>
      </div>

   <div class="col-sm-6">
   <h2>Add page</h2>
      
      <fiedset class="cllaa p-2">
      <form action="/action_page.php">
  <div class="form-group">
    <label for="name">category name:</label>
    <input type="text" class="form-control" placeholder="Enter category" id="nme">
  </div>

 
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
      </fiedset>

   </div>


   
    </main>

    <?php include ('inc/footer.php'); ?>
<?php

  // Step 1: Connect to the database to PHP
  $database = connectToDB();

  // Step 2: Load the data from the database
  // Step 2.1: -prepare the recipe (SQL command)
  $sql = "SELECT * FROM posts WHERE status =  :status ORDER BY id DESC";
  // Step 2.2: -pour everything in the bowl (prepare your database)
  $query = $database->prepare($sql);
  // Step 2.3 -cook it
  $query->execute([
    'status' => 'publish'
  ]);
  // Step 2.4 - eat it (fetch all)
  $posts = $query -> fetchAll();

?>    
<?php require "parts/header.php"; ?>
    <div class="container mx-auto my-5" style="max-width: 500px;">
      <h1 class="h1 mb-4 text-center">My Blog</h1>
      <?php require "parts/success_box.php"; ?>
      <?php foreach ( $posts as $post ) : ?>     
      <div class="card mb-2">
        <div class="card-body">
          <h5 class="card-title"><?= $post["title"]; ?></h5>
          <p class="card-text"><?= $post["content"]; ?></p>
          <div class="text-end">
            <a href="/post?id=<?= $post["id"]; ?>" class="btn btn-primary btn-sm">Read More</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
      <?php if ( isset( $_SESSION["user"] ) ) : ?>
        <div class="d-flex justify-content-center align-items-center flex-column">
        <span>Welcome back, <?= $_SESSION["user"]["name"]; ?></span>
        <div class="gap-2">
        <a href="/dashboard" class="btn btn-link p-0" id="dashboard">Dashboard</a>
        <a href="/logout" class="btn btn-link p-0" id="login">Logout</a>
        </div>
      </div>
      <?php else : ?>
      <div class="mt-4 d-flex justify-content-center gap-3">
        <a href="/login" class="btn btn-link btn-sm">Login</a>
        <a href="/signup" class="btn btn-link btn-sm">Sign Up</a>
      </div>
      <?php endif; ?>
    </div>
  <?php require "parts/footer.php"; ?>

   
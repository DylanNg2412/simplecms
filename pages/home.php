<?php

  // Step 1: Connect to the database to PHP
  $database = connectToDB();

  // Step 2: Load the data from the database
  // Step 2.1: -prepare the recipe (SQL command)
  $sql = "SELECT * FROM users";
  // Step 2.2: -pour everything in the bowl (prepare your database)
  $query = $database->prepare($sql);
  // Step 2.3 -cook it
  $query->execute();
  // Step 2.4 - eat it (fetch all)
  $students = $query -> fetchAll();

?>    
<?php require "parts/header.php"; ?>
    <div class="container mx-auto my-5" style="max-width: 500px;">
      <h1 class="h1 mb-4 text-center">My Blog</h1>
      <div class="card mb-2">
        <div class="card-body">
          <h5 class="card-title">Post 4</h5>
          <p class="card-text">Here's some content about post 4</p>
          <div class="text-end">
            <a href="/post" class="btn btn-primary btn-sm">Read More</a>
          </div>
        </div>
      </div>
      <div class="card mb-2">
        <div class="card-body">
          <h5 class="card-title">Post 3</h5>
          <p class="card-text">This is for post 3</p>
          <div class="text-end">
            <a href="/post" class="btn btn-primary btn-sm">Read More</a>
          </div>
        </div>
      </div>
      <div class="card mb-2">
        <div class="card-body">
          <h5 class="card-title">Post 2</h5>
          <p class="card-text">This is about post 2</p>
          <div class="text-end">
            <a href="/post" class="btn btn-primary btn-sm">Read More</a>
          </div>
        </div>
      </div>
      <div class="card mb-2">
        <div class="card-body">
          <h5 class="card-title">Post 1</h5>
          <p class="card-text">This is a post</p>
          <div class="text-end">
            <a href="/post" class="btn btn-primary btn-sm">Read More</a>
          </div>
        </div>
      </div>
      <?php if ( isset( $_SESSION["user"] ) ) : ?>
        <div class="d-flex justify-content-center align-items-center flex-column">
        <span>Welcome back, <?= $_SESSION["user"]["name"]; ?></span>
        <a href="/logout" class="btn btn-link p-0" id="login">Logout</a>
      </div>
      <?php else : ?>
      <div class="mt-4 d-flex justify-content-center gap-3">
        <a href="/login" class="btn btn-link btn-sm">Login</a>
        <a href="/signup" class="btn btn-link btn-sm">Sign Up</a>
      </div>
      <?php endif; ?>
    </div>
  <?php require "parts/footer.php"; ?>

   
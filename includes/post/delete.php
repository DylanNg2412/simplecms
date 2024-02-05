<?php

  // make sure the user is logged in
  if ( !isUserLoggedIn() ) {
    // if is not logged in, redirect to /login page
    header("Location: /login");
    exit;
  }

  $database = connectToDB();

  // step 3: get post ID from the $_POST
  $id = $_POST["post_id"];

  // step 4: delete the student from the database using student ID
  $sql = "DELETE FROM posts where id = :id";
  $query = $database->prepare($sql);
  $query->execute([
    'id' => $id
  ]);


  // set success message
  $_SESSION["success"] = "Post has been deleted.";
  header("Location: /manage-post");
  exit;

?>
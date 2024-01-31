<?php

   $database = connectToDB();

  // step 3: get post ID from the $_POST
  $post_id = $_POST["post_id"];

  // step 4: delete the student from the database using student ID
    $sql = "DELETE FROM posts where id = :id";
    $query = $database->prepare($sql);
    $query->execute([
      'id' => $post_id
    ]);


    // set success message
    $_SESSION["success"] = "The account has been deleted successfully.";
    header("Location: /manage-post");
    exit;


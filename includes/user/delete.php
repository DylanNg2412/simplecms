<?php

   $database = connectToDB();

  // step 3: get student ID from the $_POST
  $id = $_POST["user_id"];

  // step 4: delete the student from the database using student ID
    $sql = "DELETE FROM users where id = :id";
    $query = $database->prepare($sql);
    $query->execute([
      'id' => $user_id
    ]);


    // set success message
    $_SESSION["success"] = "The account has been deleted successfully.";
    header("Location: /manage-users");
    exit;



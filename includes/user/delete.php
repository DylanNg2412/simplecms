<?php

   $database = connectToDB();

  // step 3: get student ID from the $_POST
  $id = $_POST["id"];

  // step 4: delete the student from the database using student ID
    // 4.1 - sql command (recipe)
    $sql = "DELETE FROM users where id = :id";
    // 4.2 - prepare (put everything into the bowl)
    $query = $database->prepare($sql);
    // 4.3 - execute (cook it)
    $query->execute([
        'id' => $id
    ]);


    // set success message
    $_SESSION["success"] = "The account has been deleted successfully.";
    header("Location: /manage-users");
    exit;

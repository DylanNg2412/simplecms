<?php

  // // Step 1: connect to the database
  // $database = connectToDB();


  // // step 3: get student id and updated name from $_POST

  // $name = $_POST["name"];
  // $email = $_POST["email"];
  // $role = $_POST["role"];

  // // do error checking. Check if student name is empty or not
  // if ( empty( $name ) || empty( $email ) || empty( $role )) {
  //   setError("All the fields are required." , "/manage-users-edit");
  // } else{
  //   // Step 4: update the name in database
  //       $sql = "UPDATE users SET name = :name WHERE role = :role;"
  //       $query = $database->prepare( $sql );
  //       $query->execute([
  //           'name'=> $name,
  //           'role'=> $role
  //       ]);
  //       $user = $query->fetch();

  //   // Step 5: redirect back to 
  //       // set success message
  //       $_SESSION["success"] = "The account has been edited successfully.";
  //       header("Location: /manage-users");
  //       exit;
  //     }


// Step 1: connect to the database
$database = connectToDB();

// Step 3: get user data from $_POST
$name = $_POST["name"];
$email = $_POST["email"];
$role = $_POST["role"];
$id = $_SESSION["new_id"];

// do error checking. Check if any required field is empty
if (empty($name) || empty($email) || empty($role)) {
    setError("All the fields are required.", "/manage-users-edit");
} else {  
    // step 4: make sure the email entered does not exists yet
    $sql= "SELECT * FROM users where email = :email";
    $query = $database -> prepare ($sql);
    $query -> execute([
      "email"=>$email
    ]);
    $user = $query->fetch();
} //end step 3

if (empty($user)) {
    // Step 4: update the name in the database for the specific user
    $sql = "UPDATE users SET name = :name , email = :email , role = :role WHERE id= :id";
    $query = $database->prepare($sql);
    $query->execute([
        'name' => $name,
        'email' => $email,
        'role' => $role,
        'id'=> $id
    ]);

    unset($_SESSION["new_id"]);

      // Update successful
        $_SESSION["success"] = "The account has been edited successfully.";
        header('Location:/manage-users');
        exit;
    } else {
      setError("Email already exist.", "/manage-users-edit");}


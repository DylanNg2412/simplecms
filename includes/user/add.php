<?php
    // Step 1: connect to the database
    $database = connectToDB();


    // Step 2: get all the data from the form using $_POST
    $name = $_POST["name"];
    $email = $_POST["email"];
    $role = $_POST["role"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Step 3: error checking
    // 3.1 make sure all the fields are not empty
    if ( empty( $name ) || empty( $email ) || empty( $role )|| empty( $password ) || empty( $confirm_password ) ) {
        setError( "All the fields are required.", "/manage-users-add" ); 
       } else if ( $password !== $confirm_password ) {
            // 3.2 - make sure password is match
            setError( "The password does not match", '/manage-users-add' );
       } else if ( strlen( $password ) < 8 ) {
            // 3.3 - make sure the password length is at least 8 chars
            setError( "Your password must be at least 8 characters", '/manage-users-add' );
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
        // step 5: create the user account. Remember to assign role to the user

           $sql = "INSERT INTO users (`name`,`email`,`role`,`password`) VALUES (:name, :email,:role, :password)";

           $query = $database->prepare( $sql );

           $query->execute([
               'name' => $name,
               'email' => $email,
               'role' => $role,
               'password' => password_hash( $password, PASSWORD_DEFAULT )
           ]);

        // Step 6: redirect back to login
        // set success message
          $_SESSION["success"] = "Account has been created successfully.";
       header("Location: /manage-users");
       exit;
      }else {
        setError("The email is already taken.","/user/add");
      }


    
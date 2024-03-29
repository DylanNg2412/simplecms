<?php
   
    // Step 2: connect to the database
    $database = connectToDB();
 
    // Step 3: get all the data from the form using $_POST
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
 
    // Step 4: error checking
     // 4.1 make sure all the fields are not empty
    if ( empty( $name ) || empty( $email ) || empty( $password ) || empty( $confirm_password ) ) {
     setError( "All the fields are required.", "/signup" ); 
    } else if ( $password !== $confirm_password ) {
         // 4.2 - make sure password is match
         setError( "The password does not match", '/signup' );
    } else if ( strlen( $password ) < 8 ) {
         // 4.3 - make sure the password length is at least 8 chars
         setError( "Your password must be at least 8 characters", '/signup' );
    } else {
        // Step 5: make sure email entered does not exist yet
        $sql= "SELECT * FROM users where email = :email";
        $query = $database -> prepare ($sql);
        $query -> execute([
          "email"=>$email
        ]);
        $user = $query->fetch(); // get only one row to data

        if (empty($user)) {
          // step 6: create the user account
             // 6.1 - sql command (recipe)
             $sql = "INSERT INTO users (`name`,`email`,`password`) VALUES (:name, :email, :password)";
             // 6.2 - prepare (put everything into th bowl)
             $query = $database->prepare( $sql );
             // 6.3 - execute (cook it)
             $query->execute([
                 'name' => $name,
                 'email' => $email,
                 'password' => password_hash( $password, PASSWORD_DEFAULT )
             ]);

          // Step 7: redirect back to login
          // set success message
            $_SESSION["success"] = "Account has been created successfully. Please login with your email & password.";
         header("Location: /login");
         exit;
        }else {
          setError("The email is already taken.","/signup");
        }
         
 
         
 
    }
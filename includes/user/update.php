<?php


//This Set of Code is Overkill

// // Step 1: connect to the database
// $database = connectToDB();

// // Step 3: get user data from $_POST
// $name = $_POST["name"];
// $email = $_POST["email"];
// $role = $_POST["role"];
// $id = $_SESSION["new_id"];

// // do error checking. Check if any required field is empty
// if (empty($name) || empty($email) || empty($role)) {
//     setError("All the fields are required.", "/manage-users-edit");
// } else {  
//     // step 4: make sure the email entered does not exists yet
//     $sql= "SELECT * FROM users where email = :email";
//     $query = $database -> prepare ($sql);
//     $query -> execute([
//       "email"=>$email
//     ]);
//     $user = $query->fetch();
// } //end step 3

// if (empty($user)) {
//     // Step 4: update the name in the database for the specific user
//     $sql = "UPDATE users SET name = :name , email = :email , role = :role WHERE id= :id";
//     $query = $database->prepare($sql);
//     $query->execute([
//         'name' => $name,
//         'email' => $email,
//         'role' => $role,
//         'id'=> $id
//     ]);

//     unset($_SESSION["new_id"]);

//       // Update successful
//         $_SESSION["success"] = "The account has been edited successfully.";
//         header('Location:/manage-users');
//         exit;
//     } else {
//       setError("Email already exist.", "/manage-users-edit");}


    // Step 1: connect to the database
    $database = connectToDB();

    // Step 2: get all the data from the form using $_POST
    $id = $_POST['user_id'];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $role = $_POST["role"];    

    // error checking
    // Step 3.1: make sure all the fields are not empty
    if ( empty( $name ) || empty( $email ) || empty( $role ) ) {
        setError( 'All the fields are required', '/manage-users-edit' . $user_id );
    }else{
        // Step 4: make sure the email entered wasn't already exists in the database
        $sql = "SELECT * FROM users where email = :email AND id != :id ";
        $query = $database->prepare( $sql );
        $query->execute([
            'email' => $email,
            'id'  => $user_id
        ]);
        $user = $query->fetch(); // get only one row of data


        if ( empty( $user ) ) {
           // Step 5: update the user data
            $sql = "UPDATE users SET name = :name, email = :email, role = :role WHERE id=:id";
            $query = $database -> prepare($sql);
            $query -> execute([
                'name'=>$name,
                'email'=>$email,
                'role'=>$role,
                'id'=>$id
        ]);
            // Step 6: redirect
            $_SESSION["success"] = "User data has been updated successfully.";
            header("Location: /manage-users");
            exit; 
        }else{
            setError("The email provided has already been used.",'/manage-users-edit?id=' . $user_id);
        } //end -$user
        

    }// end - step 3
    
    

    

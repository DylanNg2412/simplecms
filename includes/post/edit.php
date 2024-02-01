<?php
    // Step 1: connect to the database
    $database = connectToDB();

    // Step 2: get all the data from the form using $_POST
    $id = $_POST['post_id'];
    $title = $_POST["title"];
    $status = $_POST["status"];
    $content = $_POST["content"];
    
    
    // Step 3: error checking
    // 3.1 make sure all the fields are not empty
    if ( empty( $title ) || empty( $content ) || empty( $status )) {
        setError( 'All the fields are required', '/manage-post-edit?id=' . $post_id );
    } else { 
        // Step 5: update the user data
        $sql = "UPDATE posts SET title = :title , status = :status , content = :content WHERE id = :id";
        $query = $database->prepare( $sql );
        $query->execute([
            'title' => $title,
            'content' => $content,
            'status' => $status,
            'id' => $id
        ]);

        // Step 6: redirect back to /manage-users page
        $_SESSION["success"] = "User data has been updated successfully.";
        header("Location: /manage-post");
        exit;
        
    } // end - step 3
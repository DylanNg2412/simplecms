<?php 

 // Step 1: connect to the database
    $database = connectToDB();


 // Step 2: get all the data from the form using $_POST
    $title = $_POST["title"];
    $content = $_POST["content"];

 // Step 3: error checking
 // 3.1: make sure all the fields are not empty
 if (empty( $title ) || empty( $content )) {
    setError( "All the fields are required.", "/manage-post-add" );
 }else {
    $sql = "INSERT INTO posts (`title`,`content`,`user_id`) VALUES (:title, :content, :user_id)";

           $query = $database->prepare( $sql );
           $query->execute([
               'title' => $title,
               'content' => $content,
               'user_id' => $_SESSION['user']['id']
           ]);
           $post = $query-> fetch();

           $_SESSION["success"] = "Your post has been added successfully.";
           header("Location: /manage-post");
           exit;
 }


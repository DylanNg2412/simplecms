<?php 

//make sure the user is logged in
if (!isUserLoggedIn()) {
  header("Location: /login");
  exit;
 }

// load database
$database = connectToDB();

$id = isset( $_GET ["id"]) ?  $_GET["id"] : "";

//get all the users
if(isAdminOrEditor ()) {
  // 1. sql command
  $sql = "SELECT 
    posts.*,
    users.name AS user_name
    FROM posts 
    JOIN users
    ON posts.user_id = users.id    
    ORDER BY id DESC";
  // 2. prepare 
  $query = $database -> prepare($sql);
  // 3. execute
  $query -> execute();
  // 4. fetchAll
  $posts = $query->fetchAll();
}else{
  // 1. sql command
  $sql = "SELECT 
    posts.*,
    users.name AS user_name
    FROM posts 
    JOIN users
    ON posts.user_id = users.id
    WHERE user_id = :user_id 
    ORDER BY id DESC";
  // 2. prepare
  $query = $database->prepare( $sql );
  // 3. execute
  $query->execute([
    "user_id" => $_SESSION["user"]['id'],
  ]);
  $posts = $query->fetchAll();
}

?>

<?php require "parts/header.php"; ?>
    <div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Manage Posts</h1>
        <div class="text-end">
          <a href="/manage-post-add" class="btn btn-primary btn-sm"
            >Add New Post</a
          >
        </div>
      </div>
      <div class="card mb-2 p-4">
        <?php require "parts/success_box.php"; ?>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col" style="width: 40%;">Title</th>
              <th scope="col">Status</th>
              <th scope="col">Author</th>
              <th scope="col" class="text-end">Actions</th>
            </tr>
          </thead>
          <?php foreach( $posts as $post ): ?>
          <tbody>
            <tr>
              <th scope="row"><?= $post["id"]; ?></th>
              <td><?= $post["title"]; ?></td>
              <td>
                <?php if ( $post["status"] === 'pending' ) : ?>
                  <span class="badge bg-warning">Pending</span>
                  <?php endif; ?>

                <?php if ( $post["status"] === 'publish' ) : ?>
                  <span class="badge bg-success">Publish</span>
                  <?php endif; ?>
              </td>
              <td>
                <!-- print user's name here -->
                <?= $post["user_name"]; ?>
              </td>
              <td class="text-end">
                <div class="buttons">
                  <a
                    href="/post?id=<?= $post["id"]; ?>"
                    target="_blank"
                    class="btn btn-primary btn-sm me-2 <?= ( $post["status"] === 'pending' ? 'disabled' : '' ); ?>"
                    ><i class="bi bi-eye"></i
                  ></a>
                  <a
                    href="/manage-post-edit?id=<?= $post["id"]; ?>"
                    class="btn btn-secondary btn-sm me-2"
                    ><i class="bi bi-pencil"></i
                  ></a>
                  <!-- delete button -->
                  <button 
                    type="button" 
                    class="btn btn-danger btn-sm"
                    data-bs-toggle="modal" 
                    data-bs-target="#delete-user-model-<?= $post["id"]; ?>">
                    <i class="bi bi-trash"></i>
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="delete-user-model-<?= $post["id"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5 text-start" id="exampleModalLabel">Are you sure you want to delete this post (<?= $post["title"]; ?>)?</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-start">
                          This action cannot be reversed.
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <form
                            class="d-inline-block"
                            method="POST"
                            action="/post/delete"> 
                            <!-- put hidden input for user's id -->
                            <input 
                              type="hidden"
                              name="post_id"
                              value="<?= $post["id"]; ?>"
                              />
                              <button type="submit" class="btn btn-danger">Yes, Delete</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <div class="text-center">
        <a href="/dashboard" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back to Dashboard</a
        >
      </div>
    </div>
    <?php require "parts/footer.php"; ?>
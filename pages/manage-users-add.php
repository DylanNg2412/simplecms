<?php 

  //make sure the user is logged in
 if (!isUserLoggedIn()) {
  header("Location: /login");
  exit;
 }

 // make sure only admin can see this page
 if( !isAdmin()){
  // if is not admin, then redirect the user back to /dashboard
  header("Location: /dashboard");
  exit;
 }

require "parts/header.php"; ?>
    <div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Add New User</h1>
      </div>
      <div class="card mb-2 p-4">
      <?php require "parts/error_box.php"; ?>
      
        <form method="POST" action="/user/add">
          <div class="mb-3">
            <div class="row">
              <div class="col">
                <label for="name" class="form-label">Name</label>
                <input id="name" name="name" type="text" class="form-control"/>
              </div>
              <div class="col">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" />
              </div>
            </div>
          </div>
          <div class="mb-3">
            <div class="row">
              <div class="col">
                <label for="password" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="password" />
              </div>
              <div class="col">
                <label for="confirm-password" class="form-label">Confirm Password</label>
                <input name="confirm_password" type="password" class="form-control" id="confirm_password"/>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label 
            for="role" 
            class="form-label">Role</label>
            <select class="form-control" id="role" name="role">
              <option value="">Select an option</option>
              <option value="user">User</option>
              <option value="editor">Editor</option>
              <option value="admin">Admin</option>
            </select>
          </div>
          <div class="d-grid">
            <button type="submit" class="btn btn-primary">Add</button>
          </div>
        </form>
      </div>
      <div class="text-center">
        <a href="/manage-users" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back to Users</a
        >
      </div>
    </div>
    <?php require "parts/footer.php"; ?>

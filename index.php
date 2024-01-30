<?php

  // start session
  session_start();

  // require the functions.php file
  require "includes/functions.php";

  // get the current path the user is on
  $path = $_SERVER["REQUEST_URI"];
  // trim out the beginning slash
  $path = trim( $path, '/' );

  // simple router system - deciding what page to load based on the url
  // Routes
  switch ( $path ) {
    // page routes
    case 'login':
      $page_title = "Login";
      require 'pages/login.php';
      break;
    case 'signup':
      $page_title = "Sign Up";
      require 'pages/signup.php';
      break;
    case 'logout':
      $page_title = "Logout";
      require 'pages/logout.php';
      break;
    case 'dashboard':
      $page_title = "Dashboard";
      require 'pages/dashboard.php';
      break;
    case 'post':
      $page_title = "Post";
      require 'pages/post.php';
      break;
    case 'manage-users':
       $page_title = "Manage User";
       require 'pages/manage-users.php';
       break;
    case 'manage-users-add':
       $page_title = "Add New User";
       require 'pages/manage-users-add.php';
       break;
    case 'manage-users-edit':
      $page_title = "Edit User";
      require 'pages/manage-users-edit.php';
      break;
    case 'manage-users-changepwd':
      $page_title = "User Password Change";
      require 'pages/manage-users-changepwd.php';
      break;
    case 'manage-posts':
      $page_title = "Manage Post";
      require 'pages/manage-posts.php';
      break;
    case 'manage-posts-add':
      $page_title = "Add Post";
      require 'pages/manage-posts-add.php';
      break;
    case 'manage-posts-edit':
      $page_title = "Edit Post";
      require 'pages/manage-posts-edit.php';
      break;
    default:
      $page_title = "Home Page";
      require 'pages/home.php';
      break;

         // action routes
    case 'auth/login':
      require 'includes/auth/login.php';
      break;
    case 'auth/signup':
      require 'includes/auth/signup.php';
      break;
    case 'user/add':
      require "includes/user/add.php";
      break;
  }
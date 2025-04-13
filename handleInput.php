<?php

// Include the file that establishes the database connection
include("connect.php");

// Check if the form is submitted
if (isset($_POST["submit"])) {

  // Retrieve user input from the form
  if ($_POST["name"] = '') {
    $name = $_POST["name"];
  } else {
    $name = 'n/a';
  }
  // deleted the desc.
  // $description = $_POST["description"];

  $files = array_filter($_FILES['photo']['name']); //something like that to be used before processing files.

  // Count # of uploaded files in array
  $total = count($_FILES['photo']['name']);

  // Loop through each file
  for( $i=0 ; $i < $total ; $i++ ) {

    //Get the temp file path
    $tmpFilePath = $_FILES['photo']['tmp_name'][$i];

    //Make sure we have a file path
    if ($tmpFilePath != ""){
      //Setup our new file path
      $newName = rand(10000, 99999).'-'. $_FILES['photo']['name'][$i];
      $newFilePath = "./uploads/" . $newName;

      //Upload the file into the temp dir
      if(move_uploaded_file($tmpFilePath, $newFilePath)) {
          // Insert user data into the database
          $sql = "INSERT INTO `user` (`name`, `amount`, `photo`) VALUES ('$name', '1', '$newName')";
          $result = mysqli_query($conn, $sql);
      }
    }
  }




  // Check if the database insertion was successful
  if ($result) {
    // Redirect to a page displaying user details upon success
    header("location: index.php");
    
  } else {
    // Print an error message if the database insertion fails
    echo "Error: " . mysqli_error($conn);
  }
}

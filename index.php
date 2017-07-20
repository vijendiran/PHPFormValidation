<?php
  $dbh = new PDO("mysql:host=localhost;dbname=dating","root","root");
  $sql = "SELECT * FROM signform";
  $accQuery = $dbh->query($sql);
  $details = $accQuery->fetchAll(PDO::FETCH_ASSOC);

$errors=[];
function santizeInput($data){
  $santizedData = trim($data);
  $santizedData = stripslashes($data);
  $santizedData = htmlentities($data);
  return $santizedData;
}
if(isset($_POST["submit-registerform"])){
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    $firstName = santizeInput($_POST["firstname"]);
    $lastName = santizeInput($_POST["lastname"]);
    $emailCheck = santizeInput($_POST["email"]);


    // echo $firstName."</br>";
    // echo $lastName."</br>";
    // echo $emailCheck."</br>";


    if(empty($firstName)){
     $errors["firstname"]="first name is required"."</br>";
    }
    else{
    if (!preg_match("/^[a-zA-Z ]*$/",$firstName)) {
      $errors["firstname"] = "Only letters and white space allowed"."</br>";
    }
  }

    if(empty($lastName)){
     $errors["lastname"]="last name is required"."</br>";
    }
    else{
    if (!preg_match("/^[a-zA-Z ]*$/",$lastName)) {
    $errors["lastname"] = "Only letters and white space allowed"."</br>";
    }
  }

    if (empty($emailCheck)) {
      $errors["email"]="email is required"."</br>";
 }
   else{
   if (!filter_var($emailCheck,FILTER_VALIDATE_EMAIL)) {
     $errors["email"]= "email is invalid";
   }
   }
   $dbh = new PDO("mysql:host=localhost;dbanme=dating","root","root");
   $sql = "INSERT INTO signform (firstname, lastname, email) VALUES ('$firstName','$lastName','$emailCheck')";
   $add = $dbh->query($sql);
}
//post if statement


 ?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Account Creation Form</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <form class="signup-form" action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post" novalidate>

      <!-- form header -->
      <div class="form-header">
        <h1>Create Account</h1>
      </div>

      <!-- form body -->
      <div class="form-body">

        <!-- Firstname and Lastname -->
        <div class="horizontal-group">
          <div class="form-group left">
            <label for="firstname" class="label-title">First name *</label>
            <input type="text" id="firstname" class="form-input" placeholder="enter your first name" required="required" name="firstname"/>
            <div class="error"><?php if(isset($errors["firstname"])){echo $errors["firstname"];}?></div>
          </div>
          <div class="form-group right">
            <label for="lastname" class="label-title">Last name</label>
            <input type="text" id="lastname" class="form-input" placeholder="enter your last name" name="lastname" />
            <div class="error"><?php if(isset($errors["lastname"])){echo $errors["lastname"];}?></div>

          </div>
        </div>

        <!-- Email -->
        <div class="form-group">
          <label for="email" class="label-title">Email*</label>
          <input type="email" id="email" class="form-input" placeholder="enter your email" required="required" name="email" />
          <div class="error"><?php if(isset($errors["email"])){echo $errors["email"];}?></div>

        </div>
        <!-- Passwrod and confirm password -->
     <!-- <div class="horizontal-group">
       <div class="form-group left">
         <label for="password" class="label-title">Password *</label>
         <input type="password" id="password" class="form-input" placeholder="enter your password" required="required">
       </div> -->
        <!-- Profile picture and Age -->
       <!-- <div class="horizontal-group">
         <div class="form-group right" >
           <label for="choose-file" class="label-title">Upload Profile Picture</label>
           <input type="file" id="choose-file" size="80">
         </div> -->
         <!-- Bio -->
     <!-- <div class="form-group">
       <label for="choose-file" class="label-title">Bio</label>
       <textarea class="form-input" rows="4" cols="50" style="height:auto"></textarea>
     </div>
   </div> -->

        <!-- form-footer -->
      <div class="form-footer">
        <span>* required</span>
        <button type="submit" class="btn" name="submit-registerform">Create</button>
      </div>

  </body>
</html>

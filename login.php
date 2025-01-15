<?php

@include 'config.php';

session_start();

// Function to encrypt password (same as register.php)
function caesarCipher($str, $shift = 13) {
    $encrypted = '';
    for ($i = 0; $i < strlen($str); $i++) {
        $char = $str[$i];
        if (ctype_upper($char)) {
            $encrypted .= chr((ord($char) + $shift - 65) % 26 + 65);
        }
        elseif (ctype_lower($char)) {
            $encrypted .= chr((ord($char) + $shift - 97) % 26 + 97);
        }
        else {
            $encrypted .= $char;
        }
    }
    return $encrypted;
}

// Function to decrypt Caesar cipher
// Uses negative shift value to reverse the encryption
function caesarDecipher($str, $shift = 13) {
    // To decrypt, we shift in the opposite direction
    // For shift of 13, we can use -13 or 13 (since 26-13=13)
    // For other shift values, use 26 - shift
    $decrypted = '';
    for ($i = 0; $i < strlen($str); $i++) {
        $char = $str[$i];
        if (ctype_upper($char)) {
            // Add 26 before modulo to handle negative shifts
            $decrypted .= chr((ord($char) - $shift - 65 + 26) % 26 + 65);
        }
        elseif (ctype_lower($char)) {
            $decrypted .= chr((ord($char) - $shift - 97 + 26) % 26 + 97);
        }
        else {
            $decrypted .= $char;
        }
    }
    return $decrypted;
}

if(isset($_POST['submit'])){

   $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
   $email = mysqli_real_escape_string($conn, $filter_email);
   $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
   
   // Get encrypted password from database first
   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');
   
   if(mysqli_num_rows($select_users) > 0){
      $row = mysqli_fetch_assoc($select_users);
      
      // Decrypt stored password
      $stored_pass = caesarDecipher($row['password']);
      // Compare with user input
      if($filter_pass === $stored_pass){
         if($row['user_type'] == 'admin'){
            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_id'] = $row['id'];
            header('location:admin_page.php');
         }elseif($row['user_type'] == 'user'){
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_id'] = $row['id'];
            header('location:home.php');
         }
      }else{
         $message[] = 'incorrect password!';
      }
   }else{
      $message[] = 'incorrect email!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body style="background-image: url('images/logincover.jpg');">

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
   
<section class="form-container">

   <form action="" method="post">
      <h3>login now</h3>
      <input type="email" name="email" class="box" placeholder="enter your email" required>
      <input type="password" name="pass" class="box" placeholder="enter your password" required>
      <input type="submit" class="btn" name="submit" value="login now">
      <p>don't have an account? <a href="register.php">register now</a></p>
   </form>

</section>

</body>
</html>
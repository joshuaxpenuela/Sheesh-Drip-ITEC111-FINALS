<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>about us</h3>
    <p> <a href="home.php">home</a> / about </p>
</section>

<section class="about">

    <div class="flex">

        <div class="image">
            <img src="images/aboutImg1.jpg" alt="">
        </div>

        <div class="content">
            <h3>why choose us?</h3>
            <p>Luxurious, Best Quality, and Aesthetic Outfit</p>
            <a href="shop.php" class="btn">shop now</a>
        </div>

    </div>

    <div class="flex">

        <div class="content">
            <h3>what we provide?</h3>
            <p>You want to get notice by browskies and shawties from La Salle and Ateneo wearing rizz outfit, bruh? We got you cover!</p>
            <a href="contact.php" class="btn">contact us</a>
        </div>

        <div class="image">
            <img src="images/aboutImg2.jpg" alt="">
        </div>

    </div>

    <div class="flex">

        <div class="image">
            <img src="images/aboutImg3.jpg" alt="">
        </div>

        <div class="content">
            <h3>who we are?</h3>
            <p>People from Forbes Park and Dasmariñas Village</p>
            <a href="#reviews" class="btn">Hit us up</a>
        </div>

    </div>

</section>

<section class="reviews" id="reviews">

    <h1 class="title">GROUP MEMBERS</h1>

    <div class="box-container">

        <div class="box">
            <img src="images/josh_pic.jpg" alt="">
            <h3>Joshua F. Penuela</h3>
            <p>Full Stack Developer<br></p>
        </div>

        <div class="box">
            <img src="images/clark.jpg" alt="">
            <h3>Clark Angelo P. Mendoza</h3>
            <p>Back End Developer</p>
        </div>

        <div class="box">
            <img src="images/gab.jpg" alt="">
            <h3>Gabriel G. Ontengco</h3>
            <p>Front End Developer</p>
        </div>

    </div>

</section>











<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
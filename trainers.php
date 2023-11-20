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
    <title>The Fitness Site</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<header class="header">

    <a href="#" class="logo"> <span>Tan</span>FIT </a>

    <div id="menu-btn" class="fas fa-bars"></div>

    <nav class="navbar">
        <a href="index.php">home</a>
        <a href="#about">about</a>
        <a href="feature.php">features</a>
        <a href="pricing.php">pricing</a>
        <a href="trainers.php">trainers</a>
        <a href="#blogs">blogs</a>
        <a href="logout.php">Logout</a>
    </nav>

</header>

<section class="trainers" id="trainers">

    <h1 class="heading"> <span>expert trainers</span> </h1>
    <?php
      $show_trainers = $conn->prepare("SELECT * FROM `trainers`");
      $show_trainers->execute();
      if($show_trainers->rowCount() > 0){
         while($fetch_trainers = $show_trainers->fetch(PDO::FETCH_ASSOC)){  
   ?>
    <div class="box-container">
        <div class="box">
            <img src="./admin/uploaded_img/<?= $fetch_trainers['image']; ?>" alt="">
            <div class="content">
                <span>expert trainer</span>
                <h3><?= $fetch_trainers['name']; ?></h3>
                <div class="share">
                <?= $fetch_trainers['profile']; ?>
                </div>
                
            </div>
        </div>

        <div class="box">
            <img src="images/trainer-2.jpg" alt="">
            <div class="content">
                <span>expert trainer</span>
                <h3>john deo</h3>
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-pinterest"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
            </div>
        </div>

        <div class="box">
            <img src="images/trainer-3.jpg" alt="">
            <div class="content">
                <span>expert trainer</span>
                <h3>john deo</h3>
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-pinterest"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
            </div>
        </div>

        <div class="box">
            <img src="images/trainer-4.jpg" alt="">
            <div class="content">
                <span>expert trainer</span>
                <h3>john deo</h3>
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-pinterest"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
            </div>
        </div>
    </div>
    <?php
         }
      }else{
         echo '<p class="empty">no trainers available!</p>';
      }
   ?>

</section>


<section class="footer">

    <div class="box-container">

        <div class="box">
            <h3>quick links</h3>
            <a class="links" href="#home">home</a>
            <a class="links" href="#about">about</a>
            <a class="links" href="#features">features</a>
            <a class="links" href="#pricing">pricing</a>
            <a class="links" href="#trainers">trainers</a>
            <a class="links" href="#blogs">blogs</a>
        </div>

        <div class="box">
            <h3>opening hours</h3>
            <p> Monday : <i> 7:00am - 10:30pm </i> </p>
            <p> Tuesday : <i> 7:00am - 10:30pm </i> </p>
            <p> Wednesday : <i> 7:00am - 10:30pm </i> </p>
            <p> Friday : <i> 7:00am - 10:30pm </i> </p>
            <p> Saturday : <i> 7:00am - 10:30pm </i> </p>
            <p> Sunday : <i> closed </i> </p>
        </div>

        <div class="box">
            <h3>opening hours</h3>
            <p> <i class="fas fa-phone"></i> +123-456-7890 </p>
            <p> <i class="fas fa-phone"></i> +111-222-3333 </p>
            <p> <i class="fas fa-envelope"></i> Tanfit23@gmail.com</p>
            <p> <i class="fas fa-map"></i>Televiv, Israel </p>
            <div class="share">
                <a href="#" class="fab fa-facebook-f"></a>
                <a href="#" class="fab fa-twitter"></a>
                <a href="#" class="fab fa-linkedin"></a>
                <a href="#" class="fab fa-pinterest"></a>
            </div>
        </div>

        <div class="box">
            <h3>newsletter</h3>
            <p>subscribe for latest updates</p>
            <form action="">
                <input type="email" name="" class="email" placeholder="enter your email" id="">
                <input type="submit" value="subscribe" class="btn">
            </form>
        </div>

    </div>

</section>

<div class="credit">All rights reserved! </div>
</body>
</html>
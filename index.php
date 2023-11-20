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
    
<!-- header section starts      -->

<header class="header">

    <a href="#" class="logo"> <span>Tan</span>FIT </a>

    <div id="menu-btn" class="fas fa-bars"></div>

    <nav class="navbar">
        <a href="index.php">home</a>
        <a href="#about">about</a>
        <a href="feature.php">features</a>
        <a href="#pricing">pricing</a>
        <a href="trainers.php">trainers</a>
        <a href="#blogs">blogs</a>
        <a href="logout.php">Logout</a>
        
        
    </nav>
    <div class="profile">
    <?php
    $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
    $select_profile->execute([$user_id]);
    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
    ?>
    <a href="#" id="profile-toggle">
        <img src="./admin/uploaded_img/<?= $fetch_profile['image']; ?>" alt="User Photo" style="max-height: 50px; max-width: 50px; font-size: small;">
        <p style="color: white; font-size:medium"><?= $fetch_profile['name']; ?></p>
    </a>
</div>
<div id="user-info" style="display: none;">
    <?php
    $select_application = $conn->prepare("SELECT status FROM applications WHERE user_id = ?");
    $select_application->execute([$user_id]);
    $application_status = $select_application->fetchColumn();

    // Display the application status if it exists
    if ($application_status) {
        echo '<p>Application Status: ' . $application_status . '</p>';
    }
    ?>
</div>


<script>
    // Get references to the elements
    const profileToggle = document.getElementById("profile-toggle");
    const userInfoDiv = document.getElementById("user-info");

    // Add a click event listener to the profile-toggle link
    profileToggle.addEventListener("click", function (event) {
        event.preventDefault(); // Prevent the default link behavior
        userInfoDiv.style.display = (userInfoDiv.style.display === "none") ? "block" : "none";
    });

</script>

</header>

<!-- header section ends     -->

<!-- home section starts  -->

<section class="home" id="home">

    <div class="swiper home-slider">

        <div class="swiper-wrapper">

            <div class="swiper-slide slide" style="background: url(images/home-bg-1.jpg) no-repeat;">
                <div class="content">
                    <span>be strong, be fit</span>
                    <h3>Make yourself stronger than your excuses.</h3>
                    <a href="#pricing" class="btn">get started</a>
                </div>
            </div>

            <div class="swiper-slide slide" style="background: url(images/home-bg-2.jpg) no-repeat;">
                <div class="content">
                    <span>be strong, be fit</span>
                    <h3>Make yourself stronger than your excuses.</h3>
                    <a href="#pricing" class="btn">get started</a>
                </div>
            </div>

            <div class="swiper-slide slide" style="background: url(images/home-bg-3.jpg) no-repeat;">
                <div class="content">
                    <span>be strong, be fit</span>
                    <h3>Make yourself stronger than your excuses.</h3>
                    <a href="#pricing" class="btn">get started</a>
                </div>
            </div>

        </div>

        <div class="swiper-pagination"></div>

    </div>

</section>

<!-- home section ends -->

<!-- about section starts  -->

<section class="about" id="about">

    <div class="image">
        <img src="images/about-img.jpg" alt="">
    </div>

    <div class="content">
        <span>about us</span>
        <h3 class="title">Every day is a chance to become better</h3>
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ratione quia accusamus dicta inventore nobis obcaecati vero odio, id dolorum. Consequatur ex, aperiam deserunt nostrum perferendis illum unde ipsa? Consequatur, distinctio?</p>
        <div class="box-container">
            <div class="box">
                <h3><i class="fas fa-check"></i>body and mind</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Est, enim.</p>
            </div>
            <div class="box">
                <h3><i class="fas fa-check"></i>healthy life</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Est, enim.</p>
            </div>
            <div class="box">
                <h3><i class="fas fa-check"></i>strategies</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Est, enim.</p>
            </div>
            <div class="box">
                <h3><i class="fas fa-check"></i>workout</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Est, enim.</p>
            </div>
        </div>
        <a href="#" class="btn">read more</a>
    </div>

</section>

<!-- about section ends -->

<!-- features section starts  -->

<section class="features" id="features">

    <h1 class="heading"> <span>gym features</span> </h1>

    <div class="box-container">

        <div class="box">
            <div class="image">
                <img src="images/f-img-1.jpg" alt="">
            </div>
                 <div class="content">
                     <img src="images/icon-1.png" alt="">
                     <h3>body building</h3>
                     <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique, atque.</p>
                     <a href="feature.php" class="btn" style="color: black; font-weight: normal;">read more</a>
                </div>
        </div>

        <div class="box second">
            <div class="image">
                <img src="images/f-img-2.jpg" alt="">
            </div>
            <div class="content">
                <img src="images/icon-2.png" alt="">
                <h3>gym for men</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique, atque.</p>
                <a href="feature.php" class="btn" style="color: black; font-weight: normal;">read more</a>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="images/f-img-3.jpg" alt="">
            </div>
            <div class="content">
                <img src="images/icon-3.png" alt="">
                <h3>gym for women</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique, atque.</p>
                <a href="feature.php" class="btn" style="color: black; font-weight: normal;">read more</a>
            </div>
        </div>

    </div>

</section>

<!-- features section ends -->

<!-- pricing section starts  -->

<section class="pricing" id="pricing">  

    <div class="information">
        <span>pricing plan</span>
        <h3>affordable pricing plan for your</h3>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsam dolore excepturi ea suscipit fugiat cum quae, rerum optio mollitia! Tempora?</p>
        <p> <i class="fas fa-check"></i> cardio exercise </p>
        <p> <i class="fas fa-check"></i> weight lifting </p>
        <p> <i class="fas fa-check"></i> diet plans </p>
        <p> <i class="fas fa-c  heck"></i> overall results </p>
        <a href="" class="btn">all pricing</a>
    </div>
    <div class="plan basic">
        <h3>basic plan</h3>
        <div class="price"><span>$</span>30<span>/mo</span></div>
       <div class="list">
        <p> <i class="fas fa-check"></i> personal training </p>
        <p> <i class="fas fa-check"></i> cardio exercise </p>
        <p> <i class="fas fa-check"></i> weight lifting </p>
        <p> <i class="fas fa-check"></i> diet plans </p>
        <p> <i class="fas fa-check"></i> overall results </p>
       </div>
       <a href="apply.php" class="btn">get started</a>
    </div>

    <div class="plan">
        <h3>premium plan</h3>
        <div class="price"><span>$</span>90<span>/mo</span></div>
       <div class="list">
        <p> <i class="fas fa-check"></i> personal training </p>
        <p> <i class="fas fa-check"></i> cardio exercise </p>
        <p> <i class="fas fa-check"></i> weight lifting </p>
        <p> <i class="fas fa-check"></i> diet plans </p>
        <p> <i class="fas fa-check"></i> overall results </p>
       </div>
       <a href="apply.php" class="btn">get started</a>
    </div>

    <?php 
    $stmt = $conn->prepare("SELECT * FROM plan_list");
    $stmt->execute();
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
    ?>

    <div class="plan basic">
        <h3><?php echo $row['title'] ?></h3>
        <div class="price"><span>$</span><?php echo number_format($row['current_price']) ?><span>/<?php echo $row['subscription_type'] ?></span></div>
       <div class="list">
        <p style="text-align: center; padding: 2rem; background: linear-gradient(130deg, #111 93%, transparent 90%);"> <i class="fas fa-check"></i> <?php echo html_entity_decode($row['description']) ?></p>
       </div>
       <a href="apply.php?id=<?php echo $row['plan_id'] ?>" class="btn" style="color: black; font-weight: normal;">get started</a>
    </div>

   
    <?php endwhile; ?>
</section>

<!-- pricing section ends -->

<!-- blogs section starts  -->

<section class="blogs" id="blogs">

    <h1 class="heading"> <span>daily posts</span> </h1>
    
    <div class="swiper blogs-slider">

        <div class="swiper-wrapper">

            <div class="swiper-slide slide">
                <div class="image">
                    <img src="images/blog-1.jpg" alt="">
                </div>
                <div class="content">
                    <div class="link"> <a href="#">by user</a> <span>|</span> <a href="#">21st June, 2023</a> </div>
                    <h3>fitness is not about being better than someone else</h3>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aliquam, tenetur?</p>
                    <a href="#" class="btn">read more</a>
                </div>
            </div>
            
            <div class="swiper-slide slide">
                <div class="image">
                    <img src="images/blog-2.jpg" alt="">
                </div>
                <div class="content">
                    <div class="link"> <a href="#">by user</a> <span>|</span> <a href="#">18th June, 2023</a> </div>
                    <h3>fitness is not about being better than someone else</h3>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aliquam, tenetur?</p>
                    <a href="#" class="btn">read more</a>
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="image">
                    <img src="images/blog-3.jpg" alt="">
                </div>
                <div class="content">
                    <div class="link"> <a href="#">by user</a> <span>|</span> <a href="#">16th June may, 2021</a> </div>
                    <h3>fitness is not about being better than someone else</h3>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aliquam, tenetur?</p>
                    <a href="#" class="btn">read more</a>
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="image">
                    <img src="images/blog-4.jpg" alt="">
                </div>
                <div class="content">
                    <div class="link"> <a href="#">by user</a> <span>|</span> <a href="#">1st June 2021</a> </div>
                    <h3>fitness is not about being better than someone else</h3>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aliquam, tenetur?</p>
                    <a href="#" class="btn">read more</a>
                </div>
            </div>

            <?php
                $select_posts = $conn->prepare("SELECT * FROM `posts` WHERE status = ?");
                $select_posts->execute(['active']);
                    if($select_posts->rowCount() > 0){
                        while($fetch_posts = $select_posts->fetch(PDO::FETCH_ASSOC)){
                            $post_id = $fetch_posts['id'];
                        
             ?>
               <div class="swiper-slide slide">
                <div class="image">
                <img src="./admin/uploaded_img/<?= $fetch_posts['image']; ?>" alt="">
                </div>
                <div class="content content-150">
                    <div class="link"> <a href="#"><?= $fetch_posts['author_name']; ?></a> <span>|</span> <a href="#">21st May, 2023</a> </div>
                    <h3><?= $fetch_posts['title']; ?></h3>
                    <p><?= $fetch_posts['content']; ?></p>
                 </div>
                <a href="feature.php?post_id=<?= $post_id; ?>" class="btn">read more</a>
            </div>
          <?php
           }
      }else{
         echo '<p class="empty">no posts added yet!</p>';
      }
      ?>
         </div>
        
      </div>

</section>


        </div>

        <div class="swiper-pagination"></div>

    </div>

</section>

<!-- blogs section ends -->


<!-- trainers section starts  -->

<section class="trainers" id="trainers">

    <h1 class="heading"> <span>expert trainers</span> </h1>

    <div class="box-container">
       
         <div class="box">
            <img src="images/trainer-1.jpg" alt="">
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

</section>

<!-- trainers section ends -->

<!-- banner section starts  -->

<section class="banner">

    <span>join us now</span>
    <h3>get upto 50% discount</h3>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat architecto nesciunt aut sapiente quis inventore quam vitae quod illum incidunt.</p>
    <a href="#" class="btn">get discount</a>

</section>

<!-- banner section ends -->

<!-- review section starts  -->

<section class="review">

    <div class="information">
        <span>testimonials</span>
        <h3>what our clients says</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis voluptas praesentium asperiores fugiat, excepturi odit obcaecati a voluptatibus earum quisquam?</p>
        <a href="#" class="btn">read more</a>
    </div>

    <div class="swiper review-slider">

        <div class="swiper-wrapper">

            <div class="swiper-slide slide">
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Accusamus, quo.</p>
                <div class="user">
                    <img src="images/pic-1.png" alt="">
                    <div class="info">
                        <h3>john deo</h3>
                        <span>designer</span>
                    </div>
                    <i class="fas fa-quote-left"></i>
                </div>
            </div>

            <div class="swiper-slide slide">
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Accusamus, quo.</p>
                <div class="user">
                    <img src="images/pic-2.png" alt="">
                    <div class="info">
                        <h3>john deo</h3>
                        <span>designer</span>
                    </div>
                    <i class="fas fa-quote-left"></i>
                </div>
            </div>

            <div class="swiper-slide slide">
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Accusamus, quo.</p>
                <div class="user">
                    <img src="images/pic-3.png" alt="">
                    <div class="info">
                        <h3>john deo</h3>
                        <span>designer</span>
                    </div>
                    <i class="fas fa-quote-left"></i>
                </div>
            </div>

            <div class="swiper-slide slide">
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Accusamus, quo.</p>
                <div class="user">
                    <img src="images/pic-4.png" alt="">
                    <div class="info">
                        <h3>john deo</h3>
                        <span>designer</span>
                    </div>
                    <i class="fas fa-quote-left"></i>
                </div>
            </div>

        </div>

    </div>

</section>

<!-- review section ends -->


<!-- footer section starts  -->

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

<!-- footer section ends -->













<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
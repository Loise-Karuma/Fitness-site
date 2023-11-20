<?php 

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}


if(isset($_GET['id'])){
    $plan = $conn->prepare("SELECT * FROM plan_list where plan_id = :id");
    $plan->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $plan->execute();
    $res = $plan->fetch(PDO::FETCH_ASSOC);
    if($res){
        $title = $res['title'];
        $current_price = $res['current_price'];
        $subscription_type = $res['subscription_type'];
    }
}else{
    echo '<script>alert("Plan ID is required on this page.");location.replace("./")</script>';
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

    <link rel="stylesheet" href="admin/assets/css/Font-Awesome-master/css/all.min.css">
    <link rel="stylesheet" href="admin/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin/assets/select2/css/select2.min.css">    
    <link rel="stylesheet" href="admin/assets/summernote/summernote-lite.min.css">
    <link rel="stylesheet" href="admin/assets/css/custom.css">
    <script src="admin/assets/js/jquery-3.6.0.min.js"></script>
    <script src="admin/assets/js/popper.min.js"></script>
    <script src="admin/assets/js/bootstrap.min.js"></script>
    <script src="admin/assets/select2/js/select2.min.js"></script>
    <link rel="stylesheet" href="admin/assetsS/DataTables/datatables.min.css">
    <script src="admin/assets/DataTables/datatables.min.js"></script>
    <script src="admin/assets/Font-Awesome-master/js/all.min.js"></script>
    <script src="admin/assets/summernote/summernote-lite.min.js"></script>
    <script src="admin/assets/js/script.js"></script>
</head>
<body>
<!-- header section -->
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

</header>
<!-- header section ends -->

<h2 class="text-center fs-1">Subscription Application Form</h2>
<center><hr class="bg-primary opacity-100" width="50px"></center>
<div class="col-12 py-5" style="background-color: #000; width: 90%; padding: 20px; margin: 50px; font-size: 16px;">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow rounded-0">
                <div class="card-body rounded-0 py-5">
                    <form action="Actions.php" method="POST" id="application-form">
                    <input type="hidden" name="plan_id" value="<?php echo $res['plan_id']; ?>">

                        <fieldset>
                            <legend class="text-center" style="font-size: 20px; font-weight: bold;">Applicant Details</legend>
                            <center><hr class="bg-primary opacity-100" width="100px"></center>
                            <div class="form-group mb-4">
                                <div class="row mx-0">
                                    <div class="col-md-4">
                                        <label for="lastname" class="control-label text-muted">Last Name</label>
                                        <input type="text" style="font-size: 14px;" class="form-control rounded-0 border-0 border-bottom" id="lastname" name="lastname" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="firstname" class="control-label text-muted">First Name</label>
                                        <input type="text" style="font-size: 14px;" class="form-control rounded-0 border-0 border-bottom" id="firstname" name="firstname" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="middlename" class="control-label text-muted">Middle Name</label>
                                        <input type="text" style="font-size: 14px;" class="form-control rounded-0 border-0 border-bottom" id="middlename" name="middlename" placeholder="(optional)">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="row mx-0">
                                    <div class="col-md-6">
                                        <label for="gender" class="control-label text-muted">Gender</label>
                                        <select  style="font-size: 14px;" class="form-select rounded-0 border-0 border-bottom" id="gender" name="gender" required> 
                                            <option>Male</option>
                                            <option>Female</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="date_of_birth" class="control-label text-muted">Date of Birth</label>
                                        <input type="date" style="font-size: 14px;" class="form-control rounded-0 border-0 border-bottom" id="date_of_birth" name="date_of_birth" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="row mx-0">
                                    <div class="col-md-6">
                                        <label for="email" class="control-label text-muted">Email</label>
                                        <input type="text" style="font-size: 14px;" class="form-control rounded-0 border-0 border-bottom" id="email" name="email" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="contact" class="control-label text-muted">Contact #</label>
                                        <input type="text" style="font-size: 14px;" class="form-control rounded-0 border-0 border-bottom" id="contact" name="contact" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="row mx-0">
                                    <div class="col-md-12">
                                        <label for="address" class="control-label text-muted">Address</label>
                                        <textarea rows="3" style="font-size: 14px;" class="form-control rounded-0 border-0 border-bottom" id="address" name="address" required placeholder="i.e. Block 6 Lot 23, Here Village, There City" style="resize:none"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="row mx-0">
                                    <div class="col-md-12">
                                        <label for="occupation" class="control-label text-muted">Occupation</label>
                                        <input type="text" style="font-size: 14px;" class="form-control rounded-0 border-0 border-bottom" id="occupation" name="occupation" required>
                                    </div>
                                </div>
                                <div class="row mx-0">
                                    <div class="col-md-12">
                                        <label for="company_name" class="control-label text-muted">Company Name</label>
                                        <input type="text" style="font-size: 14px;" class="form-control rounded-0 border-0 border-bottom" id="company_name" name="company_name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-center mt-5">
                                    <button class="btn btn-lg btn-primary w-50 rounded-pill" style="background: linear-gradient(130deg, #a4af0ed2 93%, transparent 90%);
                             color: #fff;" name="apply_plan" type="submit">Submit Application</button>
                            </div>
                        </fieldset>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card rounded-0 shadow">
                <div class="card-header rounded-0 bg-white">
                    <h5 class="card-title" style="font-weight: bold; font-size: 20px;">
                    Plan to Apply
                    </h5>
                </div>
                <div class="card-body rounded-0 py-5">
                    <h3 class="text-center fs-4"><?php echo $title ?></h3>
                    <center><hr class="bg-primary opacity-100" width="50px"></center>
                    <center>
                    <div class="price"><span>$</span><?php echo number_format($current_price) ?><span>/<?php echo $subscription_type?></span></div>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

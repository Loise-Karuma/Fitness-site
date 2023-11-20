<?php 

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:./login.php');
};

include('includes/header.php');

if(isset($_POST['saveUser'])){

   $name = $_POST['name'];
   $name = filter_var($name);
   $email = $_POST['email'];
   $email = filter_var($email);
   $password = $_POST['password'];
   $password = filter_var($password);
   $profile = $_POST['profile'];
   $profile = filter_var($profile);
   $user_type = $_POST['user_type'];
   $user_type = filter_var($user_type);
  
   $image = $_FILES['image']['name'];
   $image = filter_var($image);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;
   
  
   $select_trainers = $conn->prepare("SELECT * FROM `trainers` WHERE name = ?");
   $select_trainers->execute([$name]);

   if($select_trainers->rowCount() > 0){
      $message[] = 'trainer name already exist!';
   }else{

      $insert_trainers = $conn->prepare("INSERT INTO `trainers` (name, email, password, profile, user_type, image) VALUES(?,?,?,?,?,?)");
      $insert_trainers->execute([$name, $email, $password, $profile, $user_type, $image]);

      if($insert_trainers){
         if($image_size > 2000000){
            $message[] = 'image size is too large!';
         }else{
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'new trainer added!';
         }

      }

   }

};






?>

<div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
                <h4>
                    Add Trainer
                    <a href="trainers-list.php" class="btn btn-danger float-end">Back</a>
                </h4>
           </div>
           
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Profile</label>
                        <textarea name="profile" class="form-control" required maxlength="10000" placeholder="write your profile..." cols="30" rows="10"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>User Type</label>
                        <select name="user_type" class="form-select">
                            <option value="">Select Type</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control" accept="image/jpg, image/jpeg, image/png">
                    </div>
                    <div class="mb-3 text-end">
                        <button type="submit" name="saveUser" value="save User" class="btn btn-primary">Save</button>
                    </div>
                    
                </form>
            </div>
          </div>
        </div>
</div>


<?php include('includes/footer.php'); ?>
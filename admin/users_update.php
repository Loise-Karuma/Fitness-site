<?php 

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:./login.php');
};

include('includes/header.php');

if(isset($_POST['updateUser'])){
    $id = $_POST['id'];
   $name = $_POST['name'];
   $name = filter_var($name);
   $email = $_POST['email'];
   $email = filter_var($email);
   $password = $_POST['password'];
   $password = filter_var($password);
   $user_type = $_POST['user_type'];
   $user_type = filter_var($user_type);
  
   $image = $_FILES['image']['name'];
   $image = filter_var($image);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;
   $old_image = $_POST['old_image'];
   
  
   $update_user = $conn->prepare("UPDATE `users` SET name = ?, email = ?, password = ?, user_type = ? WHERE id = ?");
   $update_user->execute([$name, $email, $password, $user_type, $id]);

   $message[] = 'user updated successfully!';

   if(!empty($image)){
      if($image_size > 2000000){
         $message[] = 'image size is too large!';
      }else{

         $update_image = $conn->prepare("UPDATE `users` SET image = ? WHERE id = ?");
         $update_image->execute([$image, $id]);

         if($update_image){
            move_uploaded_file($image_tmp_name, $image_folder);
            unlink('uploaded_img/'.$old_image);
            $message[] = 'image updated successfully!';
         }
      }
   }

}

?>
<div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
                <h4>
                    Edit User
                    <a href="users.php" class="btn btn-danger float-end">Back</a>
                </h4>
           </div>
                <div class="card-body">
                <?php
                    $update_id = $_GET['update'];
                    $select_users = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
                    $select_users->execute([$update_id]);
                    if($select_users->rowCount() > 0){
                     while($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)){ 
                 ?>
            
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="old_image" value="<?= $fetch_users['image']; ?>">
                    <input type="hidden" name="id" value="<?= $fetch_users['id']; ?>">    
                
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="<?= $fetch_users['name']; ?>">
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="<?= $fetch_users['email']; ?>">
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" value="<?= $fetch_users['password']; ?>">
                    </div>
                    <div class="mb-3">
                        <label>User Type</label>
                        <select name="user_type" class="form-select">
                        <option selected><?= $fetch_users['user_type']; ?></option>
                            <option value="">Select Type</option>
                            <option value="trainer">Trainer</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control" accept="image/jpg, image/jpeg, image/png" value="<?= $fetch_users['image']; ?>">
                    </div>
                    <div class="mb-3 text-end">
                        <button type="submit" value = "update user" name="updateUser" class="btn btn-primary">Update</button>
                    </div>
                    
                </form>
            
            <?php
             }
                }else{
                     echo '<p class="empty">no user found!</p>';
                     }
            ?>
            </div>
          </div>
        </div>
</div>


<?php include('includes/footer.php'); ?>
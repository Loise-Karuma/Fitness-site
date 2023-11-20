<?php 


@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('<location:./login.php');
};

include('includes/header.php');

if(isset($_GET['delete'])){

  $delete_id = $_GET['delete'];
  $select_delete_image = $conn->prepare("SELECT image FROM `users` WHERE id = ?");
  $select_delete_image->execute([$delete_id]);
  $fetch_delete_image = $select_delete_image->fetch(PDO::FETCH_ASSOC);
  unlink('uploaded_img/'.$fetch_delete_image['image']);
  $delete_users = $conn->prepare("DELETE FROM `users` WHERE id = ?");
  $delete_users->execute([$delete_id]);
  header('location:users.php');


}
?>

<div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
                <h4>
                    User Lists
                    <a href="users-create.php" class="btn btn-primary float-end">Add User</a>
                    <a href="trainer-create.php" class="btn btn-primary float-end mx-2">Add Trainer</a>
                </h4>
           </div>
           <?php
              $show_users = $conn->prepare("SELECT * FROM `users`");
              $show_users->execute();
              if($show_users->rowCount() > 0){
           ?>
            <div class="card-body">
              <table class="table table-bordered table-stripped">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Image</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                   while ($fetch_users = $show_users->fetch(PDO::FETCH_ASSOC)) {
                ?>
                  <tr>
                    <td><?= $fetch_users['id']; ?></td>
                    <td><?= $fetch_users['name']; ?></td>
                    <td><?= $fetch_users['email']; ?></td>
                    <td><?= $fetch_users['image']; ?></td>
                    <td>
                      <a href="users-update.php?update=<?= $fetch_users['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                      <a href="users.php?delete=<?= $fetch_users['id']; ?>" class="btn btn-danger btn-sm mx-2" onclick="return confirm('delete this user?');">Delete</a>
                    </td>
                  </tr>
                  <?php
                 }
               ?>
                </tbody>
              </table>
            </div>
            <?php
      } else{
      echo '<p class="empty">no users added yet!</p>';
       }
      ?>
          </div>
        </div>
</div> 


<?php include('includes/footer.php'); ?>
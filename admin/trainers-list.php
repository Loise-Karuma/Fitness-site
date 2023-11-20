<?php 

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:../login.php');
};

include('includes/header.php');

if(isset($_GET['delete'])){

  $delete_id = $_GET['delete'];
  $select_delete_image = $conn->prepare("SELECT image FROM `trainers` WHERE id = ?");
  $select_delete_image->execute([$delete_id]);
  $fetch_delete_image = $select_delete_image->fetch(PDO::FETCH_ASSOC);
  unlink('uploaded_img/'.$fetch_delete_image['image']);
  $delete_users = $conn->prepare("DELETE FROM `trainers` WHERE id = ?");
  $delete_users->execute([$delete_id]);
  header('location:trainers-list.php');


}

?>

<div class="row">
        <div class="col-md-12">
          <div class="card">
          <div class="card-header">
    <h4>Trainers List</h4>
</div>
<?php
$show_trainers = $conn->prepare("SELECT * FROM `trainers`");
$show_trainers->execute();
if ($show_trainers->rowCount() > 0) {
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
            while ($fetch_trainers = $show_trainers->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?= $fetch_trainers['id']; ?></td>
                    <td><?= $fetch_trainers['name']; ?></td>
                    <td><?= $fetch_trainers['email']; ?></td>
                    <td><?= $fetch_trainers['image']; ?></td>
                    <td>
                        <a href="trainer-update.php?update=<?= $fetch_trainers['id']; ?>"
                            class="btn btn-success btn-sm">Edit</a>
                        <a href="trainers-list.php?delete=<?= $fetch_trainers['id']; ?>"
                            class="btn btn-danger btn-sm mx-2"
                            onclick="return confirm('Delete this trainer?');">Delete</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
<?php
} else {
    echo '<p class="empty">No trainers added yet!</p>';
}
?>
</div>
</div>
</div>



<?php include('includes/footer.php'); ?>
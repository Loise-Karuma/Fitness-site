<?php
@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:../login.php');
};

include('includes/header.php');

$title = $description = $current_price = $before_price = $subscription_type = $status = "";

if(isset($_POST['savePlan'])){

   $title = $_POST['title'];
   $title = filter_var($title);
   $description = $_POST['description'];
   $description = filter_var($description);
   $current_price = $_POST['current_price'];
   $current_price = filter_var($current_price);
   $before_price = $_POST['before_price'];
   $before_price = filter_var($before_price);
   $subscription_type = $_POST['subscription_type'];
   $subscription_type = filter_var($subscription_type);  
   $status = $_POST['status'];
   $status = filter_var($status);
  
      
   $select_plans = $conn->prepare("SELECT * FROM `plan_list` WHERE title = ?");
   $select_plans->execute([$title]);

   if($select_plans->rowCount() > 0){
      $message[] = 'plan name already exist!';
   }else{

      $insert_plans = $conn->prepare("INSERT INTO `plan_list` (title, description, current_price, before_price, subscription_type, status) VALUES(?,?,?,?,?,?)");
      $insert_plans->execute([$title, $description, $current_price, $before_price, $subscription_type, $status]);

      if($insert_plans){
        if(strlen($description) > 500){
           $message[] = 'description size is too long!';
        }else{
           $message[] = 'new plan added!';
           $title = $description = $current_price = $before_price = $subscription_type = $status = "";
        }

     }
      
   }

};
?>
<div class="container-fluid">
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="">
        <div class="col-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="title" class="control-label">Title</label>
                        <input type="text" name="title" autofocus id="title" required class="form-control form-control-sm rounded-0" value="<?php echo isset($title) ? $title : '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="description" class="control-label">Description</label>
                        <textarea name="description" id="description" cols="30" rows="4" required class="form-control rounded-0 summernote"><?php echo isset($description) ? html_entity_decode($description) : '' ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="current_price" class="control-label">Current Price</label>
                        <input type="text" pattern="[0-9.]+" name="current_price" id="current_price" required class="form-control form-control-sm rounded-0" value="<?php echo isset($current_price) ? $current_price : 0 ?>">
                    </div>
                    <div class="form-group">
                        <label for="before_price" class="control-label">Old Price</label>
                        <input type="text" pattern="[0-9.]+" name="before_price" id="before_price" required class="form-control form-control-sm rounded-0" value="<?php echo isset($before_price) ? $before_price : 0 ?>">
                    </div>
                    <div class="form-group">
                        <label for="subscription_type" class="control-label">Subscription Type</label>
                        <input type="text" name="subscription_type" id="subscription_type" required class="form-control form-control-sm rounded-0" value="<?php echo isset($subscription_type) ? $subscription_type : "" ?>" placeholder="(Monthly, Annually)">
                    </div>
                   
                    <div class="form-group">
                        <label for="status" class="control-label">Status</label>
                        <select name="status" id="status" class="form-select form-select-sm rounded-0">
                            <option value="1" <?php echo (isset($status) && $status == 1 ) ? 'selected' : '' ?>>Active</option>
                            <option value="0" <?php echo (isset($status) && $status == 0 ) ? 'selected' : '' ?>>Inactive</option>
                        </select>
                    </div>
                    <div class="mb-3 text-end">
                        <button type="submit" name="savePlan" value="save Plan" class="btn btn-primary">Save</button>
                        <button type="submit" name="deletePlan" value="delete Plan" class="btn btn-danger mx-2">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


<?php include('includes/footer.php'); ?>

<?php 

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:./login.php');
};

include('includes/header.php');

if(isset($_POST['saveCourse'])){

   $author_name = $_POST['author_name'];
   $author_name = filter_var($author_name);
   $title = $_POST['title'];
   $title = filter_var($title);
   $content = $_POST['content'];
   $content = filter_var($content);
   $status = 'active';
   
   $image = $_FILES['image']['name'];
   $image = filter_var($image);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select_image = $conn->prepare("SELECT * FROM `posts` WHERE image = ?");
   $select_image->execute([$image]);

   if(isset($image)){
      if($select_image->rowCount() > 0 AND $image != ''){
         $message[] = 'image name repeated!';
      }elseif($image_size > 2000000){
         $message[] = 'images size is too large!';
      }else{
         move_uploaded_file($image_tmp_name, $image_folder);
      }
   }else{
      $image = '';
   }

   if($select_image->rowCount() > 0 AND $image != ''){
      $message[] = 'please rename your image!';
   }else{
      $insert_post = $conn->prepare("INSERT INTO `posts`(author_name, title, content, image, status) VALUES(?,?,?,?,?)");
      $insert_post->execute([$author_name, $title, $content, $image, $status]);
      $message[] = 'post published!';
   }
   
}


?>

<div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
                <h4>
                    Add Course/Post
                </h4>
           </div>
           
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Author</label>
                        <input type="text" name="author_name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control" accept="image/jpg, image/jpeg, image/png">
                    </div>
                    <div class="mb-3">
                        <label>Content</label>
                        <textarea name="content" class="form-control" required maxlength="10000" placeholder="write your content..." cols="30" rows="10"></textarea>
                    </div>
                    <div class="mb-3 text-end">
                        <button type="submit" name="saveCourse" value="save Course" class="btn btn-primary">Save</button>
                    </div>
                    
                </form>
            </div>
          </div>
        </div>
</div>


<?php include('includes/footer.php'); ?>
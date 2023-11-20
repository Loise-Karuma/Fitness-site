<?php include('includes/header.php');?>
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h3 class="card-title">Plan List</h3>
        <div class="card-tools align-middle">
            <a href="manage_plan.php" class="btn btn-success float-end">Add New</a>
            
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover table-striped table-bordered">
            <colgroup>
                <col width="5%">
                <col width="15%">
                <col width="25%">
                <col width="30%">
                <col width="15%">
                <col width="10%">
            </colgroup>
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Date Created</th>
                    <th class="text-center">Title</th>
                    <th class="text-center">Description</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                 $show_plans = $conn->prepare("SELECT * FROM `plan_list`");
                 $show_plans->execute();
                 if($show_plans->rowCount() > 0){
                while($fetch_plans = $show_plans->fetch(PDO::FETCH_ASSOC)){  
             ?>
                <tr>
                <td class="text-center"></td>
                    <td class=""><?php echo date("Y-m-d H:i",strtotime($fetch_plans['date_created'])) ?></td>
                    <td class=""><?php echo ($fetch_plans['title']) ?></td>
                    <td class="" title="<?php echo $fetch_plans['description'] ?>"><p class="m-0 truncate-3 lh-1"><small><i><?php echo $fetch_plans['description'] ?></i></small></p></td>
                    <td class=" text-center">
                    <?php if($fetch_plans['status'] == 1): ?>
                        <span class="badge bg-success  rounded-pill"><small>Active</small></span>
                    <?php else: ?>
                        <span class="badge bg-danger  rounded-pill"><small>Inactive</small></span>
                    <?php endif; ?>
                </td>

                    <th class="text-center ">
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle btn-sm rounded-0 py-0" data-bs-toggle="dropdown" aria-expanded="false">
                            Action
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <li><a class="dropdown-item view_data" data-id = '<?php echo $row['plan_id'] ?>' href="javascript:void(0)">View</a></li>
                            <li><a class="dropdown-item edit_data" data-id = '<?php echo $row['plan_id'] ?>' href="javascript:void(0)">Edit</a></li>
                            <li><a class="dropdown-item delete_data" data-id = '<?php echo $row['plan_id'] ?>' data-name = '<?php echo $row['title'] ?>' href="javascript:void(0)">Delete</a></li>
                            </ul>
                        </div>
                    </th>
                </tr>
            <?php
           }
           }else{
              echo '<p class="empty">no plans added yet!</p>';
           }
          ?>
               
            </tbody>
        </table>
    </div>
</div>
<script>
    $(function(){
        $('#create_new').click(function(){
            uni_modal('Add New Plan',"manage_plan.php",'mid-large')
        })
        $('.edit_data').click(function(){
            uni_modal('Edit Plan Details',"manage_plan.php?id="+$(this).attr('data-id'),'mid-large')
        })
        $('#featured_plans').click(function(){
            uni_modal('Manage Feature Plans',"manage_featured.php")
        })
        $('.view_data').click(function(){
            uni_modal('Plan Details',"view_plan.php?id="+$(this).attr('data-id'),'mid-large')
        })
        $('.delete_data').click(function(){
            _conf("Are you sure to delete <b>"+$(this).attr('data-name')+"</b> from list?",'delete_data',[$(this).attr('data-id')])
        })
        $('table td,table th').addClass('align-middle px-2 py-1')
        $('table').dataTable({
            columnDefs: [
                { orderable: false, targets:5 }
            ]
        })
    })
    function delete_data($id){
        $('#confirm_modal button').attr('disabled',true)
        $.ajax({
            url:'manage_plan.php?a=delete_plan',
            method:'POST',
            data:{id:$id},
            dataType:'JSON',
            error:err=>{
                console.log(err)
                alert("An error occurred.")
                $('#confirm_modal button').attr('disabled',false)
            },
            success:function(resp){
                if(resp.status == 'success'){
                    location.reload()
                }else{
                    alert("An error occurred.")
                    $('#confirm_modal button').attr('disabled',false)
                }
            }
        })
    }
</script>
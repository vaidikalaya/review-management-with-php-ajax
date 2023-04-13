<?php 
include "includes/header.php";
include "databases/dbconn.php";
$query="SELECT * FROM users";
$result=mysqli_query($conn,$query);
$users=mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="pages/add-update-review.php">Add Review</a>
        </div>
        <div class="card-body">
            <table>
                <table id="datatable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>
                                <button class="btn d-none" id="bulckDelete" onclick="deleteReview('bulckDelete')">
                                    <svg id="delSvg" viewBox="0 0 448 512" height="20" width="20" fill="#c10d0d"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                                </button>
                            </th>
                            <th>Name</th>
                            <th>Rating</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($users as $user){
                            ?>
                                <tr>
                                    <td class="column-check">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input userCheck" value="<?= $user['id'] ?>">
                                        </div>
                                    </td>
                                    <td><?= $user['name'] ?></td>
                                    <td><?= $user['rating'] ?></td>
                                    <td><?= $user['description'] ?></td>
                                    <td>
                                        <a class="btn btn-primary" href="pages/add-update-review.php?edit_review&id=<?= $user['id'] ?>">Edit</a>
                                        <a class="btn btn-danger" onclick=deleteReview(<?= $user['id'] ?>)>Delete</a>
                                    </td>
                                </tr>
                            <?php  
                            }
                        ?>
                    </tbody>
                </table>
            </table>
        </div>
    </div>
</div>

<script>
    var userIds=[];
    $(document).ready(function () {
        $('#datatable').DataTable();
    });

    $(document).on("click", ".userCheck", function () {   
        if($(this).prop('checked')){
            userIds.push($(this).val());
        }else{
            let index = userIds.indexOf($(this).val());
            userIds.splice(index, 1);
        }
        userIds.length>0?$('#bulckDelete').removeClass('d-none'):$('#bulckDelete').addClass('d-none');
    }); 

    function deleteReview(typeOrId){
        if(typeOrId!='bulckDelete'){
            userIds.push(typeOrId);
        }
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type:'POST',
                    url:"<?=SITE_URL?>databases/review-script.php?delete-review",
                    data:{userIds:userIds},
                    success:function(res){
                        var res=JSON.parse(res);
                        if(res.status===200){
                            Swal.fire({
                                icon: 'success',
                                title: 'Review Deleted',
                            }).then((result) => {
                                if(result.isConfirmed) {
                                    location.reload();
                                }
                            })
                        }
                    },
                });
            }
        })
    }
</script>
<?php include "includes/footer.php";?>
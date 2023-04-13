<?php 
    include "../includes/header.php"; 
    if(isset($_REQUEST['edit_review'])){
        include "../databases/dbconn.php";
        $userId=$_REQUEST['id'];
        $query="SELECT * FROM users WHERE id=$userId";
        $result=mysqli_query($conn,$query);
        $userData=mysqli_fetch_assoc($result);
        $contactInfo=json_decode($userData['contact_info']);
    }
    function showData($data){
        if(isset($GLOBALS['userData'])){
            if($data==='email' || $data==='phone'){
              return json_decode($GLOBALS['userData']['contact_info'])->$data;
            }else{
                return $GLOBALS['userData'][$data];
            }
        }else{
            return null;
        }
    }
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header">
                    Add Review 
                    <a class="float-end" href="<?= SITE_URL ?>index.php">Back</a>
                </div>
                <div class="card-body">
                    <form onsubmit="addUpdate(event)" id="addUpdateForm" autocomplete="off">
                        <div class="row">

                            <input type="hidden" name="user_id" value="<?=showData('id')?>">
                            
                            <div class="col-sm-12 col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="fullname" value="<?= showData('name');  ?>" class="form-control" id="fullname" placeholder="fullname" required>
                                    <label for="fullname">Full Name</label>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="email" name="email" value="<?= showData('email'); ?>" class="form-control" id="email" placeholder="email" required>
                                    <label for="email">Email</label>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="number" name="phone" value="<?= showData('phone'); ?>" class="form-control" id="phone" placeholder="phone" required>
                                    <label for="phone">Phone</label>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div class="form-floating mb-3">
                                    <select name="rating" value="<?= showData('rating')?>" class="form-select" id="rating" required>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    <label for="rating">Rating</label>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" name="description" placeholder="description" id="description" style="height: 100px" required><?=showData('description')?></textarea>
                                    <label for="description">Description</label>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function addUpdate(event){
        event.preventDefault();
        var formData=$('#addUpdateForm').serialize();
        $.ajax({
            type:'POST',
            url:"<?=SITE_URL?>databases/review-script.php?add-update-review",
            data:formData,
            success:function(res){
                var res = JSON.parse(res);
                if(res.status===200){
                    Swal.fire({
                        icon: 'success',
                        title: res.message,
                    }).then((result) => {
                        if(result.isConfirmed) {
                            window.location='<?=SITE_URL?>index.php';
                        }
                    })
                }
            },
        });
    }
</script>

<?php include "../includes/footer.php";?>
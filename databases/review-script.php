<?php
include "dbconn.php";

if(isset($_REQUEST['add-update-review'])){
    $userId=$_REQUEST['user_id'];
    $fullname=$_REQUEST['fullname'];
    $contactInfo=json_encode(['email'=>$_REQUEST['email'],'phone'=>$_REQUEST['phone']]);
    $rating=$_REQUEST['rating'];
    $description=$_REQUEST['description'];
    $date = date('Y-m-d H:i:s:u');
    if(!$userId){
        $query="INSERT INTO users(name,contact_info,rating,description,create_date,last_update) 
        VALUES('$fullname','$contactInfo','$rating','$description','$date','$date')";
    }
    else{
        $query="UPDATE users set 
                    name='$fullname',
                    contact_info='$contactInfo',
                    rating='$rating',
                    description='$description',
                    last_update='$date'
                    WHERE id=$userId
                ";
    }

    $result=mysqli_query($conn,$query);
    
    if($result){
        $response = [
            'status'=>200,
            'success'=>true,
            'message'=>$userId ? 'Review updated succesfully!' : 'Review added succesfully!' 
        ];
        print_r(json_encode($response));
    }
}

if(isset($_REQUEST['delete-review'])){
    $userIds=$_REQUEST['userIds'];
    if(count($userIds)>0){
        foreach($userIds as $userId){
            $query="DELETE FROM users WHERE id=$userId";
            $result=mysqli_query($conn,$query);
        }
        $response = [
            'status'=>200,
            'success'=>true,
            'message'=>'Review deleted!'
        ];
        print_r(json_encode($response));
    }
}
?>
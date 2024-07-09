<?php
    // include constants
     include('../config/constant.php');
    if(isset($_GET['id']) && isset($_GET['image_name'])){
        // process to delete
        // echo "processs to delete";

        // 1. get id and image name
            $id = $_GET['id'];
            $image_name = $_GET['image_name'];
        //2. remove the image if available
            // check whether image is available or not and delete only if available
                if($image_name != ""){
                    // it has image and need to remove
                    // get the image path
                    $path = "../images/food/".$image_name;
                    // remove the picture from folder
                    $remove = unlink($path);

                    // check whether the image is removed or not
                    if($remove == false){
                        // failed to remove
                        $_SESSION['upload'] = "<div class='error'> Failed To Remove Image</div>";
                          header('location:'.HOMEURL.'admin/manage-food.php');
                          die();
                    }
                }else{
                    //
                }

        //3. remove food from database
                $sql = " DELETE FROM tbl_food WHERE id = $id";
                $res = mysqli_query($conn,$sql);
                if($res == true){
                    $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully</div>";
                    header('location:'.HOMEURL.'admin/manage-food.php');
                }else{
                    $_SESSION['delete'] = "<div class='error'>Failed To Delete Food</div>";
                    header('location:'.HOMEURL.'admin/manage-food.php');
                }
        // 4. redirecte to manage food page with session message

    }else{
        // redirect to manage food 
        // echo "redirect";

        $_SESSION['delete'] = "<div class='error'> Unauthorized access</div>";
        header('location:'.HOMEURL.'admin/manage-food.php');
    }

?>
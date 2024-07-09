<?php 
// include the constant file
    include('../config/constant.php');

// check whether the id and image name value is set
    if(isset($_GET['id']) AND isset($_GET['image_name'])){
        // getb the value and delete
        // echo "get the value and delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // remove the physical image file if availabe
        if($image_name!=""){
            // image is available so remove it
            $path = "../images/category/".$image_name;
            // remove the image
            $remove = unlink($path);
            // if failed to remove image then add error message and stp the process
            if($remove== false){
                $_SESSION['remove'] = "<div class='error'>Failed To Remove Image</div>";
                header('location:'.HOMEURL.'admin/manage-category.php');
                die();
            }
        }
        // sql query to remove data fron the database

        $sql = "DELETE FROM tbl_category WHERE id = $id";
        $res = mysqli_query($conn,$sql);
        if($res){
            // set success message and redirect
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully</div>";
            header('location:'.HOMEURL.'admin/manage-category.php');
        }else{
            $_SESSION['delete'] = "<div class='error'>Failed To Deleted Category</div>";
            header('location:'.HOMEURL.'admin/manage-category.php');
        }

    }else{
        // redirect to manage category page
        header('location:'.HOMEURL.'admin/manage-category.php');
    }

?>
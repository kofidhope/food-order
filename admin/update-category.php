<?php include('partials/menu.php')?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Category</h1>
            <br><br>
        <?php
            // check whether the id is set or not
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $sql = "SELECT * FROM tbl_category WHERE id = $id";
                $res = mysqli_query($conn,$sql);
                // check the row to see if the is valid or not
                $count = mysqli_num_rows($res);
                if($count ==1){
                    // get all the data
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }else{
                    $_SESSION['no-category-found'] = "<div class='error'>No Category Found</div>";
                    header('location:'.HOMEURL.'admin/manage-category.php');
                }
            }else{
                header('location:'.HOMEURL.'admin/manage-category.php');
            }

        ?>
 


            <form action="" method="post" enctype="multipart/form-data">
                <table class="tbl-50">
                    <tr>
                        <td>Title:</td>
                        <td><input type="text" name="title" value="<?php echo $title;?>"></td>
                    </tr>
                    <tr>
                        <td>current Image:</td>
                        <td>
                            <?php
                                if($current_image!=""){
                                    // display the image
                                    ?>
                                    <img src="<?php echo HOMEURL;?>images/category/<?php echo $current_image;?>" width="50px">
                                    <?php
                                }else{
                                    // display a message
                                    echo "<div class='error'>Image Not Added</div>";
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>New Image:</td>
                        <td><input type="file" name="image"></td>
                    </tr>
                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes
                            <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td>Active:</td>
                        <td>
                            <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes
                            <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                            <input type="hidden" name="id" value="<?php echo $id;?>">
                            <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
            <?php
            
                if(isset($_POST['submit'])){
                    // 1. get values from form
                    $id = $_POST['id'];
                    $title = mysqli_real_escape_string($conn,$_POST['title']);
                    $current_image = $_POST['current_image'];
                    $featured = $_POST['featured'];
                    $active = $_POST['active'];

                    //2.updating new image if selected
                    // check whether the image is selected
                        if(isset($_FILES['image']['name'])){
                            // get the image details
                            $image_name = $_FILES['image']['name'];
                            // check whether image is available or not
                            if($image_name != ""){
                                // image is available
                                //1. upload the new image

                                // Auto rename image
                                // get the extension of the image
                                    $ext = end(explode('.',$image_name));
                                    
                                // rename the image
                                    $image_name = "Food_Category_".rand(000,999).'.'.$ext;

                                    $source_path = $_FILES['image']['tmp_name'];

                                    $destination_path = "../images/category/".$image_name;

                                // finally upload

                                    $upload = move_uploaded_file($source_path,$destination_path);

                                // check ehether the image is uploaded or not
                                //and if the image is not uploaded then we will stop and redirect with an error message
                                    if($upload == false)
                                    {
                                        $_SESSION['upload'] = "<div class='error'>Failed To Upload Image</div>";
                                        header('location:'.HOMEURL.'admin/manage-category.php');
                                        die();
                                    }

                                //2. remove the current image if available
                                    if($current_image != "")
                                    {
                                        $remove_path = "../images/category/".$current_image;
                                        $remove = unlink($remove_path);
                                    // check whether the imagwe is removed or not
                                    // if failed to reomve stop and display message
                                        if($remove == false){
                                            // failed to remove image
                                                $_SESSION['failed-removed'] ="<div class='error'>Failed To Remove Current Image</div>";
                                                header('location:'.HOMEURL.'admin/manage-category.php');
                                                die();
                                        }
                                    }
                                    
                            }else{
                                $image_name = $current_image;
                            }

                        }else{
                            $image_name = $current_image;
                        }

                           
                             
                     

                    //3.update the database
                        $sql2 = "UPDATE tbl_category SET 
                        title = '$title',
                        image_name = '$image_name',
                        featured = '$featured',
                        active = '$active'
                        WHERE id =$id
                        ";
                    // execute the query
                    $res2 = mysqli_query($conn,$sql2);
                    if($res2){
                        // update category
                        $_SESSION['update'] = "<div class='success'>Category Updated</div>";
                        header('location:'.HOMEURL.'admin/manage-category.php');
                    }else{
                    // redirect to manage-category with message
                    $_SESSION['update'] = "<div class='error'>Failed To Update Category</div>";
                    header('location:'.HOMEURL.'admin/manage-category.php');

                    }
                }
            ?>
        </div>
    </div>

<?php include('partials/footer.php')?>
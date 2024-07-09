<?php include('partials/menu.php')?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Add Category</h1>
            <br><br>

            <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            ?>

            <form action="" method="post" enctype="multipart/form-data">
                <table class="tbl-50">
                    <tr>
                        <td>Title:</td>
                        <td><input type="text" name="title" placeholder="Category Title"></td>
                    </tr>
                    <tr>
                        <td>Select Image:</td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input type="radio" name="featured" value="Yes">Yes
                            <input type="radio" name="featured" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td>Active:</td>
                        <td>
                            <input type="radio" name="active" value="Yes">Yes
                            <input type="radio" name="active" value="No">No
                        </td>
                        
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>


<?php include('partials/footer.php')?>
    <?php 
        if(isset($_POST['submit'])){
            $title = $_POST['title'];

            // check whether the image is selected or not and set the value accordingly
            // print_r($_FILES['image']);
            // die();
            if(isset($_FILES['image']['name'])){
                // upload the image
                // to upload the image we need image name, source path and destination path
                $image_name = $_FILES['image']['name'];
                // upload image only if image is selected
                if($image_name!=""){
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
                    header('location:'.HOMEURL.'admin/add-category.php');
                    die();
                }

            }

            }else{
                // dont upload image and set the image value as blank
                $image_name = "";
            }

            
            //for the radio input we check whether a button is click
            if(isset($_POST['featured'])){
                $featured = $_POST['featured'];
            }else{
                $featured = "No";
            }
            
            if(isset($_POST['active'])){
                $active = $_POST['active'];
            }else{
                $active = "No";
            }

            $sql = "INSERT INTO tbl_category SET
            title = '$title',
            image_name = '$image_name',
            featured = '$featured',
            active = '$active'
            ";
            $res = mysqli_query($conn,$sql);
            if($res){
                $_SESSION['add'] = "<div class='success'>Category Added Successfully</div>";
                header('location:'.HOMEURL.'admin/manage-category.php');
            }else{
                $_SESSION['add'] = "<div class='error'>Failed To Add Category</div>";
                header('location:'.HOMEURL.'admin/add-category.php');
            }
        }
    ?>
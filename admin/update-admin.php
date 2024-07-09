<?php include('partials/menu.php');?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Update Category</h1>
            <br>
                <?php
                // get id from the url
                    $id = $_GET['id'];
                // create sql query to get data from the database
                    $sql="SELECT * FROM tbl_admin   WHERE id=$id";
                // execute the query
                    $res = mysqli_query($conn,$sql);
                    if($res == true){
                        // check whether there is data in the database
                        $count= mysqli_num_rows($res);
                        // check whether we have admin or not
                        if($count==1)
                        {
                            // get details
                           $row = mysqli_fetch_assoc($res);
                           $full_name = $row['full_name'];
                           $username = $row['username'];
                        }
                        else{
                            // redirect tto manage admin page
                            header('location:'.HOMEURL.'admin/manage-admin.php');
                        }
                    }
                ?>

            <form action="" method="post">
                <table class="tbl-30">
                    <tr>
                        <td>Full Name:</td>
                        <td>
                            <input type="text" name="full_name" value="<?php echo $full_name;?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Username:</td>
                        <td>
                            <input type="text" name="username" value=" <?php echo $username;?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo$id;?>">
                            <input type="submit" name="submit" value="Update"  class="btn-secondary">
                        </td>
                    </tr>
                </table>

            </form>
        </div>
    </div>


<?php include('partials/footer.php');?>

<!-- php code to submit data into the database-->
<?php
    if(isset($_POST['submit'])){
        $id =  $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        $sql1="UPDATE tbl_admin SET 
            full_name= '$full_name',
            username =  '$username' WHERE id='$id'
        ";

        $res1 = mysqli_query($conn,$sql1);
        if($res1 == true){
            $_SESSION['update']="<div class ='success'>Admin Updated Successfully</div>";
            header("location:".HOMEURL.'admin/manage-admin.php');
        }
        else{
            $_SESSION['update']="<div class ='error'>Failed To Update Admin</div>";
            header("location:".HOMEURL.'admin/manage-admin.php');
        }
    }

?>


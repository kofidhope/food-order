<?php include('partials/menu.php')?>


        <div class="main-content">
            <div class="wrapper">
               <h1>Manage Admin</h1><br>
               
                <?php 
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                    if(isset($_SESSION['delete'])){
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    if(isset($_SESSION['update'])){
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    if(isset($_SESSION['user-not-found'])){
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }
                    
                    if(isset($_SESSION['change-pwd'])){
                        echo $_SESSION['change-pwd'];
                        unset($_SESSION['change-pwd']);
                    }
                    if(isset($_SESSION['not-match'])){
                        echo $_SESSION['not-match'];
                        unset($_SESSION['not-match']);
                    }
                ?>
                <br><br>
               <!-- button tp add admin-->
               <a href="add-admin.php" class="btn-primary">Add Admin</a>
               <br><br><br>
                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Action</th>

                    </tr>
                    <?php
                        $sql = "SELECT * FROM tbl_admin";
                        $res = mysqli_query($conn,$sql);
                        if($res == true){
                            // count rows whether we have database or not
                            $count =mysqli_num_rows($res);// function to get all the rows in the database
                            $sn = 1;
                            if($count>0){                               
                                while($rows = mysqli_fetch_assoc($res)){
                                    // using the while loop to get data from the database
                                    // and the while loop will run as long a we have data in the database
                                    //we get individual data

                                    $id = $rows['id'];
                                    $full_name = $rows['full_name'];
                                    $username = $rows['username'];
                                    // displaying the values to the table
                                    ?>
                                        <tr>
                                           <td><?php echo $sn++;?></td>
                                           <td><?php echo $full_name;?></td>
                                           <td><?php echo $username;?></td>
                                           <td>
                                              <a href="<?php echo HOMEURL;?>admin/update-password.php?id=<?php echo$id;?>" class="btn-primary">Change Password</a>
                                              <a href="<?php echo HOMEURL;?>admin/update-admin.php?id=<?php echo$id;?>" class="btn-secondary">Update Admin</a>
                                              <a href="<?php echo HOMEURL;?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger">Delete Admin</a>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            }else{
                                
                            }
                        }
                    ?>
                    
                </table>
                
            </div>
            
        </div>
<?php include('partials/footer.php')?>

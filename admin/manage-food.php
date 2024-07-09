<?php include('partials/menu.php')?>


<div class="main-content">
    <div class="wrapper">
       <h1>Manage Food</h1>
                <br>  
                <?php
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                    if(isset($_SESSION['delete'])){
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    if(isset($_SESSION['upload'])){
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }
                    if(isset($_SESSION['update'])){
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                ?>  
                <br>  
               <a href="<?php echo HOMEURL;?>admin/add-food.php" class="btn-primary">Add Food</a>
               <br><br>
               
                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Action</th>

                    </tr>

                    <?php
                     // create sql query to get all food
                        $sql = "SELECT * FROM tbl_food";
                    // execute the query
                        $res = mysqli_query($conn,$sql);

                    //count rows to check whether theres food or not
                        $count = mysqli_num_rows($res);
                        $sn = 1;
                        if($count > 0 ){
                            // we have food \
                            // get the food from databse and display
                            
                            while($row = mysqli_fetch_assoc($res)){
                                // get the value from individual colom
                                $id = $row['id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];

                                ?>
                                    <tr>
                                        <td><?php echo $sn++;?>  </td>
                                        <td> <?php echo $title;?> </td>
                                        <td> $<?php echo $price;?> </td>
                                        <td> 
                                            <?php 
                                                // check whether image or not
                                                if($image_name != "")
                                                {
                                                    ?>
                                                    <img src="<?php echo HOMEURL;?>images/food/<?php echo $image_name;?>" width="50px">
                                                    <?php
                                                }else{
                                                    echo "<div class='error'>image not added</div>";
                                                }
                                            ?> 
                                        </td>
                                        <td> <?php echo $featured;?> </td>
                                        <td> <?php echo $active;?> </td>
                                        <td>
                                            <a href="<?php echo HOMEURL;?>admin/update-food.php?id=<?php echo $id;?>" class="btn-secondary">Update Food</a>
                                            <a href="<?php echo HOMEURL;?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php $image_name;?>" class="btn-danger">Delete Food</a>
                                         </td>
                                    </tr>


                                <?php
                            }
                        }else{
                            // we dont have food
                            echo "<tr><td colspan ='7' class ='error'>Food Not Added Yet</td></tr>";
                        }
                    ?>        
                </table>
        
    </div>
    
</div>
<?php include('partials/footer.php')?>
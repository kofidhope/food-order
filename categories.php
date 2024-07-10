<?php include('partials-front/menu.php');?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php
                // query to display categories that are active
                    $sql ="SELECT * FROM tbl_category where active='Yes'";
                    $res = mysqli_query($conn,$sql);
                // count rows 
                    $count = mysqli_num_rows($res);
                // check whether categories are available or not
                    if($count > 0){
                        // catgories available
                        while($row = mysqli_fetch_assoc($res)){
                            // get the values
                            $id =$row['id'];
                            $title = $row['title'];
                            $image_name = $row['image_name'];
                            ?>
                                <a href="<?php echo HOMEURL;?>category-foods.php?category_id=<?php echo $id;?>">
                                <div class="box-3 float-container">
                                    <?php
                                        if($image_name ==""){
                                            echo"<div class='error'>Image Not Available</div>";
                                        }else{
                                            ?>
                                            <img src="<?php echo HOMEURL;?>images/category/<?php echo $image_name;?>" alt="img" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>
                                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                </div>
                                </a>
                            <?php

                        }
                    }else{
                        // no categories
                        echo "<div class='error'>Category Found</div>";
                    }
                

            
            ?>       
     <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->



    <?php include('partials-front/footer.php');?>
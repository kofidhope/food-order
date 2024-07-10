<?php include('partials-front/menu.php');?>
<?php
    // check whether the food id is set or not
    if(isset($_GET['food_id'])){
        // get the food_id and the details of mthe selected id
        $food_id = $_GET['food_id'];
        // get the details of the selected food
        $sql = "SELECT * FROM tbl_food WHERE id =$food_id";
        $res =mysqli_query($conn,$sql);
        // count rows
        $count = mysqli_num_rows($res);
        // check whether data is available or not
        if($count ==1){
            // data available and get dsta from database
            $row = mysqli_fetch_assoc($res);

            $title = $row['title'];
            $price =$row['price'];
            $image_name = $row['image_name'];
        }else{
            // food not avaialable so redirect to home page
            header('location:'.HOMEURL);
        }
    }else{
        // redirect to home page
        header('location:'.HOMEURL);
    }
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                            // check whether image is available or not
                            if($image_name == ""){
                                // image not available
                                    echo "<div class='error'>Image Not available</div>";
                            }else{
                                ?>
                                 <img src="<?php echo HOMEURL;?>images/food/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                        
                        ?>
                       
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title;?></h3>
                            <input type="hidden" name="food" value="<?php echo $title;?>">
                        <p class="food-price">$<?php echo $price;?></p>
                            <input type="hidden" name="price" value="<?php echo $price;?>">
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. first-lastname" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 024xxxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. forsonbentum55@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
                <?php
                    // check whether submit button id clicked or not
                    if(isset($_POST['submit'])){
                        // get detailsd from database
                        $food = $_POST['food'];
                        $price = $_POST['price'];
                        $qty = $_POST['qty'];
                        $total = $price * $qty;
                        $order_date = date("y-m-d h:i:sa");
                        $status = "ordered";
                        $customer_name = $_POST['full-name'];
                        $customer_contact = $_POST['contact'];
                        $customer_email = $_POST['email'];
                        $customer_address = $_POST['address'];
 
                        // create sql query to save the order in database
                            $sql2 = "INSERT INTO tbl_order SET
                                food = '$food',
                                price = $price,
                                qty = $qty,
                                total =$total,
                                order_date = '$order_date',
                                status = '$status',
                                customer_name = '$customer_name',
                                customer_contact = '$customer_contact',
                                customer_email = '$customer_email',
                                customer_address = '$customer_address'
                            ";
                            //echo $sql2; die();
                        // execute trhe query
                            $res2 = mysqli_query($conn,$sql2);
                        // check whether the the query is executed or not
                            if($res2 == true){
                                // query executed and order save
                                $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully</div>";
                                header('location:'.HOMEURL);
                            }else{
                                // failed to save order
                                $_SESSION['order'] = "<div class='error text-center'>Failed To Order Food</div>";
                                header('location:'.HOMEURL);
                            }
                    }
                
                
                ?>
        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <?php include('partials-front/footer.php');?>
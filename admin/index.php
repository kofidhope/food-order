
<?php include('partials/menu.php')?>


    <!-- main content start-->
        <div class="main-content">
            <div class="wrapper">
               <h1>DASHBORD</h1>
               <br><br>
                <?php
                    if(isset($_SESSION['login'])){
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>
                <br><br>

                <div class="col-4 text-center">
                    <?php
                       //sql qery 
                        $sql= "SELECT * FROM tbl_category";
                       //execute the query 
                        $res = mysqli_query($conn,$sql);
                       // count rows to check weda theres data or not
                       $count = mysqli_num_rows($res);
                    ?>
                    <h1><?php echo $count; ?></h1>
                    Categories
                </div>
                <div class="col-4 text-center">
                    <?php
                       //sql qery 
                        $sql2= "SELECT * FROM tbl_food";
                       //execute the query 
                        $res2 = mysqli_query($conn,$sql2);
                       // count rows to check weda theres data or not
                       $count2 = mysqli_num_rows($res2);
                    ?>
                    <h1><?php echo $count2?></h1>
                    Foods
                </div>
                <div class="col-4 text-center">
                    <?php
                       //sql qery 
                        $sql3= "SELECT * FROM tbl_order";
                       //execute the query 
                        $res3 = mysqli_query($conn,$sql3);
                       // count rows to check weda theres data or not
                       $count3 = mysqli_num_rows($res3);
                    ?>
                    <h1><?php echo $count3?></h1>
                    Total Orders
                </div>
                <div class="col-4 text-center">
                    <?php
                        // ccreate sql query to get total revenur generated
                        //aggrgate function in sql

                        $sql4 ="SELECT SUM(total) AS Total FROM tbl_order WHERE status ='Delivered' ";
                       // execute the query
                        $res4 = mysqli_query($conn,$sql4); 
                       // get the value
                        $row = mysqli_fetch_assoc($res4);
                       // get the total revenue
                        $total_revenue = $row['Total'];
                    
                    ?>
                    <h1><?php echo $total_revenue;?></h1>
                    Revenue Generated
                </div>
               
                <div class="clearfix"></div>
            </div>
            
        </div>
 
        <?php include('partials/footer.php')?>
</body>
</html>
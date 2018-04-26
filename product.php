<?php
include("core/connect.php");
include("includes/head.php");
include("includes/navigation.php");
include("breadcrumbs/product.php");
//include("includes/carousel.php");
include("functions.php");

$subID = "";

//Today's Deal
$dqry = "SELECT * FROM products WHERE deal = 1";
$drst = $conn->query($dqry);


//For Default Attributes
if(isset($_GET['default']) && !empty($_GET['default'])){
     $subID = escape($_GET['default']);
}


//Default Products
$subqry = "SELECT * FROM pdtdefaults WHERE pdtID = '$subID'";
$subrst = $conn->query($subqry);


//Subcategories query from product table
//$sqry = "SELECT * FROM products WHERE subID = '$subID'";
//$srst = $conn->query($sqry);


//For Color Attributes
if(isset($_GET['color']) && !empty($_GET['color'])){
     $colID = escape($_GET['color']);
} else{ $colID="";}


//Default Products
$colqry = "SELECT * FROM colors WHERE pdt = '$colID'";
$colst = $conn->query($colqry);


//Subcategories query from product table
$sqry = "SELECT * FROM products WHERE subID = '$subID'";
$srst = $conn->query($sqry);


?>

 
  <div class="container-fluid">
    <div class="row">
        <h2 class="text-center">Gudi Deals for Today</h2>
            <div class="col-md-3 well" id="guddies" style="background:#ffffff;">               
                   <a href=""><img src="images/dis.jpg" alt="discount" class="media-left img-thumb"></a> 
            </div>
            <div class="col-md-9 well" id="guddies">
                <div class="row">
                    <?php while($row = mysqli_fetch_array($drst)){ 
                        $title = $row['product'];
                        $image = $row['image'];
                        $listPrice = $row['list_price'];
                        $ourPrice = $row['our_price'];
                    ?>
                   <div class="col-lg-4 col-md-12 col-xs-12" id="deals">
                            <div class="media-left">
                                <img src="<?php echo 'images/'.$image;?>" alt="jewelries" class="media-left img-thumb">
                            </div>

                            <div class="media-body">
                                <h4 class="media-heading"><?php echo $title;?></h4>
                                <p class="list-price text-danger">List Price <s>&#8358;<?php echo $listPrice;?></s></p>
                                <p class="price">Our Price &#x20A6;<?php echo $ourPrice;?><span style="color:red; font-size:11px;"> - Save &#8358;100</span></p><br>
                                <button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#details-1">View More Details</button>
                            </div>
                    </div>
                    <?php }?>
                </div>
            </div>
    </div>
  </div> 
 
 
 <div class="container-fluid">
     <div class="row">
        <div class="col-md-12">
                 <?php while($prod=mysqli_fetch_array($subrst)){?>
                  <div class="col-sm-6 col-md-2">
                        <div class="thumbnail" style="border:0; background:#F6F6F6; padding-top:0px;">
                            <a href="product.php?pdt=1" name="view"><h4 style="text-align:center;"><img src="<?php echo 'images/'.$prod['image'];?>" alt="" style="max-width:100%;" class="img-responsive"></h4>
                            <h4 style="text-align:center;" name="view"><?php echo $prod['product'];?></h4></a>
                            <center><button type="button" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-shopping-cart" style="color:white;" onclick="add_to_cart();"> </span> Add To Cart</button></center>
                        </div> 
                 </div>
                <?php }?>  
                
                
                 <?php while($prod=mysqli_fetch_array($subrst)){?>
                  <div class="col-sm-6 col-md-2">
                        <div class="thumbnail" style="border:0; background:#F6F6F6; padding-top:0px;">
                            <a href="product.php?pdt=1" name="view"><h4 style="text-align:center;"><img src="<?php echo 'images/'.$prod['image'];?>" alt="" style="max-width:100%;" class="img-responsive"></h4>
                            <h4 style="text-align:center;" name="view"><?php echo $prod['product'];?></h4></a>
                            <center><button type="button" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-shopping-cart" style="color:white;" onclick="add_to_cart();"> </span> Add To Cart</button></center>
                        </div> 
                 </div>
                <?php }?>  
        </div>
     </div>
 </div>
       
       
       
       

<footer></footer>

  <?php
       include("includes/right_nav.php");
   ?>      
    
       
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
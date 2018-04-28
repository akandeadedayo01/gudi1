<?php
include("core/connect.php");
include("includes/head.php");
include("includes/navigation.php");
include("includes/carousel.php");
include("functions.php");



//Today's Deal
$dqry = "SELECT * FROM products WHERE deal = 1 AND quantity > 0";
$drst = $conn->query($dqry);

//Product Display
$fqry = "SELECT * FROM products WHERE featured = 1 AND quantity > 0";
$frst = $conn->query($fqry);

$cqry = "SELECT * FROM categories";
$crst = $conn->query($cqry);


//Default Attribute 
$pdtAttr = "SELECT * FROM products WHERE attribute = 'Default'";
$datrst = $conn->query($pdtAttr);

//Color Attribute
$pcolAttr = "SELECT * FROM products WHERE attribute = 'Color'";
$colrst = $conn->query($pcolAttr);

//Color/Size Attribute
$colszAttr = "SELECT * FROM products WHERE attribute = 'Color/Sizes'";
$colszrst = $conn->query($colszAttr);






//$dattr = "SELECT * FROM pdtdefaults WHERE pdtID= '$dID'";
//$dattrst = $conn->query($dattr);
//while($dfrow = mysqli_fetch_array($dattrst)){ 
//echo $dpdt = $drow['product'];}

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
         <h2 class="text-center">Featured Products</h2>
         
         <div class="col-md-3">
             
<!--             <div class="well well-sm" style="margin-left:5px;"><a href="" style="text-decoration:none;"><i class="fas fa-shopping-cart"></i> 2 Item(s) in your cart. <span class="badge badge-warning pull-right"> <?php echo money(132);?></span></a></div>-->
             
             <div class="panel panel-default" style="margin-left:5px;" >
              <div class="panel-body">
               <i class="fas fa-shopping-cart" style="color:#232f3e;"></i> 2 Item(s) in your cart.
                <span class="badge pull-right" style="background:orange;"> <?php echo money(132);?></span>
              </div>
            </div>

            
              <div class="panel-group" id="accordion" style="margin-left:5px;">
                
                 <?php 
                  $caqry = "SELECT * FROM subcategories";
                  $carst = $conn->query($caqry);
                  $count = 1;
                  while($cate = mysqli_fetch_array($carst)){
                    $sid = $cate['id']
                  ?>
                  <div class="panel panel-default">
                    <div class="panel-heading" style="background:#f6f6f6; color:#232f3e;">
                      <h4 class="panel-title" >
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$count;?>" style="text-decoration:none;">
                         <?= $cate['subcategories'];?> <span class="glyphicon glyphicon-chevron-down pull-right" style="color:#232f3e;"></span></a>
                      </h4>
                    </div>
                    <div id="collapse<?=$count;?>" class="panel-collapse collapse out">
                      <div class="list-group">
                      <?php 
                      $subQry = "SELECT * FROM products WHERE subID = '$sid'";
                      $subRst = $conn->query($subQry);

                      while($subRow = mysqli_fetch_array($subRst)){?>
                      <a href="" style="text-decoration:none;"><button type="button" class="list-group-item"><?= $subRow['product']; ?><span class="badge"><?=$subRow['quantity'];?></span></button></a>
                       <?php }?>
                      </div>
                    </div>
                  </div>
                  
                  <?php $count++; }?>
                 
                </div>
             
  
          </div>
           
        
        <div class="col-md-9">
           <div class="row">
                 <?php while($prod=mysqli_fetch_array($frst)){?>
                  <div class="col-md-5 col-lg-3">
                        <div class="thumbnail" style="border:0; background:white; padding-top:0px;" style="background:white;">
                            <a href="" name="view" style="text-decoration:none;"><h5 style="text-align:center;"><img src="<?php echo 'images/'.$prod['image'];?>" alt="" style="width:auto;" class="img-responsive"></h5>
                            <h4 style="text-align:center; color:#232f3e;" name="view"><?php echo $prod['product'];?></h4></a>
                            <center><button type="button" class="btn btn-xs btn-warning">Buy Now</button></center>
                        </div> 
                  </div>
                <?php }?>  
           </div>
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
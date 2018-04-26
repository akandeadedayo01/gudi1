<?php
include("core/connect.php");
include("includes/head.php");
include("includes/navigation.php");
include("includes/carousel.php");



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
            <div class="panel-group" id="accordion" style="margin-left:10px; broder-radius:0;">
               <div class="panel panel-default">
                    <div class="panel-heading" style="background-color: #232f3e; color:white;">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" href="#collapse1" style="text-decoration: none; font-size: 12px;">Shop By Products ~ Defaults</a>
                      </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse">
                      <ul class="list-group">
                          <?php
                              while($drow = mysqli_fetch_array($datrst)){ 
                              $dprodt = $drow['product'];
                          ?>
                        <a href="product.php?default=<?= $drow['id'];?>" style="text-decoration:none; hover:blue;" class="list-group-item"><?= $dprodt; ?></a>
                        <?php }?>
                      </ul>
                    </div>
                  </div>
                
                 <div class="panel panel-default">
                    <div class="panel-heading" style="background-color: #232f3e; color:white;">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" href="#collapse2" style="text-decoration: none; font-size: 12px;">Shop By Products ~ Varieties</a>
                      </h4>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse">
                      <ul class="list-group">
                         <?php
                              while($crow = mysqli_fetch_array($colrst)){ 
                              $colpdt = $crow['product'];
                          ?>
                        <a href="product.php?color=<?= $crow['id'];?>" style="text-decoration:none; hover:blue;" class="list-group-item"><?= $colpdt; ?></a>
                        <?php }?>
                      </ul>
                    </div>
                  </div>
                  
                  
                   <div class="panel panel-default">
                    <div class="panel-heading" style="background-color: #232f3e; color:white;">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" href="#collapse3" style="text-decoration: none; font-size: 12px;">Shop By Products ~ Color/Sizes</a>
                      </h4>
                    </div>
                    <div id="collapse3" class="panel-collapse collapse">
                      <ul class="list-group">
                         <?php
                              while($czrow = mysqli_fetch_array($colszrst)){ 
                              $colszpdt = $czrow['product'];
                          ?>
                        <a href="product.php?colsz=<?= $czrow['id'];?>" style="text-decoration:none;" class="list-group-item"><?= $colszpdt; ?></a>
                       <?php }?>
                      </ul>
                    </div>
                  </div>
                   
            </div>
          </div>
           
        
        <div class="col-md-9">
           <div class="row">
                 <?php while($prod=mysqli_fetch_array($frst)){?>
                  <div class="col-md-4 col-lg-3">
                        <div class="thumbnail" style="border:0; background:#F6F6F6; padding-top:0px;">
                            <a href="" name="view"><h5 style="text-align:center;"><img src="<?php echo 'images/'.$prod['image'];?>" alt="" style="width:auto;" class="img-responsive"></h5>
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
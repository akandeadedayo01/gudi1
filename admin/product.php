<?php

include("../core/connect.php");
include("../functions.php");
include("includes/prodNav.php");


$pdtQry = "SELECT * FROM products";
$pdtRst = $conn->query($pdtQry);


?>


<div class="container">
          <a href="addPdt.php"><button class="btn pull-right" style="margin-bottom:10px; margin-right:18px; background:#232f3e; color:white">Add Product</button></a>
           <div class="col-md-12">
                <div class="panel panel-default">
                      <div class="panel-heading" style="background:#232f3e; color:white;">
                        <h3 class="panel-title">Product View</h3>
                      </div>
                      <div class="panel-body">
                        <div class="table-responsive">
                         <table class="table table-striped table-hover">
                                  <tr>
                                     <th>Product Codes</th>
                                     <th>Products</th>
                                     <th>Images</th>
                                     <th>Attributes</th>
                                     <th>Quantity</th>
                                     <th>List Price</th>
                                     <th>Our Price</th>
                                     <th>Descriptions</th>
                                  </tr>
                                        
                                      <?php while($row=mysqli_fetch_array($pdtRst)){?>

                                     <tr>
                                         <td><?php echo $row['productCode']; ?></td>
                                         <td><?php echo $row['product']; ?></td>
                                         <td><img src="<?php echo '../images/'.$row['image']; ?>" alt="" style="height:50px;"></td>
                                         <td><?php echo $row['attribute']; ?></td>
                                         <td><?php echo $row['quantity']; ?></td>
                                         <td><?php echo money($row['list_price']); ?></td>
                                         <td><?php echo money($row['our_price']); ?></td>
                                         <td><?php echo $row['description']; ?></td>
                                     </tr>
                                     
                                <?php }?>
                              </table>
                              </div>
                      </div>
                </div>
           </div>
</div>
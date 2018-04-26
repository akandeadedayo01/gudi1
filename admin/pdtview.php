<?php

include("../core/connect.php");
include("../functions.php");
include("includes/prodNav.php");


$pdtaQry = "SELECT s.attribute as attribute, s.quantity as quantity, s.image as image, p.product as product, p.description as description, p.list_price as list_price, p.our_price as our_price, p.brand as brand, p.productCode FROM colorsizes s, products p WHERE s.pdt = p.id 
UNION ALL SELECT c.color as color, c.quantity as quantity, c.image as image, p.product as product, p.description as description, p.list_price as list_price, p.our_price as our_price, p.brand as brand, p.productCode FROM colors c, products p WHERE c.pdt = p.id
UNION ALL SELECT d.product as product, d.quantity as quantity, d.image as image, p.product as product, p.description as description, p.list_price as list_price, p.our_price as our_price, p.brand as brand, p.productCode FROM pdtdefaults d, products p WHERE d.pdtID = p.id";

$pdtaRst = $conn->query($pdtaQry);


?>



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
                                     <th>Brand</th>
                                     <th>Attributes</th>
                                     <th>Quantity</th>
                                     <th>List Price</th>
                                     <th>Our Price</th>
                                     <th>Descriptions</th>
                                  </tr>
                                        
                                      <?php while($row=mysqli_fetch_array($pdtaRst)){?>

                                     <tr>
                                         <td><?php echo $row['productCode']; ?></td>
                                         <td><?php echo $row['product']; ?></td>
                                         <td><img src="<?php echo '../images/'.$row['image']; ?>" alt="" style="height:50px;"></td>
                                         <td><?php echo $row['brand']; ?></td>
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
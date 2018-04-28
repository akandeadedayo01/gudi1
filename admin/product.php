<?php

include("../core/connect.php");
include("../functions.php");
include("includes/prodNav.php");


$pdtQry = "SELECT * FROM products";
$pdtRst = $conn->query($pdtQry);


if(isset($_GET['featured'])){
    
    $id = escape((int)$_GET['id']);
    $feature = escape((int)$_GET['featured']);
    
    $fsql = "UPDATE products SET featured = '$feature' WHERE id = '$id'";
    $frst = $conn->query($fsql);
    header('Location: product.php');

}


if(isset($_GET['deal'])){
    
    $id = escape((int)$_GET['id']);
    $deal = escape((int)$_GET['deal']);
    
    $dsql = "UPDATE products SET deal = '$deal' WHERE id = '$id'";
    $drst = $conn->query($dsql);
    header('Location: product.php');    
}


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
                                     <th>Feature</th>
                                     <th>Deal</th>
                                     <th>Actions</th>
                                     
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
                                         
                                         <td><a href="product.php?featured=<?php echo(($row['featured']== 0)?'1':'0'); ?>&id=<?php echo $row['id']; ?>" class="btn btn-xs btn-default" style="background:#232f3e;"><span class="glyphicon glyphicon-<?php echo(($row['featured']==0)?'plus':'minus');?>" style="color:white;" data-toggle="tooltip" title="Product Features"></span></a> <?php echo (($row['featured']==1)?'Featured Product':'');?></td>
                                        
               
                                         <td><a href="product.php?deal=<?php echo(($row['deal']== 0)?'1':'0'); ?>&id=<?php echo $row['id']; ?>" class="btn btn-xs btn-default" style="background:#232f3e;"><span class="glyphicon glyphicon-<?php echo(($row['deal']==0)?'plus':'minus');?>" style="color:white;" data-toggle="tooltip" title="Deals"></span></a> <?php echo (($row['deal']==1)?"Today's deal":" ");?></td>
                                         
                                         <td><a href="product.php?edit=<?php echo $id?>" class="btn btn-xs btn-primary" style="background:#232f3e;" data-toggle="tooltip" title="Edit"><span class="glyphicon glyphicon-edit" style="color:white;"></span></a>
                                         <a href="product.php?delete=<?php echo $id?>" class="btn btn-xs btn-primary" style="background:#232f3e;" data-toggle="tooltip" title="Delete"><span class="glyphicon glyphicon-trash" style="color:white;"></span></a>
                                         </td>
                                     </tr>
                                     
                                <?php }?>
                              </table>
                              </div>
                      </div>
                </div>
           </div>
</div>
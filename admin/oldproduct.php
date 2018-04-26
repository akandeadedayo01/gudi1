<?php

include("../core/connect.php");
include("../functions.php");
include("includes/prodNav.php");

$csaDel = "DELETE FROM colorsizes WHERE color = ''";
$csaDelRst = $conn->query($csaDel);

$errors = array();

if(isset($_GET['add']) || isset($_GET['edit'])){

    $subqry = "SELECT subcategories FROM subcategories ORDER BY subcategories";
    $subrst = $conn->query($subqry);
    
     if(isset($_GET['edit']) && !empty($_GET['edit'])){
        $editID = escape((int)$_GET['edit']);
        $pdtQry = "SELECT * FROM products WHERE id = $editID";
        $pdtQryRst = $conn->query($pdtQry);
        while($pdtRow=mysqli_fetch_array($pdtQryRst)){
            $pdtID = $pdtRow['id']; $pdtProd = $pdtRow['product']; $pdtDesc = $pdtRow['description']; $pdtLstPrice = $pdtRow['list_price']; $pdtOurPrice = $pdtRow['our_price']; $pdtBrand = $pdtRow['brand']; $pdtAttr = $pdtRow['attribute'];
            $pdtImg = '../images/'.$pdtRow['image'];  $pdtImage = $pdtRow['image']; 
        }
    }
    
    
    
    if(isset($_POST['addP'])){
    
    $prod = escape($_POST['product']);
    $pdtsub = escape($_POST['subcategory']);
    $pdtDesc = escape($_POST['description']);
    $pdtFlag = escape($_POST['flag']);
    $pdtCode = 'PRD'.rand(20810001,50810001);
    
    $image = $_FILES['image']['name'];
    $tmp_image = $_FILES['image']['tmp_name'];
    $imgSize = $_FILES['image']['size'];
        
     
        
    $scatQry = "SELECT id FROM subcategories WHERE subcategories = '$pdtsub'";
    $scatRst = $conn->query($scatQry);
    while($scarow=mysqli_fetch_array($scatRst)){
    $subcateg = $scarow['id'];}
    
        
    if($imgSize > 15728640){
        
        $errors[].= "Image exceeds 15MB Limit";
    }
        
    else{  
        
    $imageExt = explode(".", $image);
    $imageExtension =  $imageExt[1];
         
     if($imageExtension == 'PNG' || $imageExtension == 'png' || $imageExtension == 'JPG' || $imageExtension == 'jpg' || $imageExtension == 'GIF' || $imageExtension == 'gif'){
        
    $image = $image.rand(1, 1000000).time().".".$imageExtension;
        
    $pdSql = "INSERT INTO products(product, subID, brand, list_price, our_price, description, productCode, image, attribute) VALUES ('$prod', '$subcateg', '$pdtBrand', '$pdtListPrice', '$pdtOurPrice', '$pdtDesc', '$pdtCode', '$image', '$pdtFlag')";
    
    
        if(mysqli_query($conn, $pdSql)){
            
            if(isset($_GET['edit'])){
                $pdSql = "UPDATE products SET product = '$prod',  brand = '$pdtBrand', list_price = '$pdtListPrice', our_price = '$pdtOurPrice', description = '$pdtDesc', attribute = '$pdtFlag', image = '$image' WHERE id='$editID'";
            }  
            
            if(move_uploaded_file($tmp_image,"../images/$image")){
                
                 $errors[].= "Record Inserted Successfully!";
            }
            
            else{
                
                 $errors[].= "Error inserting record";
            }
            
        }
    }
        
        else{
            
            $errors[].= "Invalid file type. Only JPG, PNG or GIF File types can be uploaded";
        }
      }
    }
            
            
    
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-5">
            
        </div>
        
        <div class="col-md-7">
             <h4 class="text-center"><?= ((isset($_GET['edit']))?'Edit':'Add A New');?> Product</h4>
            <hr>
               <form action="product.php?<?=((isset($_GET['edit']))?'edit='.$editID:'add=1');?>" method="post" enctype="multipart/form-data">
                   <?php if(count($errors)>0): ?>

                                <div class="alert alert-success" style="text-align:center; display:none;">
                                  
                                  <?php foreach ($errors as $error): ?>

                                 <p><?php echo $error; ?></p>

                                    <?php endforeach ?>

                                </div>

                    <?php endif ?>
                    
               <div class="form-group col-md-3">
                <label for="name">Product<span> * </span>:</label>
                   <input type="text" name="product"  id="product" class="form-control" placeholder="Enter Name" value="<?=((isset($_GET['edit']))?$pdtProd:'');?>" required>
               </div> 
                 
                <div class="form-group col-md-3">
                <label for="category">Select Subcategory<span> * </span>:</label>
                    <select class="form-control" id="category" name="subcategory" required>
                            <option><?=((isset($_GET['edit']))?$pdtDesc:'');?></option>
                            <?php while($row=mysqli_fetch_array($subrst)){?>
                            <option><?php echo $row['subcategories'];?></option>
                            <?php }?>
                    </select>
                </div> 
                
                <div class="form-group col-md-3">
                <label for="brand">Product Brand<span> * </span>:</label>
                   <input type="text" name="brand"  id="brand" class="form-control" placeholder="Enter Brand" value="<?=((isset($_GET['edit']))?$pdtBrand:'');?>" required>
               </div> 
               
               
               <div class="form-group col-md-3">
                <label for="listPrice">List Price<span> * </span>:</label>
                   <input type="text" name="lprice"  id="listPrice" class="form-control" placeholder="List Price" value="<?=((isset($_GET['edit']))?$pdtLstPrice:'');?>" required>
                </div> 
               
                <div class="form-group col-md-3" style="margin-top:20px;">
                <label for="ourPrice">Our Price<span> * </span>:</label>
                   <input type="text" name="oprice"  id="ourPrice" class="form-control" placeholder="Our Price" value="<?=((isset($_GET['edit']))?$pdtOurPrice:'');?>" required>
                </div> 
                
                 <div class="form-group col-md-6" style="margin-top:20px;">
                    <label for="image"><?=((isset($_GET['edit']))?'Upload New Image':'Image Feature');?><span> * </span>:</label>
                    <input type="file" name="image"  id="image" class="form-control" value="<?=((isset($_GET['edit']))?$pdtImage:'');?>">
                 </div> 
                 
                  <div class="form-group col-md-3" style="margin-top:20px;">
                    <label for="size">Select Attribute<span> * </span>:</label>
                        <select class="form-control" id="size" name="flag">
                            <option><?=((isset($_GET['edit']))?$pdtAttr:'');?></option>
                            <option>Color/Sizes</option>
                            <option>Color</option>
                            <option>Default</option>
                        </select>
                  </div>
                  
                    
                    
                    <?php if(isset($_GET['edit'])){ ?>
                    <div class="form-group col-md-4" style="margin-top:20px;">
                        <img src="<?=((isset($_GET['edit']))?$pdtImg:'');?>" alt="" style="width:auto;" class="img-responsive">
                    </div>
                    <?php } ?>
                  
                  
                  <div class="form-group col-md-6" style="margin-top:20px;">
                    <label for="description">Description<span> * </span>:</label>
                    <textarea name="description" id="description" cols="65" rows="10" value="<?=((isset($_GET['edit']))?$pdtDesc:'');?>"></textarea>
                    <input type="submit" name="addP" value="<?=((isset($_GET['edit']))?'Edit':'Add A New');?> Product" class="btn btn-default" style="background:#232f3e; color:white;" required>
                    <?php if(isset($_GET['edit'])){ ?>
                          <a href="product.php" class="btn btn-default btn-success">Cancel</a>
                    <?php } ?>
                  </div> 
              </form>
        </div>
    </div>
</div>


  <script>

      document.querySelector('.alert').style.display = 'block';
      setTimeout(function(){
        document.querySelector('.alert').style.display = 'none';
      },3000);

  </script> 



<?php include("includes/footer.php");}




//Deleting from Product Page
else if(isset($_GET['delete']) && !empty($_GET['delete'])){
        $delete = escape((int)$_GET['delete']);
        $dsql = "DELETE FROM products WHERE id='$delete'";
        $drst = $conn->query($dsql);
        header('Location: product.php');
    }



else {

$pquery = "SELECT p.id as id, p.product as product, p.description as description, p.list_price as list_price, p.our_price as our_price, p.brand as brand, p.featured as featured, p.deal as deal, s.subcategories as subID FROM products p, subcategories s WHERE p.subID = s.id ORDER BY p.id DESC";
$prst = $conn->query($pquery);



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


$sbqry = "SELECT s.subcategories as subcategories, p.subID as id FROM subcategories s, products p WHERE p.subID=s.id";
$sbrst = $conn->query($sbqry);
while($subrow=mysqli_fetch_array($sbrst)){
    $categ = $subrow['subcategories'];
}

     
    
?>



    
    <div class="container-fluid" style="padding-left:0px;">
        <div class="row">
         <a href="pdtview.php" class="btn-default btn-sm pull-right" style="margin-right:25px; color: #ffffff; background-color: #232f3e; font-size: 12px; text-decoration:none;">View Products</a>
           
            <a href="product.php?add=1" class="btn-default btn-sm pull-right" style="color: #ffffff; background-color: #232f3e; font-size: 12px; margin-right:20px; text-decoration:none;" name="add">Add Product</a><hr style="color:white;">
            <div class="clearfix"></div>
           <div class="col-md-12">
                <div class="panel panel-default">
                      <div class="panel-heading" style="background:#232f3e; color:white;">
                        <h3 class="panel-title">Products</h3>
                      </div>
                      <div class="panel-body">
                        <div class="table-responsive">
                         <table class="table table-striped table-hover">
                                  <tr>
                                     <th>ID</th>
                                     <th>Products</th>
                                     <th>Subcategories</th>
                                     <th>Features</th>
                                     <th>Deal</th>
                                     <th>Descriptions</th>
                                     <th>List Price</th>
                                     <th>Our Price</th>
                                     <th>Brand</th>
                                     <th>Actions</th>
                                  </tr>
                                        
                                      <?php while($product=mysqli_fetch_array($prst)){?>

                                     <tr>
                                         <td><?php echo $product['id']; ?></td>
                                         <td><?php echo $product['product']; ?></td>
                                         <td><?php echo $product['subID']; ?></td>
                                         <td><a href="product.php?featured=<?php echo(($product['featured']== 0)?'1':'0'); ?>&id=<?php echo $product['id']; ?>" class="btn btn-xs btn-default" style="background:#232f3e;"><span class="glyphicon glyphicon-<?php echo(($product['featured']==0)?'plus':'minus');?>" style="color:white;" data-toggle="tooltip" title="Product Features"></span></a> <?php echo (($product['featured']==1)?'Featured Product':'');?></td>
                                         
                                         <td><a href="product.php?deal=<?php echo(($product['deal']== 0)?'1':'0'); ?>&id=<?php echo $product['id']; ?>" class="btn btn-xs btn-default" style="background:#232f3e;"><span class="glyphicon glyphicon-<?php echo(($product['deal']==0)?'plus':'minus');?>" style="color:white;" data-toggle="tooltip" title="Deals"></span></a> <?php echo (($product['deal']==1)?"Today's deal":" ");?></td>
                                         
                                         <td><?php echo $product['description']; ?></td>
                                         <td><?php echo money($product['list_price']); ?></td>
                                         <td><?php echo money($product['our_price']); ?></td>
                                         <td><?php echo $product['brand']; ?></td>
                                         <td><a href="product.php?edit=<?= $product['id'];?>" class="btn btn-xs btn-primary" style="background:#232f3e;"><span class="glyphicon glyphicon-edit" style="color:white;" data-toggle="tooltip" title="Edit"></span></a>
                                         <a href="product.php?delete=<?= $product['id'];?>" class="btn btn-xs btn-primary" style="background:#232f3e;"><span class="glyphicon glyphicon-trash" style="color:white;" data-toggle="tooltip" title="Delete"></span></a>
                                         <a href="attribute.php?attr=<?php echo $product['id'];?>" class="btn btn-xs btn-primary" style="background:#232f3e;"><span class="glyphicon glyphicon-cog" style="color:white;" data-toggle="tooltip" title="Add Attributes"></span></a>
                                         </td>
                                     </tr>
                                     
                                <?php }?>
                              </table>
                              </div>
                      </div>
                </div>
           </div>
        </div>
</div>
  
       
<?php }?>  
  
  
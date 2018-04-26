<?php

include("../core/connect.php");
include("../functions.php");
include("includes/prodNav.php");

$errors = array();


$subQry = "SELECT subcategories FROM subcategories";
$subRst = $conn->query($subQry);



?>


    <div class="container">
      <h3>Colors Attributes</h3>
       <div class="row">
            <form action="attribute.php" method="post" enctype="multipart/form-data">
                      
                        <?php if(count($errors)>0): ?>

                                <div class="alert alert-success" style="text-align:center; display:none;">
                                  
                                  <?php foreach ($errors as $error): ?>

                                 <p><?php echo $error; ?></p>

                                    <?php endforeach ?>

                                </div>

                        <?php endif ?>
                        
                        
                         
            <div class="form-group col-md-2">
                <label for="colorc">Brand</label>
                <input type="text" name="colorc" id="colorc" value="" class="form-control" required>
            </div>
        
            <div class="form-group col-md-2">
                <label for="colorc">Subcategory</label>
                    <select class="form-control" id="gender" name="category">
                        <option>Select subcategory</option>
                        <?php while($row=mysqli_fetch_array($subRst)){?>
                        <option><?php echo $row['subcategories'];?></option>
                        <?php }?>
                    </select>
            </div>
            
            <div class="form-group col-md-2">
                <label for="colorc">Color</label>
                <input type="text" name="colorc" id="colorc" value="" class="form-control" required>
            </div>
                        
            <div class="form-group col-md-2">
                <label for="fqtyc">Quantity</label>
                <input type="number" name="fqtyc" id="fqtyc" value="" class="form-control" min="0" required>
            </div>
                        
            <div class="form-group col-md-2">
                <label for="lprice">List Price</label>
                <input type="text" name="lprice" id="lprice" value="" class="form-control" required>
            </div>
                        
             <div class="form-group col-md-2">
                <label for="oprice">Our Price</label>
                <input type="text" name="oprice" id="oprice" value="" class="form-control" required>
             </div>
                                   
              <div class="form-group col-md-6">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="65" rows="10" value=""></textarea>
                    <input type="submit" name="addP" value="Add Product" class="btn btn-default" style="background:#232f3e; color:white; margin-top:10px;" required>
              </div>  
                                    
             <div class="form-group col-md-4">
                <label for="image">Image</label>
                <input type="file" name="image"  id="image" class="form-control">
            </div>                     
                                     
           
                                         
           </form>
        </div>

    </div>
    
    
    
        <div class="container">
        <h3>Color & Sizes Attributes</h3>
            <div class="row">
                 <form action="attribute.php" method="post" enctype="multipart/form-data">
                      
                        <?php if(count($errors)>0): ?>

                                <div class="alert alert-success" style="text-align:center; display:none;">
                                  
                                  <?php foreach ($errors as $error): ?>

                                 <p><?php echo $error; ?></p>

                                    <?php endforeach ?>

                                </div>

                        <?php endif ?>
                    
                    
                        <div class="form-group col-md-2">
                              <label for="pdtID"><span>Product ID</span></label>
                              <input type="text" name="pdt" id="pdtID" value="<?= $pdtID; ?>" class="form-control">
                          </div>
                          
                          <div class="form-group col-md-2">
                              <label for="color"><span>Color</span></label>
                              <input type="text" name="color" id="color" value="" class="form-control">
                          </div>
                          
                           <div class="form-group col-md-2">
                              <label for="size">Select Sizes</label>
                              <select class="form-control" id="size" name="size">
                                <option></option>
                                <option>Small</option>
                                <option>Medium</option>
                                <option>Large</option>
                                <option>X-Large</option>
                              </select>
                          </div>
                          
                           <div class="form-group col-md-2">
                              <label for="qty">Quantity</label>
                              <input type="number" name="qty" id="qty" value="" class="form-control" min="0">
                          </div>
                          
                         
                          
                          <div class="form-group col-md-4">
                                <label for="image">Image</label>
                                <input type="file" name="image"  id="image" class="form-control">
                          </div> 
                        
                           <button class="btn btn-default pull-right" type="submit" name="addCSA" style="color: #ffffff; background-color: #232f3e; font-size: 12px; margin-right:14px;">Add Attributes</button>
                 </form>                
        </div>
    </div>
    
    
        <div class="container">
      <h3>Default Attributes</h3>
       <div class="row">
            <form action="attribute.php" method="post" enctype="multipart/form-data">
                      
                        <?php if(count($errors)>0): ?>

                                <div class="alert alert-success" style="text-align:center; display:none;">
                                  
                                  <?php foreach ($errors as $error): ?>

                                 <p><?php echo $error; ?></p>

                                    <?php endforeach ?>

                                </div>

                        <?php endif ?>
                        
            <div class="form-group col-md-2">
                <label for="pdtID"><span>Product ID</span></label>
                <input type="text" name="pdtd" id="pdtID" value="<?= $pdtID; ?>" class="form-control">
            </div>
                         
            <div class="form-group col-md-4">
                <label for="pdtAttr"><span>Product</span></label>
                <input type="text" name="pdtAttr" id="pdtAttr" value="" class="form-control">
            </div>
                          
            <div class="form-group col-md-2">
                <label for="fqtyAttr">Quantity</label>
                <input type="number" name="fqtyAttr" id="fqtyAttr" value="" class="form-control" min="0">
            </div>
            
            <div class="form-group col-md-4">
                <label for="image">Image</label>
                <input type="file" name="image"  id="image" class="form-control">
            </div>             
                           
        
         <button class="btn btn-default pull-right" type="submit" name="addD" style="color: #ffffff; background-color: #232f3e; font-size: 12px; margin-right:14px;">Add Attributes</button>
        </form>
    </div>

    </div>
   
  
 



<?php
include("includes/footer.php");
?>

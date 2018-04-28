<?php

include("../core/connect.php");
include("../functions.php");
include("includes/prodNav.php");

$errors = array();

//Color Attributes

if(isset($_POST['addCol'])){
    
    $subCat = escape($_POST['subcategory']);
    
    $sQry = "SELECT id FROM subcategories WHERE subcategories = '$subCat'";
    $sRst = $conn->query($sQry); 
    $subRow = mysqli_fetch_array($sRst);
    $sid = $subRow['id'];
    
    $cBrand = escape($_POST['cBrand']);
    $cColor = escape($_POST['colorc']);
    $cQty = escape($_POST['cQty']);
    $clp = escape($_POST['clistPrice']);
    $cop = escape($_POST['cOurPrice']);
    $desc = escape($_POST['description']);
    $pdtCode = 'PRD'.rand(20810001,50810001);
    
    $image = $_FILES['image']['name'];
    $tmp_image = $_FILES['image']['tmp_name'];
    $imgSize = $_FILES['image']['size'];
   
    $chkqry = "SELECT * FROM colors";
    $chkrst = $conn->query($chkqry);
    
    while($chkrow = mysqli_fetch_array($chkrst)){

        $caCol = $chkrow['attribute']; 
        $cb = $chkrow['brand'];       
    }
    
    if($cBrand ==  $cb && $cColor == $caCol){
        
        $errors[].= "Duplicate! Product already exist in the database!";
    }
    
    else if($imgSize > 15728640){
        
        $errors[].= "Image exceeds 15MB Limit";
    }
    
    else{
        
        $imageExt = explode(".", $image);
        $imageExtension =  $imageExt[1];
        
        if($imageExtension == 'PNG' || $imageExtension == 'png' || $imageExtension == 'JPG' || $imageExtension == 'jpg' || $imageExtension == 'GIF' || $imageExtension == 'gif'){
        
        $image = $image.rand(1, 1000000).time().".".$imageExtension;
    
        $caSql = "INSERT INTO colors(attribute, quantity, brand, subID, list_price, our_price, productCode, description, image) VALUES ('$cColor', '$cQty', '$cBrand', '$sid', '$clp', '$cop', '$pdtCode', '$desc', '$image')";
    
        
        if(mysqli_query($conn, $caSql)){
            
            if(move_uploaded_file($tmp_image,"../images/$image")){
                
                $errors[].= "Record Inserted Successfully!";
                
                pdtCol();
            }
            
            else{
                
                 $errors[].= "Error inserting record";
               }
            
             }
        
           }
        
        else{
            
            $errors[].= "Invalid file type. Only JPG/JPEG, PNG or GIF File types can be uploaded";
        }
    }
    
}




//Color and Sizes

    if(isset($_POST['addCSz'])){
        
        $czSubcategory = escape($_POST['czsubcategory']);
        
        $sQry = "SELECT id FROM subcategories WHERE subcategories = '$czSubcategory'";
        $sRst = $conn->query($sQry); 
        $subRow = mysqli_fetch_array($sRst);
        $sid = $subRow['id'];  
        
        $czBrand = escape($_POST['czBrand']);
        $czColor = escape($_POST['czcolor']);
        $czSize = escape($_POST['czsize']);
        $czQty = escape($_POST['czQty']);
        $czlp = escape($_POST['czlistPrice']);
        $czop = escape($_POST['czOurPrice']);
        $czdesc = escape($_POST['czdescription']);
        $pdtCode = 'PRD'.rand(20810001,50810001);
        
        $czAttr = $czColor ."~". $czSize;

        $image = $_FILES['image']['name'];
        $tmp_image = $_FILES['image']['tmp_name'];
        $imgSize = $_FILES['image']['size'];
        
        
        $czQry = "SELECT * FROM colorsizes";
        $czRst = $conn->query($czQry);
    
        while($czrow = mysqli_fetch_array($czRst)){

        $czCol = $czrow['color']; 
        $czSz = $czrow['size'];       
        $czBrd = $czrow['brand'];       
        
        }
        
        
    
        if($czCol == $czColor && $czSz == $czSize && $czBrd == $czBrand){
        
        $errors[].= "Duplicate! Product already exist in the database!";
        
        } 
        
        else if($imgSize > 15728640){
        
        $errors[].= "Image exceeds 15MB Limit";
        
        }
        
        else{
        
        $imageExt = explode(".", $image);
        $imageExtension =  $imageExt[1];
        
        if($imageExtension == 'PNG' || $imageExtension == 'png' || $imageExtension == 'JPG' || $imageExtension == 'jpg' || $imageExtension == 'GIF' || $imageExtension == 'gif'){
        
        $image = $image.rand(1, 1000000).time().".".$imageExtension;
    
        $czSql = "INSERT INTO colorsizes(color, size, attribute, quantity, brand, subID, list_price, our_price, description, image, productCode) VALUES ('$czColor', '$czSize','$czAttr', '$czQty', '$czBrand', '$sid', '$czlp', '$czop', '$czdesc', '$image', '$pdtCode')";
    
        
        if(mysqli_query($conn, $czSql)){
            
            if(move_uploaded_file($tmp_image,"../images/$image")){
                
                 $errors[].= "Record Inserted Successfully!";
                
                 pdtCSz();
            }
            
            else{
                
                 $errors[].= "Error inserting record";
               }
            
             }
        
           }
        
        else{
            
            $errors[].= "Invalid file type. Only JPG/JPEG, PNG or GIF File types can be uploaded";
        }
    }
                        
}



//Default Product

if(isset($_POST['addDSz'])){
        
        $dSubcategory = escape($_POST['dsubcategory']);
        
        $dQry = "SELECT id FROM subcategories WHERE subcategories = '$dSubcategory'";
        $dRst = $conn->query($dQry); 
        $subRow = mysqli_fetch_array($dRst);
        $sid = $subRow['id'];  
        
        $dProd = escape($_POST['dProd']);
        $dQty = escape($_POST['dQty']);
        $dlp = escape($_POST['dlistPrice']);
        $dop = escape($_POST['dOurPrice']);
        $ddesc = escape($_POST['ddescription']);
        $pdtCode = 'PRD'.rand(20810001,50810001);
        

        $image = $_FILES['image']['name'];
        $tmp_image = $_FILES['image']['tmp_name'];
        $imgSize = $_FILES['image']['size'];
        
        
        $dQry = "SELECT * FROM pdtdefaults";
        $dRst = $conn->query($dQry);
    
        while($drow = mysqli_fetch_array($dRst)){

        $dAttr = $drow['attribute'];     
        $dBrd = $drow['brand'];       
        
        }
        
        
        if($dBrd == $dProd){
        
        $errors[].= "Duplicate! Product already exist in the database!";
        
        } 
        
        else if($imgSize > 15728640){
        
        $errors[].= "Image exceeds 15MB Limit";
        
        }
        
        else{
        
        $imageExt = explode(".", $image);
        $imageExtension =  $imageExt[1];
        
        if($imageExtension == 'PNG' || $imageExtension == 'png' || $imageExtension == 'JPG' || $imageExtension == 'jpg' || $imageExtension == 'GIF' || $imageExtension == 'gif'){
        
        $image = $image.rand(1, 1000000).time().".".$imageExtension;
    
        $dSql = "INSERT INTO pdtdefaults(brand, quantity, subID, list_price, our_price, description, image, productCode) VALUES ('$dProd', '$dQty', '$sid', '$dlp', '$dop', '$ddesc', '$image', '$pdtCode')";
    
        
        if(mysqli_query($conn, $dSql)){
            
            if(move_uploaded_file($tmp_image,"../images/$image")){
                
                 $errors[].= "Record Inserted Successfully!";
                
                pdtDf();
            }
            
            else{
                
                 $errors[].= "Error inserting record";
               }
            
             }
        
           }
        
        else{
            
            $errors[].= "Invalid file type. Only JPG/JPEG, PNG or GIF File types can be uploaded";
        }
    }
    
    
    
                  
}





?>


    <div class="container">
      <h3><span>Colors Attributes</span></h3>
       <div class="row">
            <form action="addPdt.php" method="post" enctype="multipart/form-data">
                      
                        <?php if(count($errors)>0): ?>

                                <div class="alert alert-success" style="text-align:center; display:none;">
                                  
                                  <?php foreach ($errors as $error): ?>

                                 <p><?php echo $error; ?></p>

                                    <?php endforeach ?>

                                </div>

                        <?php endif ?>
                        
                        
                         
            <div class="form-group col-md-2">
                <label for="cBrand">Product</label>
                <input type="text" name="cBrand" id="cBrand" value="" class="form-control" required>
            </div>
            
            <div class="form-group col-md-2">
                <label for="colorc">Color</label>
                <input type="text" name="colorc" id="colorc" value="" class="form-control" required>
            </div>
           
            <div class="form-group col-md-2">
                <label for="subcategory">Subcategory</label>
                    <select class="form-control" id="subcategory" name="subcategory">
                        <option>Select subcategory</option>
                        <?php while($czrow=mysqli_fetch_array($subRst)){?>
                        <option><?php echo $czrow['subcategories'];?></option>
                        <?php }?>
                    </select>
            </div>
                        
            <div class="form-group col-md-2">
                <label for="cQty">Quantity</label>
                <input type="number" name="cQty" id="cQty" value="" class="form-control" min="0" required>
            </div>
                        
            <div class="form-group col-md-2">
                <label for="lprice">List Price <span>(&#x20A6;)</span></label>
                <input type="text" name="clistPrice" id="clistPrice" value="" class="form-control" required>
            </div>
                        
             <div class="form-group col-md-2">
                <label for="cOurPrice">Our Price <span>(&#x20A6;)</span></label>
                <input type="text" name="cOurPrice" id="cOurPrice" value="" class="form-control" required>
             </div>
                                   
              <div class="form-group col-md-6">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="65" rows="10" value=""></textarea>
                    <input type="submit" name="addCol" value="Add Product" class="btn btn-default" style="background:#232f3e; color:white; margin-top:10px;" required>
              </div>  
                                    
             <div class="form-group col-md-4">
                <label for="image">Image</label>
                <input type="file" name="image"  id="image" class="form-control">
            </div>                     
                                                                  
           </form>
        </div>

    </div>
    
    
    
<!--Color and Sizes-->
    
     <div class="container">
      <h3><span>Colors & Sizes Attributes</span></h3>
       <div class="row">
            <form action="addPdt.php" method="post" enctype="multipart/form-data">
                      
                      
                        <?php if(count($errors)>0): ?>

                                <div class="alert alert-success" style="text-align:center; display:none;">
                                  
                                  <?php foreach ($errors as $error): ?>

                                 <p><?php echo $error; ?></p>

                                    <?php endforeach ?>

                                </div>

                        <?php endif ?>
                        
     
            <div class="form-group col-md-2">
                <label for="czBrand">Product</label>
                <input type="text" name="czBrand" id="czBrand" value="" class="form-control" required>
            </div>
            
            <div class="form-group col-md-2">
                <label for="czcolor">Color</label>
                <input type="text" name="czcolor" id="czcolor" value="" class="form-control" required>
            </div>
            
      
            <div class="form-group col-md-1">
                <label for="czsize">Size</label>
                    <select class="form-control" id="czsize" name="czsize">
                        <option>Select</option>
                        <option>Small</option>
                        <option>Medium</option>
                        <option>Large</option>
                        <option>XLarge</option>
                        <option>XXLarge</option>
                        <option>XXXLarge</option>
                    </select>
            </div>
               
            <div class="form-group col-md-2">
                <label for="czsubcategory">Subcategory</label>
                    <select class="form-control" id="czsubcategory" name="czsubcategory">
                        <option>Select subcategory</option>
                        <?php 
                        $subQry = "SELECT subcategories FROM subcategories";
                        $subRst = $conn->query($subQry);
                        while($row=mysqli_fetch_array($subRst)){?>
                        <option><?php echo $row['subcategories'];?></option>
                        <?php }?>
                    </select>
            </div>
                          
            <div class="form-group col-md-1">
                <label for="cQty">Quantity</label>
                <input type="number" name="czQty" id="czQty" value="" class="form-control" min="0" required>
            </div>
                        
            <div class="form-group col-md-2">
                <label for="czlistPrice">List Price <span>(&#x20A6;)</span></label>
                <input type="text" name="czlistPrice" id="czlistPrice" value="" class="form-control" required>
            </div>
                        
             <div class="form-group col-md-2">
                <label for="czOurPrice">Our Price <span>(&#x20A6;)</span></label>
                <input type="text" name="czOurPrice" id="czOurPrice" value="" class="form-control" required>
             </div>
                                                         
              <div class="form-group col-md-6">
                    <label for="czdescription">Description</label>
                    <textarea name="czdescription" id="czdescription" cols="65" rows="10" value=""></textarea>
                    <input type="submit" name="addCSz" value="Add Product" class="btn btn-default" style="background:#232f3e; color:white; margin-top:10px;" required>
              </div>  
                                    
             <div class="form-group col-md-4">
                <label for="image">Image</label>
                <input type="file" name="image"  id="image" class="form-control">
            </div>                     
                                                                  
           </form>
        </div>

    </div>
    
    
    
    
<!--Product Default-->
  
       <div class="container">
      <h3><span>Default Attributes</span></h3>
       <div class="row">
            <form action="addPdt.php" method="post" enctype="multipart/form-data">
                      
                      
                        <?php if(count($errors)>0): ?>

                                <div class="alert alert-success" style="text-align:center; display:none;">
                                  
                                  <?php foreach ($errors as $error): ?>

                                 <p><?php echo $error; ?></p>

                                    <?php endforeach ?>

                                </div>

                        <?php endif ?>
                        
     
            <div class="form-group col-md-4">
                <label for="dProd">Product</label>
                <input type="text" name="dProd" id="dProd" value="" class="form-control" required>
            </div>
            
               
            <div class="form-group col-md-2">
                <label for="dsubcategory">Subcategory</label>
                    <select class="form-control" id="dsubcategory" name="dsubcategory">
                        <option>Select subcategory</option>
                        <?php 
                        $subQry = "SELECT subcategories FROM subcategories";
                        $subRst = $conn->query($subQry);
                        while($row=mysqli_fetch_array($subRst)){?>
                        <option><?php echo $row['subcategories'];?></option>
                        <?php }?>
                    </select>
            </div>
                          
            <div class="form-group col-md-2">
                <label for="dQty">Quantity</label>
                <input type="number" name="dQty" id="dQty" value="" class="form-control" min="0" required>
            </div>
                        
            <div class="form-group col-md-2">
                <label for="dlistPrice">List Price <span>(&#x20A6;)</span></label>
                <input type="text" name="dlistPrice" id="dlistPrice" value="" class="form-control" required>
            </div>
                        
             <div class="form-group col-md-2">
                <label for="czOurPrice">Our Price <span>(&#x20A6;)</span></label>
                <input type="text" name="dOurPrice" id="dOurPrice" value="" class="form-control" required>
             </div>
                                                         
              <div class="form-group col-md-6">
                    <label for="ddescription">Description</label>
                    <textarea name="ddescription" id="ddescription" cols="65" rows="10" value=""></textarea>
                    <input type="submit" name="addDSz" value="Add Product" class="btn btn-default" style="background:#232f3e; color:white; margin-top:10px;" required>
              </div>  
                                    
             <div class="form-group col-md-4">
                <label for="image">Image</label>
                <input type="file" name="image"  id="image" class="form-control">
            </div>                     
                                                                  
           </form>
        </div>

    </div>
   
    

    <script>
      document.querySelector('.alert').style.display = 'block';

      setTimeout(function(){
        document.querySelector('.alert').style.display = 'none';
      },5000);
    </script>

<?php
include("includes/footer.php");
?>

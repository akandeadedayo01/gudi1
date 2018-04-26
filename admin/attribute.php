<?php
include("../core/connect.php");
include("../functions.php");

$pdtID = @escape((int)$_GET['attr']);


$errors = array();
$size  = array();


//Insert for Colors and Sizes

if(isset($_POST['addCSA'])){
    
    $csaPdt    =  escape($_POST['pdt']);
    $csaColor  =  escape($_POST['color']);
    $csaSize   =  escape($_POST['size']);
    $csaQty    =  escape($_POST['qty']);
    $csaCSA    =  $csaColor . "-" . $csaSize;
    
    $image = $_FILES['image']['name'];
    $tmp_image = $_FILES['image']['tmp_name'];
    $imgSize = $_FILES['image']['size'];
    
    $chkqry = "SELECT * FROM colorsizes";
    $chkrst = $conn->query($chkqry);
    
    $cassize = "";
    
    while($chkrow = mysqli_fetch_array($chkrst)){
        
        $pdtid = $chkrow['pdt'];
        $csacol = $chkrow['color'];
        $cassize = $chkrow['size'];       
    }
    
    if($csaSize ==  $cassize && $csaPdt == $pdtid && $csaColor == $csacol){
        
        $errors[].= "Duplicate! Product size exist in the database!";
        
    }
    
    
    else if($imgSize > 15728640){
        
         $errors[].= "Image exceeds 15MB Limit";
    }
    
   
  
    else{
        
        $imageExt = explode(".", $image);
        $imageExtension =  $imageExt[1];
        
        if($imageExtension == 'PNG' || $imageExtension == 'png' || $imageExtension == 'JPG' || $imageExtension == 'jpg' || $imageExtension == 'GIF' || $imageExtension == 'gif'){
        
        $image = $image.rand(1, 1000000).time().".".$imageExtension;
    
        $csaSql = "INSERT INTO colorsizes(color, size, attribute, quantity, pdt, image) VALUES ('$csaColor', '$csaSize', '$csaCSA', '$csaQty', '$csaPdt', '$image')";
    
        
      if(mysqli_query($conn, $csaSql)){
            
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




if(isset($_POST['addAC'])){
    
    $caPdt = escape($_POST['pdtc']);
    $caColor = escape($_POST['colorc']);
    $caQty = escape($_POST['fqtyc']);

    $image = $_FILES['image']['name'];
    $tmp_image = $_FILES['image']['tmp_name'];
    $imgSize = $_FILES['image']['size'];
    
    
    if($imgSize > 15728640){
        
        $errors[].= "Image exceeds 15MB Limit";
    }
    
    
    else{
        
    $imageExt = explode(".", $image);
    $imageExtension =  $imageExt[1];
         
    if($imageExtension == 'PNG' || $imageExtension == 'png' || $imageExtension == 'JPG' || $imageExtension == 'jpg' || $imageExtension == 'GIF' || $imageExtension == 'gif'){
        
    $image = $image.rand(1, 1000000).time().".".$imageExtension;
    
    $caSql = "INSERT INTO colors(color, quantity, pdt, image) VALUES ('$caColor', '$caQty', '$caPdt', '$image')";
    
     if(mysqli_query($conn, $caSql)){
            
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


    
    if(isset($_POST['addD'])){
    
    $pdPdt = escape($_POST['pdtd']);
    $pdDefault = escape($_POST['pdtAttr']);
    $pdQty = escape($_POST['fqtyAttr']);

    $image = $_FILES['image']['name'];
    $tmp_image = $_FILES['image']['tmp_name'];
    $imgSize = $_FILES['image']['size'];
        
    if($imgSize > 15728640){
        
        $errors[].= "Image exceeds 15MB Limit";
    }
    
    
    else {
        
     $imageExt = explode(".", $image);
     $imageExtension =  $imageExt[1];
         
    if($imageExtension == 'PNG' || $imageExtension == 'png' || $imageExtension == 'JPG' || $imageExtension == 'jpg' || $imageExtension == 'GIF' || $imageExtension == 'gif'){
        
    $image = $image.rand(1, 1000000).time().".".$imageExtension;
        
        
    $pdSql = "INSERT INTO pdtdefaults(product, quantity, pdtID, image) VALUES ('$pdDefault', '$pdQty', '$pdPdt', '$image')";
    
     if(mysqli_query($conn, $pdSql)){
            
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




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin|Gudi</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="style.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

  </head>
  
  <body>
    <nav class="navbar navbar-default" style="margin-bottom:0px; color: #cccccc; background-color:#232f3e; border-bottom:2px solid orange;">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar1" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href="#">Admin Panel</a>
        </div>
        <div id="navbar1" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="category.php">Categories</a></li>
            <li><a href="subcategory.php">Subcategories</a></li>
            <li class="active"><a href="product.php">Products</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    
     <header style="background-color: #F6F6F6; margin-bottom:15px;">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
              <h2><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Administrator <small style="color: #232f3e;">Gudi<span style="color:orange;"> Gudi</span></small></h2>
          </div>
        </div>

      </div>
    </header>
    
    
    <div class="container">
        <div class="row">
             <ol class="breadcrumb">
                <li>Dashboard</li>
                <li  style="color:#232f3e;">Categories</li>
                <li  style="color:#232f3e;">Products</li>
                <li  class="active" style="color:#232f3e;">Product Attributes</li>
            </ol>
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
                <label for="pdtID"><span>Product ID</span></label>
                <input type="text" name="pdtc" id="pdtID" value="<?= $pdtID; ?>" class="form-control">
            </div>
                         
            <div class="form-group col-md-4">
                <label for="colorc"><span>Color</span></label>
                <input type="text" name="colorc" id="colorc" value="" class="form-control" required>
            </div>
                          
            <div class="form-group col-md-2">
                <label for="fqtyc">Quantity</label>
                <input type="number" name="fqtyc" id="fqtyc" value="" class="form-control" min="0" required>
            </div>
            
            <div class="form-group col-md-4">
                <label for="image">Image</label>
                <input type="file" name="image"  id="image" class="form-control">
            </div>             
                           
             <button class="btn btn-default pull-right" type="submit" name="addAC" style="color: #ffffff; background-color: #232f3e; font-size: 12px; margin-right:14px;">Add Attributes</button>
             
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
    
    
    <script>

      document.querySelector('.alert').style.display = 'block';

      setTimeout(function(){
        document.querySelector('.alert').style.display = 'none';
      },5000);

    </script>

  
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/script.js"></script>
    
    
</body>
</html>
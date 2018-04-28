<?php
include("../core/connect.php");
include("../functions.php");


$csql = "SELECT * FROM categories ORDER BY categories";
$crst = $conn->query($csql);

//sub metrics
 $count =  "SELECT COUNT(*) AS total FROM subcategories";
 $cCount =   $conn->query($count);
 while ($crow = mysqli_fetch_array($cCount)){$subCount = $crow['total'];}

 $catcnt =  "SELECT COUNT(DISTINCT categoryID) AS catID FROM subcategories";
 $catCount =   $conn->query($catcnt);
 while ($catrow = mysqli_fetch_array($catCount)){$subCateg = $catrow['catID'];}

 $catmx =  "SELECT categoryID, COUNT(categoryID) as max FROM subcategories GROUP BY categoryID ORDER BY max DESC LIMIT 1";
 $catCountmx =   $conn->query($catmx);
 while ($catmx = mysqli_fetch_array($catCountmx)){$subCategmx = $catmx['max'];}
 
 $catmn =  "SELECT categoryID, COUNT(categoryID) as min FROM subcategories GROUP BY categoryID ORDER BY min ASC LIMIT 1";
 $catCountmn =   $conn->query($catmn);
 while ($catmn = mysqli_fetch_array($catCountmn)){$subCategmn = $catmn['min'];}



$errors = array();

//Editing a brand

     if(isset($_GET['edit']) && !empty($_GET['edit'])){
        $editID = escape((int)$_GET['edit']);
        $esql = "SELECT * FROM subcategories WHERE id='$editID'";
        $erst = $conn->query($esql);
        $ecat = mysqli_fetch_array($erst);
    }

//Add Subcategories

if(isset($_POST['addSub'])){
    
    $subCat = escape($_POST['sub']);
    $category = escape($_POST['category']);
    $cid = "";
    
    
    $cqry = "SELECT id FROM categories WHERE categories = '$category'";
    $cqrst = $conn->query($cqry);
    while($rst=mysqli_fetch_array($cqrst)){
        $cid = $rst['id'];
    }
    
    if($category == "Select category"){
        $errors[].= "Enter a valid category!";
    }
    
     //Check for duplicate entries
    $sdup = "SELECT * FROM subcategories WHERE subcategories = '$subCat'";
        if(isset($_GET['edit'])){
             $sdup = "SELECT * FROM subcategories WHERE subcategories = '$subcategory' AND id !='$editID'";
        }
    $srst= $conn->query($sdup);
    $result = mysqli_num_rows($srst);
        
    if($result>0){
    $errors[].= "Duplicate Entry!";
    }
    
    
    else{
        
        $scat = "INSERT INTO subcategories(subcategories,categoryID) VALUES('$subCat','$cid')";
        $srst = $conn->query($scat);
        $errors[].= "Record Inserted Successfully!";
//         header('Location: subcategory.php');
                 
        }
   
    }


//Deleting from category

    if(isset($_GET['delete']) && !empty($_GET['delete'])){
        $delete = escape((int)$_GET['delete']);
        $dsql = "DELETE FROM subcategories WHERE id='$delete'";
        $drst = $conn->query($dsql);
         $errors[].= "Record Deleted!";
        header('Location: subcategory.php');
    }



//Record Update
        
        if(isset($_POST['editSub'])){
           
            $subCat = escape($_POST['sub']);
            $category = escape($_POST['category']);
            $subID = escape($_POST['scatID']);
            $cid = "";
          
            $cqry = "SELECT id FROM categories WHERE categories = '$category'";
            $cqrst = $conn->query($cqry);
            while($rst=mysqli_fetch_array($cqrst)){
                $cid = $rst['id'];
            }
            
            $scate = "UPDATE subcategories SET subcategories = '$subCat', categoryID = '$cid' WHERE id='$subID'";
            $rscate = $conn->query($scate);
            
             $errors[].= "Record Updated!";
             header('Location: subcategory.php');
            
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
            <li class="active"><a href="subcategory.php">Subcategories</a></li>
            <li><a href="product.php">Products</a></li>
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
                <li><a href="#">Dashboard</a></li>
                <li  style="color:#232f3e;">Categories</li>
                <li class="active" style="color:#232f3e;">Subcategories</li>
            </ol>
        </div>
    </div>
    
    
    <div class="container">
        <div class="row">
            <div class="col-md-3">
              
                <div class="list-group">
                <a href="#" class="list-group-item active" style="background-color:#232f3e;">
                  <span class="glyphicon glyphicon-th" aria-hidden="true" style="color:white;"></span>  Subcategories Metrics
                </a>
                  
                   <a href="#" class="list-group-item" style="color:#232f3e;"><span class="glyphicon glyphicon-th" aria-hidden="true" style="color:#232f3e;"></span> Subcategories<span class="badge" style="background:#232f3e;"><?php echo $subCount; ?></span></a>
                    
                       <a href="#" class="list-group-item" style="color:#232f3e;"><span class="glyphicon glyphicon-th-list" aria-hidden="true" style="color:#232f3e;"></span> Categories <span class="badge" style="background:#232f3e;"><?php echo $subCateg; ?></span></a>
                     
                      <a href="#" class="list-group-item" style="color:#232f3e;"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true" style="color:#232f3e;"></span> Max Category <span class="badge" style="background:#232f3e;"><?php echo $subCategmx; ?></span></a>
                        
                         <a href="#" class="list-group-item" style="color:#232f3e;"><span class="glyphicon glyphicon-arrow-down" aria-hidden="true" style="color:#232f3e;"></span> Min Category <span class="badge" style="background:#232f3e;"><?php echo $subCategmn; ?></span></a>
                 </div>
              
               <div class="well" style="background-color: #F6F6F6;">
                   <form action="subcategory.php" method="POST">
                         <?php if(count($errors)>0): ?>

                                <div class="alert alert-success" style="text-align:center; display:none;">
                                  
                                  <?php foreach ($errors as $error): ?>

                                 <p><?php echo $error; ?></p>

                                    <?php endforeach ?>

                                </div>

                        <?php endif ?>
                          <h4 class="text-center" style="color: #232f3e;"><strong>Subcategories</strong></h4><br>
                        <div class="input-group input-group-sm">
                              <?php
                                    $subValue = "";
                                    $subID = "";

                                    if(isset($_GET['edit'])){
                                        $subValue = $ecat['subcategories'];
                                        $subID = $ecat['id'];
                                    }else{
                                        if(isset($_POST['sub'])){
                                        $subValue = escape($_POST['sub']);
                                    }
                                }
                            ?>
                         
                        
                   
        
                                <span class="input-group-addon" id="sizing-addon3"> <i class="glyphicon glyphicon-th" data-toggle="tooltip" title="USERNAME - This is a unique identity assigned to you.
                                This is usually formed from your names"></i> </span>
                          <input type="text" class="form-control" name="sub" placeholder="Subcategory" aria-describedby="sizing-addon3" value="<?php echo $subValue;?>" required>
                        </div><br>
                        
                   
                        
                        
                       
                        <div class="input-group input-group-sm">
                             <span class="input-group-addon" id="sizing-addon3"><i class="glyphicon glyphicon-th-list"></i></span>
                              <select class="form-control" id="gender" name="category">
                                <option>Select category</option>
                                <?php while($row=mysqli_fetch_array($crst)){?>
                                <option><?php echo $row['categories'];?></option>
                                <?php }?>
                              </select>
                        </div><br>

                        <div class="form-group">
                          
                            <?php if(isset($_GET['edit'])){ ?>
                                  <button class="btn btn-default btn-block" type="submit" name="editSub" style="color: #ffffff; background-color: #232f3e; font-size: 12px;">Edit Category</button>
                                  <a href="subcategory.php" class="btn btn-default btn-block">Cancel</a>
                                   <br>
                                   
                                      <input type="hidden" class="form-control" name="scatID" placeholder="Subcategory" aria-describedby="sizing-addon3" value="<?php echo $subID;?>">

                                  
                            <?php } else{?>
                              <button class="btn btn-default btn-block" type="submit" name="addSub" style="color: #ffffff; background-color: #232f3e; font-size: 12px;">Add Category</button>
                             <?php } ?>

                        </div>
                   </form>
               </div>  
            </div>
            
            <div class="col-md-9">
                <div class="panel panel-default">
                  <div class="panel-heading" style="background:#232f3e; color:white;">
                    <h3 class="panel-title">Subcategories</h3>
                  </div>
                      <div class="panel-body">
                        <div class="table-responsive">
                         <table class="table table-striped table-hover">
                                  <tr>
                                     <th>ID</th>
                                     <th>Subcategories</th>
                                     <th>Categories</th>
                                     <th>Actions</th>
                                  </tr>
                                    
                                    <?php
                                        $jqry = "SELECT c.categories as categories, s.subcategories as subcategories, s.id  as sid, s.id as id FROM categories c, subcategories s WHERE c.id = s.categoryID ORDER by s.id DESC";
                                        $rstmt = $conn->query($jqry);
                             
                                          while($ret = mysqli_fetch_array($rstmt)){
                                               $rcat = $ret['categories'];
                                               $rscat = $ret['subcategories'];
                                               $rsid = $ret['sid'];
                                               $rid = $ret['id'];
                                            ?>
                                     <tr>
                                         <td><?php echo $rsid;?></td>
                                         <td><?php echo $rscat;?></td>
                                         <td><?php echo $rcat;?></td>
                                         <td><a href="subcategory.php?edit=<?php echo $rid;?>" class="btn btn-xs btn-primary" style="background:#232f3e;" data-toggle="tooltip" title="Edit"><span class="glyphicon glyphicon-edit" style="color:white;"></span></a>
                                         <a href="subcategory.php?delete=<?php echo $rid;?>" class="btn btn-xs btn-primary" style="background:#232f3e;" data-toggle="tooltip" title="Delete"><span class="glyphicon glyphicon-trash" style="color:white;"></span></a>
                                         </td>
                                     </tr>

                                <?php } ?>

                              </table>
                              </div>
                      </div>
                
            </div>
        </div>
    </div>
      </div>
    
    
    
    <footer id="footer">
    
        <p>Copyright PoochFaces. &copy; 2018</p>

    </footer>
   
  <script>

  document.querySelector('.alert').style.display = 'block';
  setTimeout(function(){
    document.querySelector('.alert').style.display = 'none';
  },2000);

  </script>
 
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/script.js"></script>
   
  </body>
  
</html>


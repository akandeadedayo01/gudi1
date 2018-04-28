<?php
    
include("../core/connect.php");
include("../functions.php");

//Categories Queries
$cqry = "SELECT * FROM categories";
$crst = $conn->query($cqry);

 $count =  "SELECT COUNT(*) AS total FROM categories";
 $cCount =   $conn->query($count);
 while ($crow = mysqli_fetch_array($cCount)){$catCount = $crow['total'];}
    
$errors = array();


//Editing a brand

     if(isset($_GET['edit']) && !empty($_GET['edit'])){
        $editID = escape((int)$_GET['edit']);
        $esql = "SELECT * FROM categories WHERE id='$editID'";
        $erst = $conn->query($esql);
        $ecat = mysqli_fetch_array($erst);
    }


//Adding to Category

if(isset($_POST['addCat'])){
   
    $category = escape($_POST['cName']);
    
    //Validations
    if($_POST['cName']==""){  
        $errors[].= "Enter a valid category!";
    }
    
    //Check for duplicate entries
    $cdup = "SELECT * FROM categories WHERE categories = '$category'";
        if(isset($_GET['edit'])){
             $cdup = "SELECT * FROM categories WHERE categories = '$category' AND id !='$editID'";
        }
    $rst= $conn->query($cdup);
    $result = mysqli_num_rows($rst);
        
    if($result>0){
    $errors[].= "Duplicate Entry!";
    }
    else{
    
    //Insert Record into the database.
    
    $sql = "INSERT INTO categories(categories) VALUES ('$category')";
      if(isset($_GET['edit'])){
         $sql = "UPDATE categories SET categories = '$category' WHERE id='$editID'";
    }  
    $rsql = $conn->query($sql);

    header('Location: category.php');
        $errors[].= "Record Inserted Successfully!";
         header('Location: category.php');
    
    }
    
    
}



//Deleting from category

    if(isset($_GET['delete']) && !empty($_GET['delete'])){
        $delete = escape((int)$_GET['delete']);
        $dsql = "DELETE FROM categories WHERE id='$delete'";
        $drst = $conn->query($dsql);
        header('Location: category.php');
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
            <li class="active"><a href="category.php">Categories</a></li>
            <li><a href="subcategory.php">Subcategories</a></li>
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
                <li class="active" style="color:#232f3e;">Categories</li>
            </ol>
        </div>
    </div>
    
    
    
  <div class="container">
      <div class="row">
          <div class="col-md-3">
            
               <div class="list-group">
                    <a href="#" class="list-group-item active" style="background-color:#232f3e;">
                      <span class="glyphicon glyphicon-th-list" aria-hidden="true" style="color:white;"></span>  Categories Metrics
                    </a>
                    <a href="#" class="list-group-item" style="background-color:#F6F6F6; color:#232f3e;"><span class="glyphicon glyphicon-th" aria-hidden="true" style="color:#232f3e;"></span> Categories <span class="badge" style="background:#232f3e;"><?php echo $catCount;?></span></a>
                </div>
            
            
             <div class="well" style="background-color: #F6F6F6;">
                 <form method="POST" action="category.php<?php echo ((isset($_GET['edit']))?'?edit='.$editID:'');?>">
                      
                 
                      <?php if(count($errors)>0): ?>

                                <div class="alert alert-success" style="text-align:center; display:none;">
                                  
                                  <?php foreach ($errors as $error): ?>

                                 <p><?php echo $error; ?></p>

                                    <?php endforeach ?>

                                </div>

                        <?php endif ?>
                        
              
             <h4 class="text-center" style="color: #232f3e;">Product<strong> Categories</strong></h4><br>
                 
                <div class="input-group input-group-sm">
                     <?php
                            $catValue = "";
                        
                            if(isset($_GET['edit'])){
                                $catValue = $ecat['categories'];
                            }else{
                                if(isset($_POST['cName'])){
                                $catValue = escape($_POST['cName']);
                            }
                            }
                    ?>
                  <span class="input-group-addon" id="sizing-addon3"> <i class="glyphicon glyphicon-th-list" data-toggle="tooltip" title="USERNAME - This is a unique identity assigned to you.
                        This is usually formed from your names"></i> </span>
                  <input type="text" class="form-control" name="cName" placeholder="Category Name" aria-describedby="sizing-addon3" value="<?php echo $catValue;?>" required>
                </div><br>

            
                <div class="form-group">
                    <button class="btn btn-default btn-block" type="submit" name="addCat" style="color: #ffffff; background-color: #232f3e; font-size: 12px;"><?=((isset($_GET['edit']))?'Edit Category':'Add Category');?></button>
                    
                    <?php if(isset($_GET['edit'])){ ?>
                          <a href="category.php" class="btn btn-default btn-block">Cancel</a>
                    <?php } ?>
                    
                </div>
            </form>
             </div>
             
              
          </div>
          
          <div class="col-md-9">
             <div class="panel panel-default">
                  <div class="panel-heading" style="background:#232f3e; color:white;">
                    <h3 class="panel-title">Categories</h3>
                  </div>
                      <div class="panel-body">
                        <div class="table-responsive">
                         <table class="table table-striped table-hover">
                                  <tr>
                                     <th>ID</th>
                                     <th>Categories</th>
                                     <th>Actions</th>
                                  </tr>
                                    
                                    <?php
                             
                                    while($crow = mysqli_fetch_array($crst)){
                                        
                                        $cid = $crow['id'];
                                        $ccat = $crow['categories'];
                                        
                                    ?>

                                     <tr>
                                         <td><?php echo $cid?></td>
                                         <td><?php echo $ccat?></td>
                                         <td><a href="category.php?edit=<?php echo $cid?>" class="btn btn-xs btn-primary" style="background:#232f3e;" data-toggle="tooltip" title="Edit"><span class="glyphicon glyphicon-edit" style="color:white;"></span></a>
                                         <a href="category.php?delete=<?php echo $cid?>" class="btn btn-xs btn-primary" style="background:#232f3e;" data-toggle="tooltip" title="Delete"><span class="glyphicon glyphicon-trash" style="color:white;"></span></a>
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


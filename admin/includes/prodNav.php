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
      <div class="container"  style="padding-left:20px;">
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
    
     <header style="background-color: #F6F6F6; margin-bottom:15px; padding-left:20px;">
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
             <ol class="breadcrumb" style="padding-left:30px;">
                <li><a href="#">Dashboard</a></li>
                <li style="color:#232f3e;">Categories</li>
                <li style="color:#232f3e;">Subcategories</li>
                <li class="active" style="color:#232f3e;">Products</li>
            </ol>
        </div>
    </div>
    
   
  
 

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
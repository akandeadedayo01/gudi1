<?php
    $cquery = "SELECT * FROM categories";
    $crst = $conn->query($cquery);
?>

<nav class="navbar navbar-default">
            <div class="container-fluid">
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php" style="margin-left:60px;padding-top:10px;padding-bottom:10px;"><i class="fas fa-truck"></i> Gudi<span>Gudi</span></a>
                  </div>
             
                  <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav nav">
                        <?php while ($row = mysqli_fetch_array($crst)){
                                $id = $row['id'];
                                $category = $row['categories'];
                        $scqry = "SELECT * FROM subcategories WHERE categoryID='$id'";
                        $srst = $conn->query($scqry);
                        ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $category;?> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <?php while($sub = mysqli_fetch_array($srst)){?>
                                    <li><a href="subcategory.php?sub=<?=$sub['id'];?>"><?php echo $sub['subcategories']?></a></li>
                                <?php }?>
                            </ul>
                        </li> 
                    <?php }?>
                    </ul>
                  </div><!--/.nav-collapse -->
            </div>
</nav>
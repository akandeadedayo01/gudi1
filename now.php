 <div class="container-fluid" style="margin-left:15px; margin-right:15px;">
            <div class="row">

                <div class="col-md-3">
                    <div class="well" id="guddies">
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="well" id="guddies">

                            <div class="media-left">
                                <img src="images/emerald.jpg" alt="jewelries" class="media-left img-thumb">
                            </div>

                            <div class="media-body" style="line-height:0.75em;">
                                <h4 class="media-heading">Jewelries</h4>
                                <p class="list-price text-danger">List Price <s>&#8358;599.99</s></p>
                                <p class="price">Our Price &#x20A6;499.99<span style="color:maroon"> - Save &#8358;100</span></p><br>
                                <button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#details-1" style="background:orange">View Details</button>
                            </div>

                        </div>
                        
                    </div>
                    

                </div>
            </div>
        </div>
        
       
      
     
    
  <div class="container">
    <div class="row">
        <h2 class="text-center">Today's Guddies</h2>
            <?php while($row = mysqli_fetch_array($drst)){ 
                $title = $row['product'];
                $image = $row['image'];
                $listPrice = $row['list_price'];
                $ourPrice = $row['our_price'];
            ?>
        <div class="col-md-3">
            <div class="well">
                <h4><center><?php echo $title;?></center></h4> 
                <img src="<?php echo $image;?>" alt="Party Cup" class="img-thumb">
                <p class="list-price text-danger">List Price <s>&#8358;<?php echo $listPrice;?></s></p>
                <p class="price">Our Price &#x20A6;<?php echo $ourPrice;?></p>
                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#details-1">Details</button>
            </div>
        </div>
        <?php }?>
    </div>
 </div> 

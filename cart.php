<?php
include("core/connect.php");
include("includes/head.php");
include("includes/navigation.php");
include("functions.php");

?>









<div class="container-fluid">
    <div class="row">
        <div class="col-md-9">
            <center><h2>Product Purchase</h2></center>
            <div class="panel panel-default" style="margin-left:10px;">
                  <div class="panel-heading" style="background:#232f3e; color:white;">
                    <h3 class="panel-title">Shopping Cart</h3>
                  </div>
                      <div class="panel-body">
                        <div class="table-responsive">
                         <table class="table table-striped table-hover">
                                  <tr>
                                     <th>Items (2)</th>
                                     <th>Description</th>
                                     <th>Quantity</th>
                                     <th>Total</th>
                                  </tr>
                                    
                                  <tr>
                                      <td><img src="images/Brace2.jpg" alt="" style="height:150px;"></td>
                                      <td>Test Test Test</td>
                                      <td> <input type="number" name="qty" id="qty" value="" class="form-control" min="0" style="width:80px;"></td>
                                      <td><?= money(150000)?></td>
                                  </tr>

                            </table>
                         </div>
                      </div>
            </div>
            
        </div>
        
        <div class="col-md-3">
           <center><h2>Checkout Details</h2></center>
            <div class="well" style="margin-right:10px;">
                
            </div>
        </div>
    </div>
</div>
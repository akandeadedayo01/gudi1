<div class="modal fade" tabindex="-1" role="dialog" id="details-1" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="center-block">
                                        <img src="images/Party_Cups.jpg" alt="" class="details img-responsive">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <h4>Details</h4>
                                    <p>These are party cups for soft drinks with friends. Get a pack while offer lasts</p>
                                </hr>
                                    <p>Price:&#x20A6;499.99</p>
                                    <p>Brand: Eleganza</p>

                                    <form action="add_cart.php" method="post">
                                        <div class="form-group">
                                            <div class="col-xs-">
                                                <label for="quantity">Quantity</label>
                                                <input type="text" class="form-control" id="quantity" name="quantity">
                                            </div>
                                            <p>Available: 3</p>
                                        </div>
                                            <div class="form-group">
                                                <label for="size">Size:</label>
                                                <select name="size" id="size" class="form-control">
                                                    <option value=""></option>
                                                    <option value="5">5</option>
                                                    <option value="4">4</option>
                                                    <option value="3">3</option>
                                                    <option value="2">2</option>
                                                </select>

                                            </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-warning"><span class= "glyphicon glyphicon-shopping-cart" style="color:white;"></span> Add To Cart</button>
                    </div>
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

<?php

    function escape($injections){
        return htmlentities($injections, ENT_QUOTES, "UTF-8");
    }


    function money($price){
      return '&#x20A6;'. number_format($price,2);
    }

    
    $subQry = "SELECT subcategories FROM subcategories";
    $subRst = $conn->query($subQry);




//Product with color attribute - Database Insert

    function pdtCol(){
        
        global $conn;
        $colQry = "SELECT Max(cid) AS cid FROM colors";
        $colRst = $conn->query($colQry);
        
        while($colRow = mysqli_fetch_array($colRst)){
            
             $cid =  $colRow['cid'];
        }
            ;
        
        
        $colQry2 = "SELECT * FROM colors WHERE cid='$cid'";
        $colRst2 = $conn->query($colQry2);
        
        
        while($colRow2 = mysqli_fetch_array($colRst2)){
            
             $attribute =  $colRow2['attribute'];
             $quantity =  $colRow2['quantity'];
             $brand =  $colRow2['brand'];
             $subID =  $colRow2['subID'];
             $productCode =  $colRow2['productCode'];
             $list_price =  $colRow2['list_price'];
             $our_price =  $colRow2['our_price'];
             $description =  $colRow2['description'];
             $image =  $colRow2['image'];
        }
        
        
        $colQry3 = "INSERT INTO products (product, attribute, quantity, subID, productCode, description, list_price, our_price, image) VALUES ('$brand','$attribute', '$quantity', '$subID', '$productCode', '$description','$list_price', '$our_price', '$image')";
        
        $colRst3 = $conn->query($colQry3);
                
    }



    //Product with color/sizes attribute - Database Insert

    function pdtCSz(){
        
        global $conn;
        $csQry = "SELECT Max(csID) AS csID FROM colorsizes";
        $csRst = $conn->query($csQry);
        
        while($colRow = mysqli_fetch_array($csRst)){
            
             $csID =  $colRow['csID'];
        }
            
        
        $csQry2 = "SELECT * FROM colorsizes WHERE csID='$csID'";
        $csRst2 = $conn->query($csQry2);
        
        
        while($colRow2 = mysqli_fetch_array($csRst2)){
            
             $attribute =  $colRow2['attribute'];
             $quantity =  $colRow2['quantity'];
             $brand =  $colRow2['brand'];
             $subID =  $colRow2['subID'];
             $productCode =  $colRow2['productCode'];
             $list_price =  $colRow2['list_price'];
             $our_price =  $colRow2['our_price'];
             $description =  $colRow2['description'];
             $image =  $colRow2['image'];
        }
        
        
        $colQry3 = "INSERT INTO products (product, attribute, quantity, subID, productCode, description, list_price, our_price, image) VALUES ('$brand','$attribute', '$quantity', '$subID', '$productCode', '$description','$list_price', '$our_price', '$image')";
        
        $colRst3 = $conn->query($colQry3);
                
    }


    //Default Product - Database Insert

    function pdtDf(){
        
        global $conn;
        $dfQry = "SELECT Max(dID) AS dID FROM pdtdefaults";
        $dfRst = $conn->query($dfQry);
        
        while($colRow = mysqli_fetch_array($dfRst)){
            
             $dID =  $colRow['dID'];
        }
            
        
        $dfQry2 = "SELECT * FROM pdtdefaults WHERE dID='$dID'";
        $dfRst2 = $conn->query($dfQry2);
        
        
        while($colRow2 = mysqli_fetch_array($dfRst2)){
            
             $attribute =  $colRow2['attribute'];
             $quantity =  $colRow2['quantity'];
             $brand =  $colRow2['brand'];
             $subID =  $colRow2['subID'];
             $productCode =  $colRow2['productCode'];
             $list_price =  $colRow2['list_price'];
             $our_price =  $colRow2['our_price'];
             $description =  $colRow2['description'];
             $image =  $colRow2['image'];
        }
        
        
        $colQry3 = "INSERT INTO products (product, attribute, quantity, subID, productCode, description, list_price, our_price, image) VALUES ('$brand','$attribute', '$quantity', '$subID', '$productCode', '$description','$list_price', '$our_price', '$image')";
        
        $colRst3 = $conn->query($colQry3);
                
    }





    

?>
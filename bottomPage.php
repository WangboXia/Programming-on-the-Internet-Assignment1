<?php
  session_start();
  if ($_REQUEST["clearBtn"] == 1) {
    unset($_SESSION["currentProduct"]);
    unset($_SESSION['showCheckout']);
    unset($_SESSION['goods']);
  }
  if(isset($_SESSION["currentProduct"]) && $_REQUEST["number"] > 0){
    if (!isset($_SESSION["goods"])) { 
      $id = $_SESSION["currentProduct"][product_id];
      $_SESSION["goods"][$id][product_id] = $_SESSION["currentProduct"][product_id];
      $_SESSION["goods"][$id][product_name] = $_SESSION["currentProduct"][product_name];
      $_SESSION["goods"][$id][unit_price] = $_SESSION["currentProduct"][unit_price];
      $_SESSION["goods"][$id][unit_quantity] = $_SESSION["currentProduct"][unit_quantity];
      $_SESSION["goods"][$id][quantity] = $_REQUEST["number"];
    }
    else
    {
      $serchid = $_SESSION["currentProduct"][product_id];
      $find = 0;
      foreach ($_SESSION["goods"] as $item) {
        if ($item["product_id"] == $serchid) {    
          $_SESSION["goods"][$serchid][quantity] = $_REQUEST["number"];
          $t = $_SESSION["goods"][$serchid][quantity];
          $find = 1;
          break;
        }

      }

      if ($find == 0) {
        $id = $_SESSION["currentProduct"][product_id];  
        $_SESSION["goods"][$id][product_id] = $_SESSION["currentProduct"][product_id];
        $_SESSION["goods"][$id][product_name] = $_SESSION["currentProduct"][product_name];
        $_SESSION["goods"][$id][unit_price] = $_SESSION["currentProduct"][unit_price];
        $_SESSION["goods"][$id][unit_quantity] = $_SESSION["currentProduct"][unit_quantity];
        $_SESSION["goods"][$id][quantity] = $_REQUEST["number"];
      }

      $number = 0;
      foreach ($_SESSION["goods"] as $item){
        $number += $item[quantity];
      }
    }
  } 
      $total_number = 0;
      foreach ($_SESSION["goods"] as $item){
        $total_number += $item[quantity];
      }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bottom Right</title>
    <?php 
    echo "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>";
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css\" />";
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"/bottomPage.css\" />";
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"/Index.css\" />";
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
</head>
<body>
  
  <a href="topPage.php?showcheckoutForm=1" target="topPage" class="button" id="errorMessage" style="float:left">Checkout</a>
  
  <a href="bottomPage.php?clearBtn=1" target="bottomPage" class="button button_red" style="float:left">Clear</a>

  <br/>
  <br/>
  <br/>
  <br/>
  
  <div class="row">
    <div class="col-25" >
      <div class="w3-container">
        <h4>Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i><b id='number-itmes'><?php echo $total_number;?></b></span></h4>
          <?php foreach($_SESSION["goods"] as $product){ ?>
            <p><a href="#"><?php echo $product["product_name"];?></a> * <?php echo $product["quantity"];?><span class="price">$<?php echo $product["unit_price"]*$product["quantity"];?></span></p>
          <?php } ?>
          <hr>
          <p>Total Price <span class="price" style="color:black"><b>$
          <?php
            $totalPrice = 0;
            foreach($_SESSION["goods"] as $product)
            {
              $totalPrice += $product["unit_price"]*$product["quantity"];
            }
            echo $totalPrice;
          ?>
          </b></p>
      </div>
    </div>
  </div>

<script>
  document.getElementById("errorMessage").onclick = checkout;
  function checkout() {	
    var number = document.getElementById("number-itmes").innerHTML;
    if (number == 0) 
    {
      window.alert("The shopping cart is empty!");
    }
  }
</script>
</body>
</html>


<?php
include_once('navbar.php');
?>


<body class="bg-dark"; style='color:white;'>
  

 
 <div style='width: 850px; position:relative; align-items: center; margin-left:300px; margin-top:50px;'>
 <h4 style='margin-top:10px;margin-bottom:20px;padding:20px; border-bottom: 2px solid red;text-align:center;'>Your Cart</h4>
 <div style='color:black !important;background-color:#D1D1D1; padding:8px 30px; margin-bottom:10px'>
 <span style='font-weight: bold; width:250px; margin-left: 20px; margin-right:200px;'>Item name</span>
 <span style='font-weight: bold; width:250px;margin-right:200px;' >Price</span>
 <span style='font-weight: bold;width:250px;'>Quantity</span>
</div>

<?php
 $food_quantity = [];
  require_once('../includes/db.inc.php');
  $totalprice = 0;
  $sql = "SELECT * FROM cart WHERE usersId=$_SESSION[userid];";
  $results = mysqli_query($conn, $sql);
  $cartitems = mysqli_fetch_all($results, MYSQLI_ASSOC);
  mysqli_free_result($results);
  for ($x = 0; $x <count($cartitems); $x++) {
    $r = $cartitems[$x]['foodId'];
    if(!isset($food_quantity[$r])){
      $food_quantity[$r] =1;
    }else{
      $food_quantity[$r] +=1;
    }
   
    $totalprice = $totalprice + $cartitems[$x]['foodPrice'];
    $array_name[$x] = $cartitems[$x]['foodName'];
    $array_price[$x] = $cartitems[$x]['foodPrice'];
    $food_foodid[$x] = $cartitems[$x]['foodId'];
    $food_id[$x] = $cartitems[$x]['id'];
  }

  if(isset($_GET["order"])){
    echo "<h2 style='color:green;text-align:center;'>Your Order Has Been Placed!</h2>";
  }
  function map_cart($a, $b, $c, $d){
  $e = $GLOBALS['food_quantity'] ;
  $f = $e[$d];
   echo" <div style='background-color:#D1D1D1; padding:8px 30px; margin-bottom:10px;color:black !important;'>
   <span style='font-weight: bold; display:inline-block;width:285px;margin-left:20px;'>$a</span>
   <span style='font-weight: bold; display:inline-block;width:240px;' >$b</span>
   <span style='font-weight: bold; display:inline-block;width:100px;'>1</span>
   <form method='post' style='display:inline'>
   <input name='id' value=$c  hidden></input>
   <button type='submit' name='removecart' class='btn btn-danger'>Remove</button>
   </form>
  </div>";

  }
  
  if(isset($_POST["removecart"])){
      $id_to_del = $_POST['id'];
    require_once('../includes/db.inc.php');
    $sql = "DELETE FROM cart WHERE id=$id_to_del;";
    if(!mysqli_query($conn, $sql)){
        echo "failed delete";
    }
    header("Refresh:0");
} 
if(count($cartitems)!==0){
  $new_arr = array_map('map_cart',$array_name, $array_price, $food_id, $food_foodid);}
  echo "<h5 style='margin-top:30px;'>Total Bill: BDT $totalprice<h5>";
  
?>
<form method="post"  action='../includes/order.inc.php'>
  <input type="radio" checked="checked" name="pay" id="paycash" value="Cash">
  <label for="paycash"> Pay with Cash</label><br>
  <input type="radio" name="pay" id="paycard" value="Card">
  <label for="paycard"> Pay with Card</label><br>
<button type='submit' name='placeorder' class='btn btn-success'
style = "position:relative; margin-left:700px; margin-top:-60px;"
>Place Order</button>
</form>

</div>
</body>
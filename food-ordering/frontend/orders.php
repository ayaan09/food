<?php
include_once('navbar.php');

?>
 <link rel="stylesheet" href="home.css">
 <div style='width: 850px; position:relative; align-items: center; margin-left:300px; margin-top:80px;'>
 <h4 style='margin-top:30px;margin-bottom:20px; border-bottom: 2px solid red;text-align:center;'>Your Cart</h4>
 <div style='background-color:#D1D1D1; padding:8px 30px; margin-bottom:10px'>
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

  
  function map_cart($a, $b, $c, $d){
  $e = $GLOBALS['food_quantity'] ;
  $f = $e[$d];
   echo" <div style='background-color:#D1D1D1; padding:8px 30px; margin-bottom:10px'>
   <span style='font-weight: bold; display:inline-block;width:285px;margin-left:20px;'>$a</span>
   <span style='font-weight: bold; display:inline-block;width:240px;' >$b</span>
   <span style='font-weight: bold; display:inline-block;width:100px;'>$f</span>
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
  echo "<h5>Total Bill: BDT $totalprice<h5>";
?>


</div>
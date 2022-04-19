<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="menu.css">
    <title></title>
  </head>
  <body class="bg-dark" >

  <?php
include ('navbar.php');
?>


<div style= "width:900px; position:relative; margin-left:350px; margin-top:100px;">
  <?php
  $array_img = array("file.webp", "nanban.webp", "brownies.webp","IcedTea.webp", "SoyTofu.webp",
"seafoodbbq.webp", "beefnoodle.webp","noodlessoup.webp", "prawn.webp"
);
  $array_name = array("Prawn Siu Mai", "Chicken Nanban", "Brownie", "Iced Tea",
"Soy Glazed Tofu", "Seafood BBQ","Special Beef Noodles","Beef Noodles Soup","Fried Cheese Wonton"
);
  $array_price = array(350, 400, 140, 200, 400, 462, 500, 385, 369);
  $food_item_number = array(0, 1, 2, 3, 4, 5, 6, 7, 8);

  function map_to_arr($a, $b, $c, $d){
    $name_u = str_replace(' ','#', $b); 

   echo" <div class='food-item' style='margin:20px; display:inline-block;text-align:center;'>
      <img src= $a alt=''>
      <div style='padding-top:20px; font-size:1.2rem'>$b</div>
      <br>
      <div style='border-bottom: 2px white solid;'></div>
      <div class='price' style='padding:10px;'>BDT $c</div>
      <form method='post'>
      <input type='hidden' name='fooditem' value=$d ></input>
      <input type='hidden' name='price' value=$c ></input>
      <input type='hidden' name='name' value=$name_u ></input>
      <button type='submit' name='addcart' class='btn btn-success'>Add to Cart</button>
      </form>
    </div> ";
  }

 
  require_once('../includes/db.inc.php');
  if(isset($_POST["addcart"])){
    $name = $_POST["name"];
    $price = $_POST["price"];
    $fooditem = $_POST["fooditem"];
    $userId = $_SESSION["userid"];
    // do verification here
    require_once('../includes/functions.inc.php');
    require_once('../includes/db.inc.php');
    addCart($conn, $name, $price, $fooditem, $userId);
} 


  $new_arr = array_map('map_to_arr', $array_img, $array_name, $array_price, $food_item_number);
?>
 </div>
  </body>
</html>

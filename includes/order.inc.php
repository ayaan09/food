<?php
session_start();
require_once('db.inc.php');
$orders="";
$totalprice=0;
$sql = "SELECT * FROM cart WHERE usersId=$_SESSION[userid];";
$results = mysqli_query($conn, $sql);
$cartitems = mysqli_fetch_all($results, MYSQLI_ASSOC);
mysqli_free_result($results);
for ($x = 0; $x <count($cartitems); $x++) {
$food_name = $cartitems[$x]['foodName'];
$food_price = $cartitems[$x]['foodPrice'];
$orders = $orders . "<span style=\"display:block;\"><b><span style=\"min-width:350px;display:inline-block;\">1x $food_name</span><span style=\"min-width:100px;display:inline-block;\">BDT $food_price</span></b><span>";
$totalprice = $totalprice + $cartitems[$x]['foodPrice'];

}
$name =$_SESSION["username"];


if(isset($_POST["placeorder"])){
    $payment_method=$_POST["pay"];
    $mail = 
"<body>
    <div style=\"display: flex;flex-direction: row;flex-wrap: wrap;justify-content: center;align-items: center;width:1180px; background-color:#FAFAFA; height:580px;\">
      <div style=\"margin-left:auto; margin-right: auto; padding:30px;width:600px; background-color:#FFFFFF; height:380px;\"class=\"\">
        <h2>Hello $name,</h2>
        <span style=\"display:block;\">Thank you for Placing an Order!</span><br></br>
        <span style=\"display:block;\">Please Check your Order<span>
          <br></br>
          $orders
          <div style=\"height: 20px;border-bottom:1px solid black\">
            </div><br>
            <span style=\"display:block;\"><b><span style=\"min-width:350px;display:inline-block;\">Total Bill</span><span style=\"min-width:100px;display:inline-block;\">BDT $totalprice</span></b><span>
              <span style=\"display:block;\"><b><span style=\"min-width:350px;display:inline-block;\">Payment Method</span><span style=\"min-width:100px;display:inline-block;\">$payment_method</span></b><span>
      </div>
      <span style=\"position: absolute;bottom:165px;color:gray; font-size:0.7rem;\">If you did not place this order, please report this incident.</span>
    </div>
  </body>";
    require_once('db.inc.php');
    $id_to_del = $_SESSION['userid'];
    $email = $_SESSION['useremail'];
    $headers = "From: Foodnation <foodnation1218@gmail.com>\r\n";
    $headers.= "MIME-Version: 1.0\r\n";
    $headers.= "Content-Type: text/html; charset=ISO-8859-1\r\n";
  
      $mail = mail($email, 'Your Order Has Been Placed!', $mail, $headers);
      if(!$mail){
        header("location: ../frontend/orders.php?email=failed");
      }
      else{
    $sql = "DELETE FROM cart WHERE usersId=$id_to_del;";
    if(!mysqli_query($conn, $sql)){
        echo "failed delete";
    }
    else{
        header("location: ../frontend/orders.php?order=successful");
    }
}
} 
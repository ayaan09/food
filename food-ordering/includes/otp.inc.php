<?php


if(isset($_POST["submit"])){
    
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    // do verification here
    require_once('functions.inc.php');
    require_once('db.inc.php');
    require_once('constants.php');
    $otp = getName(10);
    savetemp($conn, $otp, $name, $email,$username, $password);
    echo "<script>console.log('Debug Objects: " . $otp . "' );</script>";
    
    $emailbody = "
      <body>
        <div style=\"display: flex;flex-direction: row;flex-wrap: wrap;justify-content: center;align-items: center;width:1180px; background-color:#FAFAFA; height:580px;\">
        <div style=\"margin-left:auto; margin-right:auto\"> 
        <span  style=\"display:block; text-align:center; font-size:2rem;font-family:cursive; font-weight:bolder;\">~FOODNATION~</span>
          <div style=\"margin-top:30px; margin-left:auto; margin-right: auto; padding:30px;width:600px; background-color:#FFFFFF; height:380px;\"class=\"\">
            <h2>Hello $name,</h2>
            <span style=\"display:block;\">Thank you for creating a Foodnation account!</span><br></br>
            <span style=\"display:block;\">Your one-time <b>Access Token is:</b><span>
              <div style=\"position: relative; margin-left:110px; margin-top:40px;border:1px black solid;text-align:center;width:200px;
              padding:5px;\" class=\"\">
                <b>$otp</b>
              </div>
              <br></br>
              <span style=\"display:block;\">This one-time <b>Access Token </b>expires if you refresh the signup page<span>
                <br></br><br></br>
                <span style=\"display:block;\">Please copy & paste the Access Token into the input field on the Complete<span>
                <span style=\"display:block;\">Verification page in order to complete your account verification.</span>
          </div>
          <span style=\"color:gray; font-size:0.7rem;\">If you did not attempt to create an account, you may ignore this email or report this incident.</span>
        </div>
        </div>
      </body>
    </html>";
  $headers = "From: Foodnation <foodnation1218@gmail.com>\r\n";
  $headers.= "MIME-Version: 1.0\r\n";
  $headers.= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    mail($email, 'Welcome to Foodnation', $emailbody, $headers);
    header("location: ../frontend/otp.php");
} 
else{
    header("location: ../frontend/signup.php ");
    exit();
}
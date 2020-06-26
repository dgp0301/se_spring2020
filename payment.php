<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>EHR Patient Payment</title>
    <link rel="stylesheet" href="stylesheet.css">
  </head>
  <body>
  <div class="head">
    <h1 id = "header">EHR System</h1>
    <hr>
    <h2 id="header">Enter Payment Details</h2>
  </div>

   <a class="" href="payment.php">New Patient?</a>
   <a href="menu.php">Home</a>
   <?php error_reporting (E_ALL ^ E_NOTICE); ?>
   <div class="">
     <form class=".form" action="payment.php" method="post">
       Enter Patient ID: <input type="text" name="ID" ><br>
       Enter Credit Card: <input type="password" name="CreditCard"><br>
       Enter Amount Due: <input type="number" name="AmountDue"><br>
       Enter Amount Paid: <input type="number" name="AmountPaid" ><br>
       Enter Credit: <input type="text" name="credit"><br>
       Enter Payments: <input type="text" name="payments" ><br>
       <input class=".submit" type="submit" name="">

       <?php
       include_once('dbconnector.php');

       $ID = $_POST['ID'];
       $CreditCard = $_POST["CreditCard"];
       $Due = $_POST["AmountDue"];
       $Paid = $_POST["AmountPaid"];
       $credit = $_POST["credit"];
       $payments = $_POST["payments"];

       $check = "SELECT * FROM `ContactInfo` WHERE `Patient ID` LIKE '$ID'";
       $result = mysqli_query($dbconn, $check);
       if (!$result || mysqli_num_rows($result) <= 0) {
         echo "";
       }
       else {
         if( !empty($ID) || !empty($CreditCard) || !empty($Due) || !empty($Paid) || !empty($credit) || !empty($payments))
         {
           $sql = "INSERT INTO `se_20s_g01_db` . `Payments` (`Patient ID`, `CreditCard`, `AmountDue`, `AmountPaid`, `Credit`, `Payments` ) VALUES ('$ID', '$CreditCard', '$Due', '$Paid', '$credit', '$payments')";
           $result = mysqli_query($dbconn, $sql);
           if ($result) {
             echo "Payment info inserted";
           }
         }
         else {
           echo "information missing";
         }
         $lastVisitPaid = mysqli_query($dbconn,"SELECT `lastVisitPaid` FROM `Visits` WHERE `Patient ID` LIKE '$ID'");
         while($row = mysqli_fetch_array($lastVisitPaid))
         {
          if($row["lastVisitPaid"]==0){
            $lastVisitPaid=0;
            break;
          }
         }
       }
        ?>
     </form>
   </div>
  </body>
</html>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="checkout.css">
<body>
<link rel="stylesheet" type="text/css" href="button.css">
<div class="logout">

	<form action="authenticate.php" method="post">
			<input type="submit" name="" value="Logout">
	</form>

</div>
<?php error_reporting (E_ALL ^ E_NOTICE); ?>
<div class="row">
  <div class="col-75">
    <div class="container">
      <form class=".form" action="checkout.php" method="post">

        <div class="row">
          <div class="col-50">
            <h3>Billing Address</h3>
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="firstname" placeholder="John M. Doe">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" placeholder="john@example.com">
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address" placeholder="542 W. 15th Street">
            <label for="city"><i class="fa fa-institution"></i> City</label>
            <input type="text" id="city" name="city" placeholder="New York">

            <div class="row">
              <div class="col-50">
                <label for="state">State</label>
                <input type="text" id="state" name="state" placeholder="NY">
              </div>
              <div class="col-50">
                <label for="zip">Zip</label>
                <input type="text" id="zip" name="zip" placeholder="10001">
              </div>
            </div>
          </div>

          <div class="col-50">
            <h3>Payment</h3>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" placeholder="John More Doe">
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
            <label for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expmonth" placeholder="September">

            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear" placeholder="2018">
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="352">
              </div>
            </div>
          </div>

        </div>
        
        <input type="submit" value="Run Payment" class="btn" name="">
       <?php
       //adds payment to the database
       include_once('dbconnector.php');

       $ID = $_POST["ID"];
       $CCName = $_POST['cardname'];
       $CCNumber = $_POST["cardnumber"];
       $EMonth = $_POST["expmonth"];
       $EYear = $_POST["expyear"];
       $CVV = $_POST["cvv"];
       $payments = $_POST["payments"];

       $check = "SELECT * FROM `ContactInfo` WHERE `Patient ID` LIKE '$ID'";
       $result = mysqli_query($dbconn, $check);
       if (!$result || mysqli_num_rows($result) <= 0) {
         echo "";
       }
       else {
         if( !empty($ID) || !empty($CreditCard) || !empty($Due) || !empty($Paid) || !empty($credit) || !empty($payments))
         {
           $sql = "INSERT INTO `se_20s_g01_db` . `Payments` (`Patient ID`,`CreditCardName`, `CreditCardNumber`,`ExpMonth`,`ExpYear`,`CVV`, `AmountDue`, `AmountPaid`, `Payments` ) VALUES ('$ID', '$CCName','$CCNumber',
           '$EMonth','$EYear','$CVV', '$Due', '$Paid', '$payments')";
           $result = mysqli_query($dbconn, $sql);
           if ($result) {
             echo "Payment info inserted";
           }
         }
         else {
           echo "information missing";
         }
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
  </div>


  <div class="col-25">
    <div class="container">
      <h4>Charges
        <span class="price" style="color:black">
          <i class="fa fa-shopping-cart"></i>
          
        </span>
      </h4>
      <?
      //Supposed to display items in customers cart and build their amount due not 
      //working unfortunately
            include_once('dbconnector.php');
      $check = "SELECT * FROM `Cart` WHERE `Patient ID` LIKE '$ID'";
       $result = mysqli_query($dbconn, $check);
       if (!$result || mysqli_num_rows($result) <= 0) {
         echo "";
       }
       else {
         $Due = 0;
         while($Precio = mysqli_fetch_array($result)){
         	$Due = $Due + $Precio["Price"];
         }
       }
       if($lastVisitPaid == 0){
      	echo '<p><a href="#">Amount Due for Visit</a> <span class="price">$15</span></p>';
  		}
  		while($Items = mysqli_fetch_array($result)){
  			echo '<p><a href="#">'.$Items["Item"].'</a> <span class="price">$5</span></p>';
  		}
  		?>
      <p><a href="#">Product 1</a> <span class="price">$5</span></p>
      <p><a href="#">Product 2</a> <span class="price">$8</span></p>
      <p><a href="#">Product 3</a> <span class="price">$2</span></p>
      <hr>
      <p>Total <span class="price" style="color:black"><b>$<? echo $Due;?></b></span></p>
    </div>
  </div>
</div>
</body>
</head>
</html>

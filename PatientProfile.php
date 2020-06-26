<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="pp2.css">
<link rel='stylesheet' href='pp1.css'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif}
</style>
<body class="w3-light-grey">
  <link rel="stylesheet" type="text/css" href="button.css">
<div class="logout">

	<form action="authenticate.php" method="post">
			<input type="submit" name="" value="Logout">
	</form>

</div>

<?php
  include('dbconnector.php');
  function get_row($dbconn, $table, $id){
    $query = "SELECT * FROM `$table` WHERE `Patient ID` = $id";
    $result = mysqli_query($dbconn, $query);
    if ($result) {
      $row = mysqli_fetch_assoc($result);
      return $row;
    }
    else {
      return ;
    }
  }

  function displayimage($dbconn, $id)
  {
    $query = "SELECT * FROM `PatientPicture` WHERE `Patient ID` = $id";
    $result = mysqli_query($dbconn, $query);
    if ($row = mysqli_fetch_assoc($result))
    {
      echo '<img style="width:65%" src="data:image;base64, ' .$row['image']. ' "';
    }
  }
  $id = $_GET['PatientID'];

 ?>

<!-- Page Container -->
<div class="w3-content w3-margin-top" style="max-width:1400px;">

  <!-- The Grid -->
  <div class="w3-row-padding">

    <!-- Left Column -->
    <div class="w3-third">

      <div class="w3-white w3-text-grey w3-card-4">
        <div class="w3-display-container">
         <?php displayimage($dbconn, $id); ?><br>
          <div class="w3-display-bottomleft w3-container w3-text-black"><br>
            <h3>
             <br>
           </h3>
          </div>
        </div>
        <div class="w3-container">
          <p><?php
            $demo = get_row($dbconn, "PatientDemographics", $id);
            $conntact = get_row($dbconn, "ContactInfo", $id);
            $health= get_row($dbconn, "HealthHistory", $id);
            $visit = get_row($dbconn, "Visits", $id);
            echo $demo['FirstName']. " " . $demo['LastName'];
          ?></p>
          <p><i class="fa fa-calendar fa-fw w3-margin-right w3-large w3-text-teal"></i>Date of Birth: <?php echo $demo['DOB']; ?></p>
          <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i>Address: <?php echo $conntact['Address1']; ?></p>
          <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i>Email: <?php echo $conntact['Email']; ?></p>
          <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i>Phone: <?php echo $conntact['Phone']; ?></p>
          <p><i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal"></i>Occupation: <?php echo $demo['Occupation']; ?></p>
          <p><i class="fa fa-globe fa-fw w3-margin-right w3-large w3-text-teal"></i>Race/Ethnicity: <?php echo $demo['RaceEthnicity']; ?></p>

          <hr>


          <br>
        </div>
      </div><br>

    <!-- End Left Column -->
    </div>

    <!-- Right Column -->
    <div class="w3-twothird">

      <div class="w3-container w3-card w3-white w3-margin-bottom">
        <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-plus fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Patient History</h2>
        <div class="w3-container">


          <h5 class="w3-opacity"><b>How long have they been a patient</b></h5>
          <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Jan 2015 - <span class="w3-tag w3-teal w3-round">Current</span></h6>
          <p>General Health Summary:
        	 <?php echo $health['HealthHistory']; ?></p>

          <hr>
        </div>
        <div class="w3-container">

      <div class="w3-container w3-card w3-white">
        <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-circle fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Visit#</h2>
        <div class="w3-container">

          <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Visit Date:</h6>
          <h5 class="w3-opacity"><b><?php echo $visit['Date']; ?></b></h5>
          <p>Information from Visit: <?php echo $visit['Diagnosis']; ?></p>

        </div>
        <div class="w3-container">

      </div>
      </div>

         <div class="w3-container w3-card w3-white">
        <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-circle fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Visit#</h2>
        <div class="w3-container">

        <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Visit Date</h6>
          <h5 class="w3-opacity"><b>??????</b></h5>
          <p>Information from Visit</p>

        </div>
        <div class="w3-container">


    <!-- End Right Column -->
    </div>

  <!-- End Grid -->
  </div>

  <!-- End Page Container -->
</div>

<link rel="stylesheet" type="text/css" href="button.css">
<div class="button1">

	<form action= "checkout.php" method="post">
      <input type="hidden" name="ID" value= <? echo $id;?>>
			<input type="submit" name="" value="Checkout">
	</form>

</div>

<div class="button2">
  <form action="Notes.html" method="get">
    <input type="submit" name="visit" value="New Visit">
  </form>
</div>


<footer class="w3-container w3-teal w3-center w3-margin-top">
<p>

</footer>

</body>
</html>

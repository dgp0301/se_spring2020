<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>EHR New Patient</title>
    <link rel="stylesheet" href="stylesheet.css">
  </head>
  <body>
  <div class="head">
    <h1 id="header">EHR System</h1>
    <hr>
    <h2 id="header">Enter patient information</h2>
  </div>
  <?php error_reporting (E_ALL ^ E_NOTICE); ?>
  <div class="">
    <form class=".form" action="PatientDemo.php" method="post">
      Enter Last Name:<input type="text" name="last"><br>
      Enter First Name:<input type="text" name="first"><br>
      Enter Middle Initial: <input type="text" name="middle"><br>
      Enter Title: <input type="text" name="title"><br>
      Enter Suffix: <input type="text" name="suffix"><br>
      Enter Gender: <input type="text" name="gender"><br>
      Enter Ethnicity: <input type="text" name="race"><br>
      Enter Date of Birth: <input type="date" name="birth"><br>
      Enter Occupation: <input type="text" name="job"><br>
      <input type="submit" name="submit" class=".submit">

      <?php
      include_once('dbconnector.php');
      if ( !empty($_POST['first']) || !empty($_POST['last']) || !empty($_POST['gender']) || !empty($_POST['race']) || !empty($_POST['birth']) || !empty($_POST['job']) )
      {
        $l = $_POST['last'];
        $f = $_POST['first'];
        $m = $_POST['middle'];
        $t = $_POST['title'];
        $s = $_POST['suffix'];
        $g = $_POST['gender'];
        $r = $_POST['race'];
        $b = $_POST['birth'];
        $j = $_POST['job'];

        $sql = "INSERT INTO `se_20s_g01_db` . `PatientDemographics` (`Patient ID`, `LastName`, `FirstName`, `MiddleInitial`, `Title`, `Suffix`, `Gender`, `RaceEthnicity`, `DOB`, `Occupation`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $dbconn->prepare($sql);
        $stmt->bind_param("sssssssss", $l, $f, $m, $t, $s, $g, $r, $b, $j);
        $result = $stmt->execute();
        if ($result) {
          echo "New Patient created";
        }
        else {
          echo "An error occured";
        }
      }
      else {
        echo "";
      }
       ?>
    </form>


  </div>


  </body>
</html>

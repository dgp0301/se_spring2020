<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>EHR Contact Info</title>
    <link rel="stylesheet" href="stylesheet.css">
  </head>
  <body>
    <div class="head">
      <h1 id="header">EHR System</h1><hr>
      <h2 id="header">Enter Patient Contact Info</h2>
    </div>
    <?php error_reporting (E_ALL ^ E_NOTICE); ?>
    <div class="">
      <form class="" action="ContactInfo.php" method="post">
        Enter Patient ID: <input type="text" name="id" value=""><br>
        Enter Adress 1: <input type="text" name="ad1" value=""><br>
        Enter Adress 2: <input type="text" name="ad2" value=""><br>
        Enter City: <input type="text" name="c" value=""><br>
        Enter State <input type="text" name="s" value=""><br>
        Enter ZIP Code: <input type="text" name="z" value=""><br>
        Enter Phone number: <input type="text" name="p" value=""><br>
        Enter Email: <input type="text" name="e" value=""><br>
        <input type="submit" name="submit">
      </form>
      <?php
      include_once('dbconnector');

      $id = strip_tags($_POST['id']);
      $a1 = $_POST['ad1'];
      $a2 = $_POST['ad2'];
      $c = $_POST['c'];
      $s = $_POST['s'];
      $z = $_POST['z'];
      $p = $_POST['p'];
      $e = $_POST['e'];
      $check = "SELECT FROM `PatientDemographics` WHERE `Patient ID` LIKE '$id'";
      $result = mysqli_query($dbconn, $check);
      if (!$result || mysqli_num_rows($result) <= 0) {
        $sql = "INSERT INTO `se_20s_g01_db` . `ContactInfo` (`Patient ID`, `Address1`, `Address2`, `City`, `State`, `Zip`, `Phone`, `Email`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $dbconn->prepare($sql);
        $stmt->bind_param("ssssssss", $id, $a1, $a2, $c, $s, $z, $p, $e);
        $result = $stmt->execute();
        if ($result) {
          echo "Contact information added";
        }
        else {
          echo "An error occured";
        }
      }
      else {
        echo "invalid id";
      }
       ?>
    </div>

  </body>
</html>

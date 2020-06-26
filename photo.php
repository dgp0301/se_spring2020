<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>EHR Patient Photo</title>
    <link rel="stylesheet" href="stylesheet.css">
  </head>
  <body>
    <div class="head">
      <h1 id = "header">EHR System</h1>
      <hr>
      <h2 id="header">Upload a Profile Picture</h2>
      <?php error_reporting (E_ALL ^ E_NOTICE); ?>
      <form action="photo.php" method="post" enctype="multipart/form-data">
        <input type="text" name="id" >
        <br>
        <input type="file" name="image">
        <br>
        <input type="submit" name="submit">
      </form>

      <?php
       include_once('dbconnector.php');
       if (isset($_POST['submit'])) {
        if (getimagesize($_FILES['image']['tmp_name']) == FALSE) {
          echo "Select image";
        }
        else
        {
          $image = addslashes($_FILES['image']['tmp_name']);
          $name = addslashes($_FILES['image']['name']);
          $image = file_get_contents($image);
          $image = base64_encode($image);
          saveimage($dbconn, $_POST['id'], $name, $image);
          displayimage($dbconn);
        }
       }
       function saveimage($dbconn, $ID, $name, $image)
       {
         $query = "INSERT INTO `se_20s_g01_db`.`PatientPicture` (`Patient ID`, `name`,`image`) VALUES ('$ID', '$name','$image')";
         $result = mysqli_query($dbconn, $query);
         if ($result) {
           echo "yes";
         }
         else {
           echo "no";
         }
       }

       function displayimage($dbconn, $id)
       {
         $query = "SELECT * FROM `PatientPicture` WHERE `Patient ID` = $id";
         $result = mysqli_query($dbconn, $query);
         if ($row = mysqli_fetch_assoc($result))
         {
           echo '<img height="300" width="300" src="data:image;base64, ' .$row['image']. ' "';
         }
       }

      ?>
    </div>
  </body>
</html>

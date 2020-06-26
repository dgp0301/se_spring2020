<html>
<!--Links to external stylesheets and scripts-->
<div class="body">
    <?php
//fetch.php
include_once('dbconnector.php');

$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($dbconn, $_POST["query"]);
 $query = "
  SELECT `Patient ID`, `LastName`, `FirstName`, `DOB` FROM `PatientDemographics` WHERE `Patient ID` = '$search' OR CONCAT(`FirstName`, ' ', `LastName`) LIKE '%" . $search . "%' ORDER BY `LastName` ASC LIMIT 50";
}
else
{
 $query = "
  SELECT `Patient ID`, `LastName`, `FirstName`, `DOB` FROM `PatientDemographics` ORDER BY `LastName` ASC LIMIT 75
 ";
}
$result = mysqli_query($dbconn, $query);
if(mysqli_num_rows($result) > 0)
{
 $output .= '
  <div id="table" class="table-responsive">
   <table class="table">
    <tr>
     <th>Action</th>
     <th>Patient ID</th>
     <th>Last Name</th>
     <th>First Name</th>
     <th>DOB</th>
    </tr>
 ';
 while($row = mysqli_fetch_array($result))
 {
  $output .= '
   <tr>
    <td><a class= "link" href="PatientProfile.php?PatientID='.$row["Patient ID"] .'">Details</a></td>
    <td>'.$row["Patient ID"].'</td>
    <td>'.$row["LastName"].'</td>
    <td>'.$row["FirstName"].'</td>
    <td>'.$row["DOB"].'</td>
   </tr>
  ';
 }
 echo $output;
}
else
{
 echo '<h4><strong>No Data Found</strong></h4>';
}

?>
</div>

</html>

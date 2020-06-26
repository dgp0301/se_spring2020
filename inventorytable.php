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
  SELECT `SKU`, `Item`, `Amount`, `SellCost` FROM `Inventory` WHERE `SKU` = '$search' ORDER BY `LastName` ASC LIMIT 50";
}
else
{
 $query = "
  SELECT `SKU`, `Item`, `Amount`, `SellCost` FROM `Inventory` ORDER BY `Item` ASC LIMIT 75
 ";
}
$result = mysqli_query($dbconn, $query);
if(mysqli_num_rows($result) > 0)
{
 $output .= '
  <div id="table" class="table-responsive">
   <table class="table">
    <tr>
     <th>SKU</th>
     <th>Item</th>
     <th>Amount</th>
     <th>Price</th>
    </tr>
 ';
 while($row = mysqli_fetch_array($result))
 {
  $output .= '
   <tr>
    <td>'.$row["SKU"].'</td>
    <td>'.$row["Item"].'</td>
    <td>'.$row["Amount"].'</td>
    <td>'.$row["SellCost"].'</td>
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

<head>
    <style>
        
    </style>
</head>
<?php
set_time_limit(530);
// Create connection
$conn = new mysqli('localhost','root','','telepulesek');
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$myfile=fopen("telepulesek.txt","r") or die("Unable to open file!");
while (!feof($myfile)) 
{
 $getTextLine = fgets($myfile);
 $explodeLine = explode("\t",$getTextLine);
 
list($postcode,$town) = $explodeLine;
 
$sql = "INSERT INTO telepulesek(iranyitoszam, telepules)
VALUES ('".$postcode."','".$town."')";

if ($conn->query($sql) === TRUE) {
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
}

$sql = "SELECT id, iranyitoszam, telepules FROM telepulesek ORDER BY telepules ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  ?>
  <table>
<?php
  while($row = $result->fetch_assoc()) {
    echo  '<tr><td>'; ?>
    <?php echo "id: " . $row["id"] ; ?> </td> <td><?php echo " Irányitószám: " . $row["iranyitoszam"] ;?> </td> <td><?php echo " Település:" . $row["telepules"];?></td></tr>  
    <?php
    
  }?>
  </table>
<?php
} else {
  echo "0 results";
}
$conn->close();
fclose($myfile);
?>
<?php 
require 'includes/db.inc.php';

if(isset($_REQUEST['keres'])){
    $stmt=$sql->prepare("SELECT nev FROM ulesrend WHERE nev LIKE ('% ? %')");
    $stmt->bind_param('s', $_REQUEST['keres']);
    $stmt->execute();
    $stmt->store_result();
    if($stmt){
        if($stmt->num_rows()>0){
            while($row=$stmt->fetch_assoc()){
                echo $row['nev']."<br>";
            }
        }else echo "A keresett személy nem szerepel az adatbázisban.";
    }
}
?>
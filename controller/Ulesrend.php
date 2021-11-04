<?php
session_start();
require 'db.inc.php';
require 'functions.inc.php';
require 'model/Ulesrend.php';
$tanulo= new Ulesrend;
//form feldolgozás

if(!empty($_POST["hianyzo_id"])){
    $sql="INSERT INTO hianyzok VALUES(".$_POST["hianyzo_id"].")";
    $result=$conn->query($sql);
}
elseif(!empty($_GET['nem_hianyzo'])){
    $sql="DELETE FROM hianyzok WHERE id=".$_GET['nem_hianyzo'];
    $result=$conn->query($sql);
}


$title="Ülésrend";
include 'htmlheader.php';

include 'menu.inc.php';

?>
        <?php
        $hianyzok=array(); //ebben lesznek a hiányzók id-i felsorolva
        $sql = "SELECT id FROM hianyzok";
        if(!$result = $conn->query($sql)) echo $conn->error;
        if ($result->num_rows > 0) {
            $sor=0;
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $hianyzok[]=$row['id'];
            }
        }
        $adminok=array();
        $sql="SELECT id FROM adminok";
        $result = $conn->query($sql);
        if($result->num_rows>0){
            $sor=0;
            while($row=$result->fetch_assoc()){
                $adminok[]=$row['id'];
            }
        }


        $dupla=17;
        $me=0;
        if(!empty($_SESSION["id"]))$me=$_SESSION["id"];
        

        
 
        ?>
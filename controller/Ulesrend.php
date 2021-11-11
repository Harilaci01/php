<?php
require 'model/Hianzyo.php';
require 'model/Admin.php';

$hianyzo=new Hianyzo();
if(!empty($_POST["hianyzo_id"])){
    $hianyzo->set_id($_POST["hianyzo_id"], $conn);
}
elseif(!empty($_GET['nem_hianyzo'])){
    $sql="DELETE FROM hianyzok WHERE id=".$_GET['nem_hianyzo'];
    $result=$conn->query($sql);
}
 $hianyzok=$hianyzok->lista($conn); //ebben lesznek a hiányzók id-i felsorolva
        
 $admin=new Admin();
 $adminok=$admin->lista($conn);   
$dupla=17;
$me=0;
if(!empty($_SESSION["id"]))$me=$_SESSION["id"];
$tanuloIdk=$tanulo->tanuloklistaja($conn);
include 'view/ulesrend.php';
 
?>
<?php
require 'model/Hianyzo.php';
require 'model/Admin.php';

$hianyzo=new Hianyzo();
if(!empty($_POST["hianyzo_id"])){
    $hianyzo->set_id($_POST["hianyzo_id"], $conn);
}
elseif(!empty($_GET['nem_hianyzo'])){
    $hianyzo->remove_id($_GET["nem_hianyzo"], $conn);
}
 $hianyzok=$hianyzo->lista($conn); //ebben lesznek a hiányzók id-i felsorolva
        
 $admin=new Admin();
 $adminok=$admin->lista($conn);   
$dupla=17;
$me=0;
if(!empty($_SESSION["id"]))$me=$_SESSION["id"];
$tanuloIdk=$tanulo->tanuloklistaja($conn);
include 'view/ulesrend.php';
 
?>
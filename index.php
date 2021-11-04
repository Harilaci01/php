<?php 
session_start();
require 'includes/db.inc.php';
require 'model/Ulesrend.php';
$tanulo= new Ulesrend;
require 'includes/functions.inc.php';


if(!empty($_SESSION["id"])){
    $szoveg=$_SESSION["nev"].": Kilépés";
    $action="kilepes";
}
else{
    $szoveg="Belépés";
    $action="belepes";
}

$page='index';
if(isset($_REQUEST['page'])){
    if($_REQUEST['page']=='felhasznalo'){
        $szoveg="Belépés";
        $action="belepes";
        if(!empty($_SESSION["id"])){
            $szoveg=$_SESSION["nev"].": Kilépés";
            $action="kilepes";
        }
    }
    if(file_exists('controller/'.$_REQUEST['page'].'.php')){
        $page=$_REQUEST['page'];
    }
}
$menupontok=array('index' => "Főoldal",'ulesrend' => "Ülésrend",'felhasznalo'=>$szoveg);
$title=$menupontok[$page];
include 'includes/htmlheader.php';
?>
<body>
<?php
include 'includes/menu.inc.php';

include 'controller/'.$page.'.php';


?>   
</body>
</html>	
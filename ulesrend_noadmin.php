<?php
session_start();
require 'db.inc.php';

function tanuloklistaja($conn){
    $sql="SELECT id, nev, sor, oszlop FROM ulesrend";
    $result=$conn->query($sql);
    return $result;//valami
}
//form feldolgozás

if(!empty($_POST["hianyzo_id"])){
    $sql="INSERT INTO hianyzok VALUES(".$_POST["hianyzo_id"].")";
    $result=$conn->query($sql);
}
elseif(!empty($_GET['nem_hianyzo'])){
    $sql="DELETE FROM hianyzok WHERE id=".$_GET['nem_hianyzo'];
    $result=$conn->query($sql);
}
elseif(isset($_POST['user'])and isset($_POST['pw'])){
    $loginError='';
    if(strlen($_POST['user'])==0) $loginError.="Nem írtál be felhasználónevet<br>";
    if(strlen($_POST['pw'])==0) $loginError.="Nem írtál be jelszót<br>";
    if($loginError==''){
        $sql="SELECT id,nev,jelszo FROM ulesrend WHERE felhasznalo='".$_POST['user']."' ";
        
        if(!$result = $conn->query($sql)) echo $conn->error;
        
         if($result->num_rows > 0){
             if($row = $result->fetch_assoc()){
                if(md5($_POST['pw'])==$row['jelszo']){
                    $_SESSION["id"]=$row['id'];
                    $_SESSION["nev"]=$row['nev'];
                }else $loginError.='Érvénytelen jelszó';
             }
         }
         else $loginError.='Érvénytelen felhasználónév';
    }
}
elseif(isset($_POST['logout'])){
    session_unset();
}
?>
<!DOCTYPE html>	
	<html lang="hu">	
		<head>
		<title> Ülésrend</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="terem.css">
		</head>
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


        $dupla=17;
        $me=0;
        if(!empty($_SESSION["id"]))$me=$_SESSION["id"];
        

        
 
        ?>
		<body>
			<table>
                <tr>
                    <th colspan="3">
                        
                        <?php
                        if(!empty($_SESSION["id"])){
                            echo "Üdv ".$_SESSION['nev']."!";
                            echo '  <form action="ulesrend.php" method="post">
                                        <input type="submit" value="Kilépés" name="logout">
                                    </form>';
                        }
                        else{
                            if(isset($_POST['user'])){
                                echo $loginError;
                            }
                            else echo "Belépés";
                        
                        ?>
                        
                        <form action="ulesrend.php" method="post">
                            Felhasználó: <input type="text" name="user">
                            <br>
                            Jelszó: <input type="password" name="pw">
                            <br>
                            <input type="submit">
                        </form>
                        <?php }?>
                    </th>    
                     <th colspan="2">   
                         <?php    
                            if(!empty($_SESSION["id"])and $_SESSION["id"] ==17){
                            echo '<form action="ulesrend.php" method="post" name="hianyzo">
                                Hiányzó:    <select name="hianyzo_id">';
                                            
                                                $result=tanuloklistaja($conn);
                                                if ($result->num_rows > 0) {
                                                    while($row = $result->fetch_assoc()) {
                                                        if($row['nev'] and !in_array($row['id'],$hianyzok))echo '<option value="'.$row['id'].'">'.$row['nev'].'</option>';
                                                    }
                                                }
                            echo '
                                            </select>
                                            <br>
                                <input type="submit">
                            </form>';}
                        ?>
                    </th>
                    </tr>
				<tr>
                <?php              
                    $sql = "SELECT id,nev, sor, oszlop FROM ulesrend";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                    $sor=0;
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                       if($row["sor"]!=$sor){
                            if($sor!=0)echo '</tr>';
                            echo '<tr>';
                            $sor=$row["sor"];
                       }
                       if(!$row["nev"])echo '<td class="nincs"></td>';
                       else{
                        $plusz='';
                        //if(in_array(($row["oszlop"]-1),$hianyzok[$sor-1]))$plusz.=' class="hianyzo"';
                        if(in_array(($row["id"]),$hianyzok))$plusz.=' class="hianyzo"';
                        if($row["id"]==$dupla)$plusz.=' colspan="2"';
                        if($row["id"]==$me)$plusz.= ' id="me"';
                       echo "<td".$plusz.">".$row["nev"];
                       if(in_array(($row["id"]),$hianyzok)and !empty($_SESSION["id"])and $_SESSION["id"] ==17) echo '<br><a href="ulesrend.php?nem_hianyzo='.$row['id'].'">Nem hiányzó</a>';
                       echo "</td>";
                       }
                    }
                    } else {
                    echo "0 results";
                    }
                    $conn->close();
                ?>  
                </table>          
		</body>
	</html>		
<?php
session_start();
require 'db.inc.php';
require 'functions.inc.php';
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
		<body>
			<table>
                <tr> 
                    <th colspan="3">
                        <?php
                            echo $title;
                        ?>
                    </th>                       
                     <th colspan="2">   
                         <?php    
                            if(!empty($_SESSION['id'])){
                                if(in_array($_SESSION['id'],$adminok)){
                                    ?>
                                    <form action="ulesrend.php" method="post">
                                    <select name="hianyzo_id">
                                    <?php
                                    $result=tanuloklistaja($conn);
                                    if($result->num_rows >0){
                                        while($row=$result->fetch_assoc()){
                                            if($row['nev'] and !in_array($row['id'],$hianyzok))echo '<option value="'.$row['id'].'">'.$row['nev'].'</option>';
                                        }
                                    }
                                    ?>
                                    </select><br>
                                    <input type="submit">
                                    <?php
                                }
                            }
                        ?>
                        </form >
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
                       if(!empty($_SESSION['id'])){
                        if(in_array($_SESSION['id'],$adminok)){
                       if(in_array(($row["id"]),$hianyzok ))echo '<br><a href="ulesrend.php?nem_hianyzo='.$row['id'].'">Nem hiányzó</a>';
                        }
                    }
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
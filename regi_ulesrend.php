<?php
require 'db.inc.php';
?>
<!DOCTYPE html>	
	<html lang="hu">	
		<head>
		<title> Ülésrend</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="terem.css">
		</head>
        <?php

        $osztaly=array(
            array("Kulhanek László"),
            array("Molnár Gergő","Bakcsányi Dominik","Füstős Lóránt","Orosz Zsolt","Harsányi László",NULL),
            array("Kereszturi Kevin","Juhász Levente","Szabó László","Sütő Dániel","Détári Klaudia",NULL),
            array("Fazekas Miklós",NULL,"Gombos János", "Bicsák József"),
        );
        foreach($osztaly as $sor=> $tomb){
            foreach($tomb as $oszlop=>$tanulo){
                $sql="INSERT INTO `ulesrend` (`nev`, `sor`, `oszlop`) VALUES ('$tanulo', $sor+1, $oszlop+1);";
                if ($conn->query($sql) === TRUE) {
                    echo "$tanulo beszúrásra került";
                  } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                  }
            }
        }  
        $conn->close();     

       
        
        $hianyzok=array(
            array(0),
            array(3),
            array(1),
            array()
        );
        $dupla=array(
            array(),
            array(),
            array(),
            array(3),
        );
        $me=array(
            array(),
            array(4),
            array(),
            array()
        );

        
 
        ?>
		<body>
			<table>
				<tr>
                <?php
                foreach($osztaly as $sor=>$tomb){
                    echo '<tr>';
                    foreach($tomb as $oszlop=> $tanulo){
                        if($tanulo===NULL)echo '<td class="nincs"></td>';
                        else{
                            $plusz='';
                            if(in_array($oszlop,$hianyzok[$sor]))$plusz.=' class="hianyzo"';
                            if(in_array($oszlop,$dupla[$sor]))$plusz.=' colspan="2"';
                            if(in_array($oszlop,$me[$sor]))$plusz.= ' id="me"';
                            echo '<td'.$plusz.'>'.$tanulo.'</td>';
                        }
                    }
                    echo '</tr>';
                }
                ?>
            
            
                <tr>
                    <td><?php 
                            echo $osztaly[0][0];
                            ?></td>
					<th colspan="5"><sup> Tábla</sup></th>
					<td class="vertical-text"><b>Ajtó</b></td>
				</tr>
				<tr>
					<td><?php 
                            echo $osztaly[1][0];
                            ?></td>
					<td class="nincs"></td>
					<td><?php 
                            echo $osztaly[1][1];
                            ?></td>
					<td class="hianyzo"><?php 
                            echo $osztaly[1][2];
                            ?></td>
					<td class="nincs"></td>
					<td><?php 
                            echo $osztaly[1][3];
                            ?></td>
					<td id="me"><?php 
                            echo $osztaly[1][4];
                            ?></td>
				</tr>  
				<tr>
					<td><?php 
                            echo $osztaly[2][0];
                            ?></td>
					<td class="nincs"></td>
					<td class="hianyzo"><?php 
                            echo $osztaly[2][1];
                            ?></td>
					<td><?php 
                            echo $osztaly[2][2];
                            ?></td>
					<td class="nincs"></td>
					<td><?php 
                            echo $osztaly[2][3];
                            ?></td>
					<td><?php 
                            echo $osztaly[2][4];
                            ?></td>
				</tr> 
				<tr>
					<td><?php 
                            echo $osztaly[3][0];
                            ?></td>
					<td class="nincs"></td>
					<td><?php 
                            echo $osztaly[3][1];
                            ?></td>
					<td><?php 
                            echo $osztaly[3][2];
                            ?></td>
					<td><?php 
                            echo $osztaly[3][3];
                            ?></td>
					<td class="nincs"></td>
				</tr>   
			</table>
		</body>
	</html>		
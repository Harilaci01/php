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
		</body>
	</html>		
<?php
function tanuloklistaja($conn){
    $sql="SELECT id, nev, sor, oszlop FROM ulesrend";
    $result=$conn->query($sql);
    return $result;//valami
}



?>



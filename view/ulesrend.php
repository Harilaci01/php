
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
                                            $tanulo->set_user($row['id'],$conn);
                                            if($tanulo->get_nev() and !in_array($row['id'],$hianyzok))echo '<option value="'.$row['id'].'">'.$tanulo->get_nev().'</option>';
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
                        $tanulo->set_user($row['id'],$conn);
                       if($tanulo->get_sor()!=$sor){
                            if($sor!=0)echo '</tr>';
                            echo '<tr>';
                            $sor=$tanulo->get_sor();
                       }
                       if(!$tanulo->get_nev())echo '<td class="nincs"></td>';
                       else{
                        $plusz='';
                        //if(in_array(($row["oszlop"]-1),$hianyzok[$sor-1]))$plusz.=' class="hianyzo"';
                        if(in_array(($row["id"]),$hianyzok))$plusz.=' class="hianyzo"';
                        if($row["id"]==$dupla)$plusz.=' colspan="2"';
                        if($row["id"]==$me)$plusz.= ' id="me"';
                       echo "<td".$plusz.">".$tanulo->get_nev();
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
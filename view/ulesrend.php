
			<table>
                <tr> 
                    <th colspan="3">
                       <h2>Ülésrend</h2>
                    </th>                       
                     <th colspan="2">   
                         <?php    
                            if(!empty($_SESSION['id'])){
                                if(in_array($_SESSION['id'],$adminok)){
                                    ?>
                                    <form action="index.php?page=ulesrend" method="post">
                                    <select name="hianyzo_id">
                                    <?php
                                   
                                    if($tanuloIdk){
                                        foreach($tanuloIdk as $row){
                                            $tanulo->set_user($row,$conn);
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
                    if($tanuloIdk){
                    $sor=0;
                    // output data of each row
                    foreach($tanuloIdk as $row){
                        $tanulo->set_user($row,$conn);
                       if($tanulo->get_sor()!=$sor){
                            if($sor!=0)echo '</tr>';
                            echo '<tr>';
                            $sor=$tanulo->get_sor();
                       }
                       if(!$tanulo->get_nev()) echo '<td class="nincs"></td>';
                       else{
                        $plusz='';
                        if(in_array(($row),$hianyzok))$plusz.=' class="hianyzo"';
                        if($row==$dupla)$plusz.=' colspan="2"';
                        if($row==$me)$plusz.= ' id="me"';
                       echo "<td".$plusz.">".$tanulo->get_nev();
                       if(!empty($_SESSION['id'])){
                        if(in_array($_SESSION["id"],$adminok)){
                       if(in_array(($row),$hianyzok ))echo '<br><a href="index.php?ulesrend&nem_hianyzo='.$row['id'].'">Nem hiányzó</a>';
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
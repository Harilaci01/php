            <?php 
            if(isset($_FILES["fileToUpload"])){
                $target_dir="uploads/";                      
                $target_file=$target_dir.basename($_FILES["fileToUpload"]["name"]);
                if(@move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_file)){
                    echo "Profilkép feltöltve";
                }
                

            }
            ?>
                <form action="index.php?page=ulesrend" method="post" enctype="multipart/form-data">
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <input type="submit" value="Profilkép feltöltése" name="submit">
                   
                </form>    
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
                                            if($tanulo->get_nev() and !in_array($row,$hianyzok))echo '<option value="'.$row.'">'.$tanulo->get_nev().'</option>';
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
                        $kep='';
                        if(in_array(($row),$hianyzok))$plusz.=' class="hianyzo"';
                        if($row==$dupla)$plusz.=' colspan="2"';
                        if($row==$me){$plusz.= ' id="me"';
                            $kep.='<img src="'.$target_file.'">';}
                       echo "<td".$plusz.">".$tanulo->get_nev().$kep;
                       if(!empty($_SESSION['id'])){
                        if(in_array($_SESSION["id"],$adminok)){
                       if(in_array(($row),$hianyzok ))echo '<br><a href="index.php?page=ulesrend&nem_hianyzo='.$row.'">Nem hiányzó</a>';
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
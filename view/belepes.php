    <table>
        <tr>
            <th colspan="3">
                
                <?php
                if(!empty($_SESSION["id"])){
                    echo "Üdv ".$_SESSION['nev']."!";?>
                 <form action="index.php?page=felhasznalo" method="post">
                                <input type="submit" value="Kilépés" name="logout">
                            </form>;
                            <?php
                }
                else{
                    if(isset($_POST['user'])){
                        echo $loginError;
                    }
                    else echo "Belépés";
                
                ?>
                
                <form action="index.php?page=felhasznalo" method="post">
                    Felhasználó: <input type="text" name="user">
                    <br>
                    Jelszó: <input type="password" name="pw">
                    <br>
                    <input type="submit">
                </form>
                <?php }?>
            </th>                        
    </table>          
	
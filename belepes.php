<?php
session_start();
require 'db.inc.php';

require 'functions.inc.php';

if(isset($_POST['user'])and isset($_POST['pw'])){
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
                    header('Location:ulesrend.php');
                    exit();
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
<?php
$title="Belépés";
if(!empty($_SESSION["id"]))$title="Kilépés";
                
                include 'htmlheader.php';

            ?>
    
		<body>
            <?php
                include 'menu.inc.php';

            ?>
			<table>
                <tr>
                    <th colspan="3">
                        
                        <?php
                        if(!empty($_SESSION["id"])){
                            echo "Üdv ".$_SESSION['nev']."!";
                            echo '  <form action="belepes.php" method="post">
                                        <input type="submit" value="Kilépés" name="logout">
                                    </form>';
                        }
                        else{
                            if(isset($_POST['user'])){
                                echo $loginError;
                            }
                            else echo "Belépés";
                        
                        ?>
                        
                        <form action="belepes.php" method="post">
                            Felhasználó: <input type="text" name="user">
                            <br>
                            Jelszó: <input type="password" name="pw">
                            <br>
                            <input type="submit">
                        </form>
                        <?php }?>
                    </th>                        
                </table>          
		</body>
	</html>		
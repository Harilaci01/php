<?php 
        
        $szoveg="Belépés";
        $link="belepes.php";
        if(!empty($_SESSION["id"])){
            $szoveg=$_SESSION["nev"].": Kilépés";
            $link="index.php?logout=1";
        }
        $menupontok=array("index.php" => "Főoldal","ulesrend.php" => "Ülésrend",$link => $szoveg);
        ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav mr-auto">
                <?php 
                    foreach($menupontok as $key => $value){
                        $active='';
                        if($_SERVER['REQUEST_URI']=='/teszt/'.$key)$active=' active';
                        ?>
                        <li class="nav-item<?php echo $active;?>">
                        <a class="nav-link" href="<?php echo $key;?>"><?php echo $value;?></a>
                        </li>
                    <?php } ?>            
            </ul>

        </div>
    </nav>   

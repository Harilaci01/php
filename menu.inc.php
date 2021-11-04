<?php 
       
        ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav mr-auto">
                <?php 
                    foreach($menupontok as $key => $value){
                        $active='';
                        if($_SERVER['REQUEST_URI']=='/php/'.$key)$active=' active';
                        ?>
                        <li class="nav-item<?php echo $active;?>">
                        <a class="nav-link" href="index.php?page=<?php echo $key;?>"><?php echo $value;?></a>
                        </li>
                    <?php } ?>            
            </ul>

        </div>
    </nav>   

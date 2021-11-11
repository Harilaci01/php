<?php 

require 'Kijeloltfelhasznalok.php';
class Admin extends Kijeloltfelhasznalok{

    function _construct($tablaNev){
        $this->tablaNev= 'adminok';
    }
}

   ?>
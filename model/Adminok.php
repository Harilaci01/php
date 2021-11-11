<?php 
require '../includes/db.inc.php';
require 'Kijeloltfelhasznalok.php';
class Admin extends Kijeloltfelhasznalok{

    function _construct($tablaNev){
        $this->tablaNev= 'adminok';
    }
}
$admin=new Admin();
$admin->set_id(1,$conn);
echo $admin->get_id();
   ?>
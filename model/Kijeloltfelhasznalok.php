<?php 

class Kijeloltfelhasznalok{
    private $id;
    protected $tablaNev;
    function _construct($tablaNev){
        $this->tablaNev=$tablaNev;
    }

    public function set_id($id, $conn){
        //adatbázisból lekérdezzük
        $sql="SELECT id FROM $this->tablaNev WHERE id=$id ";
        $sql .="WHERE id=$id";
        $result=$conn->query($sql);
        if($conn->query($sql)){
            if($result->num_rows > 0){
             $row=$result->fetch_assoc();
             $this->id=$row['id'];
            }
            else{
                $sql="INSERT INTO $this->tablaNev VALUES ($id) ";
                if($result=$conn->query($sql)){
                    $this->id=$id;
                }
            }
        }else {
            echo "Error: ".$sql."<br>".$conn->error;
        }
    }
   
    public function get_id(){        
        
        return $this->id;            
        
    }
    public function adminoklistaja($conn){
        $lista=array();
        $sql="SELECT id FROM $this->tablaNev";
        if($result=$conn->query($sql)){
            if($result->num_rows>0){
                while($row=$result->fetck_assoc()){
                    $lista[]=$row['id'];
                }
            }
        }
        return $lista;
    }
    
}

?>
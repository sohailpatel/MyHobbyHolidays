<?php
class Core{
    protected $db, $result;
    private $rows;

    public function __construct(){
        $host='localhost';
        $user='root';
        $pass='root';
        $db='myhobbyholidays';
        $conn=mysqli_connect($host,$user,$pass,$db) or die ("Break for DB");
        $this->db = $conn;
    }
    public function query($sql){
        $this->result = $this->db->query($sql);
    } 
    
    public function rows(){
        for($x=1 ; $x <= $this->db->affected_rows; $x++){
            $this -> rows[] = $this->result->fetch_assoc();
        }
        return $this->rows;
    }
}
?>
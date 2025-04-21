<?php
class sql
{
    public $conn;

    public function __construct()
    {
        $user = "root";
        $pass = "";
        $serv = "localhost";
        $db ="expediente";

        $this->conn = new mysqli($serv, $user, $pass, $db);
    }

    public function select($sql)
    {
        //echo $sql ."<br>"; 
        $result = $this->conn->query($sql);
        return $result;
    }
}
?>
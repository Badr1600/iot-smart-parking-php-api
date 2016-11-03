<?php
 
class DB_Functions {
 
    private $conn;
 
    // constructor
    function __construct() {
        require_once 'DB_Connect.php';
        // connecting to database
        $db = new Db_Connect();
        $this->conn = $db->connect();
    }
 
    // destructor
    function __destruct() {
         
    }
 
    /**
     * Updating Car Entries
     * returns successful car entries
     */
    public function updateCarEntries($value) {
        $curr_time = date("Y-m-d H:i:s");
        $stmt = $this->conn->prepare("INSERT INTO park(time, value) VALUES('$curr_time', ?)");
        $stmt->bind_param("s", $value);
        $result = $stmt->execute();
        $stmt->close();
        // check for successful store
        if ($result) {
            return $curr_time;
        } else {
            return false;
        }
    }

    public function fetchCarEntries() {
        $stmt = $this->conn->prepare("SELECT max( `id` ) FROM `park`");
        // if ($stmt->execute()) {
        $result = $stmt->execute();
        if($result){
            $result = $stmt->bind_result($district);
            $temp = $result;
            $stmt->fetch();
            $stmt->close();

            return $this->getCars($district);
        } else {
            return false;
        }
    }

    public function getCars($id) {

        $sql = "SELECT * FROM `park` WHERE id=$id";
        $result = mysqli_query($this->conn, $sql);
        // echo mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

}

?>
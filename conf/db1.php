<?php 

    // $conn = mysqli_connect('sql306.epizy.com', 'epiz_25023672', 'RBTXS7KOenTLR', 'epiz_25023672_new');
    // if (mysqli_connect_errno()) {
    //     echo "Failed to connect to MySQLi" . mysqli_connect_errno();
    // }

    // $conn = new mysqli('sql306.epizy.com', 'epiz_25023672', 'RBTXS7KOenTLR', 'epiz_25023672_new');
    $conn = mysqli_connect('sql306.epizy.com', 'epiz_25023672', 'RBTXS7KOenTLR', 'epiz_25023672_phpblog');
    if (mysqli_errno()) {
        die("Failed to connect to MySQLi" . mysqli_error());
    }

    class DB {
    public $host;
    public $user;
    public $password;
    public $dbname;
    public $conn;

    public function __construct($host, $user, $password, $dbname) {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->dbname = $dbname;
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbname);
        if (!$this->conn) {
            die("Failed to connect to MYSQLi" . $this->conn->connect_error);
        }
    }
    public function getProducts() {
        $query = "SELECT * FROM images";
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }
    public function getPosts() {
        $query = "SELECT * FROM posts";
    }
}


?>
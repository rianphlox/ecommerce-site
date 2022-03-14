<?php 

    error_reporting(E_ALL);

    ini_set('display_errors', 1);



    class DB {

        private $host;

        private $user;

        private $password;

        private $dbname;

        public $conn;



        public function __construct($host = 'localhost', $user = 'root', $password = '', $dbname = 'podeuro') {

            $this->host = $host;

            $this->user = $user;

            $this->password = $password;

            $this->dbname = $dbname;

            $this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbname) or die("Failed to connect to MySQLi" . $this->conn->connect_error);

        }



        



        public function CreateUser($username, $email, $password) {

            if (!empty($username) && !empty($email) && !empty($password)) {

                // validate email

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

                    // invalid email

                    return ['msg' => 'Please use a valid email', 'msgClass' => 'error', 'secondMsgClass' => '#fb3'];

                } else {

                    // check if user exists in database

                    $query = "SELECT id FROM users WHERE email = ?";

                    $stmt = $this->conn->prepare($query);

                    $stmt->bind_param('s' , $email);

                    $stmt->execute();

                    $stmt->bind_result($id);

                    $stmt->fetch();

                    if (!$id) {

                        // user not in database

                        $query = "INSERT INTO `users` (`username`, `email`, `password`) VALUES (?, ?, ?) ";

                        // $query = "INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES (NULL, 'Kylian', 'amos12@gmail.com', '1234');"

                        $stmt = $this->conn->prepare($query);

                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                        $stmt->bind_param('sss', $username, $email, $hashedPassword);

                        if ($stmt->execute()) {

                            // create cart for user using email

                            $this->CreateUserCart($email);

                            return ['msg' => 'Success!', 'msgClass' => 'success', 'secondMsgClass' => '#00c851'];

                        }

                    } else {

                        // user in database

                        return ['msg' => 'User already exists!', 'msgClass' => 'error', 'secondMsgClass' => '#fb3'];

                    }

                }

            } else {

                return ['msg' => 'Please include all fields', 'msgClass' => 'error', 'secondMsgClass' => '#fb3'];

            }

        }

        

        public function LogUserIn($email, $password) {

            if (!empty($email) && !empty($password)) {

                // validate email

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

                    return ['msg' => 'Please use a valid email!', 'msgClass' => 'error', 'secondMsgClass' => '#fb3'];

                } else {

                    // check if user in db

                    $query = "SELECT email, password FROM users WHERE email = ? ";

                    $stmt = $this->conn->prepare($query);

                    $stmt->bind_param('s', $email);

                    $stmt->execute();

                    $stmt->bind_result($dbEmail, $hashedPassword);

                    $stmt->fetch();

                    // check if the email brought back is the same and verify the password

                    if ($dbEmail !== $email || password_verify($password , $hashedPassword) == false) {

                        // user not in database

                        return ['msg' => 'Incorrect email or password', 'msgClass' => 'error', 'secondMsgClass' => '#fb3'];

                    } else {

                        // user in db 

                        session_start();

                        $_SESSION['email'] = $email;

                        // session_destroy();

                        return ['msg' => 'Logged in!', 'msgClass' => 'success', 'secondMsgClass' => '#00c851'];

                    }

                }

            } else {

                return ['msg' => 'Please fill in all fields!', 'msgClass' => 'error', 'secondMsgClass' => '#fb3'];

            }

        }





        public function GetProductsFrom($tablename = 'stock') {

            $query = "SELECT * FROM {$tablename}";

            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt->get_result();

        }



        public function CreateUserCart($email) {

            $email = explode('@', $email)[0];

            $tablename = strtolower($email) ."_cart";

            $query = "CREATE TABLE $this->dbname.$tablename

            ( `id` INT(10) NOT NULL AUTO_INCREMENT , 
            `image_name` varchar(255) NOT NULL ,
            `image_path` varchar(255) NOT NULL , 
            `current_price` INT(255) NOT NULL , 
            `quantity` INT(10) NOT NULL , 
            PRIMARY KEY (`id`)) ENGINE = MyISAM;
            ";

            $stmt = $this->conn->prepare($query);

            $stmt->execute();

        }



        public function AddToCart($userEmail, $image_name, $image_path, $current_price, $quantity) {

            if ($userEmail == '') {

                $query = "SELECT id FROM cart WHERE image_name = ?";

                $stmt = $this->conn->prepare($query);

                $stmt->bind_param('s', $image_name);

                $stmt->execute();

                $stmt->bind_result($id);

                $stmt->fetch();

                

                if (!$id) {

                    $query = "INSERT INTO cart (image_name, image_path, current_price, quantity) VALUES (?, ?, ?, ?)";

                    $stmt = $this->conn->prepare($query);

                    $stmt->bind_param('ssii', $image_name, $image_path, $current_price, $quantity);

                    if ($stmt->execute()) {

                        return ['msg' => 'Item added to cart!' , 'msgClass' => 'success', 'secondMsgClass' => '#00c851'];

                    }

                } else {

                    // return ['msg' => 'Item already in cart!', 'msgClass' => 'error', 'secondMsgClass' => '#fb3'];

                    return ['msg' => 'Item already in cart!' , 'msgClass' => 'error', 'secondMsgClass' => '#fb3'];

                }

            } else {

                $tablename = "{$userEmail}_cart" ;

                // check if item already in cart

                $query = "SELECT id FROM $tablename WHERE image_name = ?";

                $stmt = $this->conn->prepare($query);

                $stmt->bind_param('s', $image_name);

                $stmt->execute();

                $stmt->bind_result($id);

                $stmt->fetch();

                if (!$id) {

                    // product not in users cart

                    $query = "INSERT INTO $tablename (image_name, image_path, current_price, quantity) VALUES (?, ?, ?, ?)";

                    $stmt = $this->conn->prepare($query);

                    $stmt->bind_param('ssii', $image_name, $image_path, $current_price, $quantity);

                    if ($stmt->execute()) {

                        return ['msg' => 'Item added to cart!' , 'msgClass' => 'success', 'secondMsgClass' => '#00c851'];

                    }

                } else {

                    // product already in users cart

                    return ['msg' => 'Item already in cart!' , 'msgClass' => 'error', 'secondMsgClass' => '#fb3'];

                }

            }

        }





        public function returnCartNumber($userEmail) {

            $conn = $this->conn;

            if (!$userEmail) {

                // query general cart

                $query = "SELECT * FROM cart";

                $stmt = $conn->prepare($query);

                $stmt->execute();

                return $stmt->get_result()->num_rows;

            } else {

                // query with user email 

                $tablename = "{$userEmail}_cart" ;

                $query = "SELECT * FROM $tablename";

                $stmt = $conn->prepare($query);

                $stmt->execute();

                return $stmt->get_result()->num_rows;

            }

        }



        public function GetCartItems($userEmail) {

            if (!$userEmail) {

                // get products from general cart

                $query = "SELECT * FROM cart";

                $stmt = $this->conn->prepare($query);

                $stmt->execute();

                return $stmt->get_result();

            } else {

                $tablename = "{$userEmail}_cart";

                $query = "SELECT * FROM $tablename";

                $stmt = $this->conn->prepare($query);

                $stmt->execute();

                return $stmt->get_result();



            }

        }



        public function GetTotalAmount($userEmail) {

            $total = 0;

            if (!$userEmail) {

                $query = "SELECT * FROM cart";

                $stmt = $this->conn->prepare($query);

                $stmt->execute();

                $result  = $stmt->get_result();

                if (!$result->num_rows) {

                    return 0;

                } else {

                    while ($row = $result->fetch_assoc()) {

                        $total += $row['current_price'];

                    }

                    return $total;

                }

            } else {

                $tablename = "{$userEmail}_cart";

                $query = "SELECT * FROM $tablename";

                $stmt = $this->conn->prepare($query);

                $stmt->execute();

                $result  = $stmt->get_result();

                if (!$result->num_rows) {

                    return $total;

                } else {

                    while ($row = $result->fetch_assoc()) {

                        $total += $row['current_price'];

                    }

                    return $total;

                }

            }

        }



        // 

    }
<?php
    class adminBack{
        private $conn;
        
        public function __construct()
        {
            $dbhost = "localhost";
            $dbuser = "root";
            $dbpass = "";
            $dbname = "ecom";
            
            $this->conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
            
            if(!$this->conn){
                die("database connection error");
            }
        }
        
    function admin_login($data){
        $admin_email = $data['admin_email'];
        $admin_pass = md5($data['admin_pass']);
        
        $query="SELECT * FROM adminlog WHERE
        admin_email='$admin_email' AND
        admin_pass='$admin_pass'";
        if(mysqli_query($this->conn,$query)){
            $result = mysqli_query($this->conn,$query);
            $admin_info = mysqli_fetch_assoc($result);
            
            if($admin_info){
                header('location:dashboard.php');
                session_start();
                $_SESSION['id'] = $admin_info['id'];
                $_SESSION['adminEmail'] = $admin_info['admin_email'];
                $_SESSION['adminPass'] = $admin_info['admin_pass'];

            }else{
                $errmsg = "Your Username";
                return $errmsg;
            }
        }
    }

    function adminLogout(){
        unset($_SESSION['id']);
        unset($_SESSION['adminEmail']);
        unset($_SESSION['adminPass']);
        header('location:index.php');
    }

    function add_category($data){    
        $ctg_name = $data['ctg_name'];
        $ctg_des = $data['ctg_des'];
        $ctg_status = $data['ctg_status'];      
        
        $query = "INSERT INTO category(ctg_name,ctg_des,ctg_status) VALUES
        ('$ctg_name','$ctg_des','$ctg_status')";
        
        if(mysqli_query($this->conn, $query)){
            $message = "Category Added Successfully.";
            return $message;
        }else{
            $message = "Category Not Added";
            return $message;
        }
    }
}
    

    


?>

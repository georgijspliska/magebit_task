<?php   

    $server = "localhost:3306";
    $user = "root";
    $pass = "";
    $name = "DB";
    $tname = "TB";

    $email = "";
    $Err = "";

    $img = '';
    $h1 = "Subscribe to newsletter";
    $text = "Subscribe to our newsletter and get 10% discount on pineapple glasses.";     
    $display = 'style="display: flex;"';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $patt1 = "/^.+\@.+\.(co)$/";
        $patt2 = "/^.+\@.+[.][a-z][a-z][a-z]$/";

        if (empty($_POST["email"])) {
            $Err = "Email is required";
        } elseif (preg_match($patt1,$_POST["email"])) {
            $Err = "We are not accepting subscriptions from Colombia emails";
        } elseif (! preg_match($patt2,$_POST["email"])) {
            $Err = "Please provide a valid e-mail address";
        } elseif (empty($_POST["tos"])) {
            $Err = "You must accept the terms and conditions";
        } else {
            $email = test_input($_POST["email"]);
        } 

        if ($Err == "" ){
            if (Add_To_Table($email)){
                update();
            }            
        }       
    }

    function test_input($data) {

        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function update(){    
        
        global $img, $h1, $text, $display;

        $img = 'style="display: unset;"';  
        $h1 = "Thanks for subscribing!";
        $text = "You have successfully subscribed to our email listing. Check your email for the discount code.";  
        $display = 'style="display: none;"';        
    }


    Create_DB();
    Create_Table();
    #Delete_DB();

    function Create_DB(){

        global $server, $user, $pass, $name;
        
        $conn = mysqli_connect($server, $user, $pass);
        if (!$conn) {
            mysqli_close($conn);
            die("Connection failed: " . mysqli_connect_error());                        
        }
        $sql = " CREATE DATABASE $name ";
        if (mysqli_query($conn, $sql)) {
            mysqli_close($conn);
        } else {
            mysqli_close($conn);
        }
    }

    function Create_Table(){

        global $server, $user, $pass, $name, $tname;
        
        $conn = mysqli_connect($server, $user, $pass, $name);
        if (!$conn) {
            mysqli_close($conn);
            die("Connection failed: " . mysqli_connect_error());   
        }

        $sql = "CREATE TABLE $tname (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, email VARCHAR(30) NOT NULL, created DATETIME DEFAULT CURRENT_TIMESTAMP)";
        if (mysqli_query($conn, $sql)) {
            mysqli_close($conn);
        } else {
            mysqli_close($conn); 
        } 
    }

    
    function Delete_DB(){

        global $server, $user, $pass, $name;

        $conn = mysqli_connect($server, $user, $pass);
        if (!$conn) {
            mysqli_close($conn);
        }

        $sql = " DROP DATABASE $name ";
        if (mysqli_query($conn, $sql)) {
            mysqli_close($conn);
        } else {
            mysqli_close($conn);
        }
    }

    function Delete_Row($dati = ''){

        global $server, $user, $pass, $name, $tname;

        $conn = mysqli_connect($server, $user, $pass);
        if (!$conn) {
            die("Connection failed: " . mysqli_error($conn));  
            mysqli_close($conn);
        }

        $sql = "DELETE FROM $name.$tname WHERE email='$dati' ";
        if (mysqli_query($conn, $sql)) {
            mysqli_close($conn);
        } else {
            die("Connection failed: " . mysqli_error($conn));  
            mysqli_close($conn);
        }
    }


    function Add_To_Table($dati = ''){

        global $server, $user, $pass, $name, $tname;

        $conn = mysqli_connect($server, $user, $pass, $name);
        if (!$conn) {
            mysqli_close($conn);
            die("Connection failed: " . mysqli_connect_error());  
        }

        $sql = "INSERT INTO $tname (email,created) VALUES ('$dati',NOW())";
        if (mysqli_query($conn, $sql)) {
            mysqli_close($conn);
            return true;
        } else {
            mysqli_close($conn); 
            return false;
        }
    }

    function Print_Table(){

        global $server, $user, $pass, $name, $tname;

        $conn = mysqli_connect($server, $user, $pass, $name);
        if (!$conn) {
            mysqli_close($conn);
            die("Connection failed: " . mysqli_connect_error());   
        }

        $myArr = array();

        $sql = "SELECT id, email, created FROM $tname ";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                array_push($myArr, array($row["email"],$row["created"]));
            }   
            mysqli_close($conn);
            return $myArr;    
        } else {
            mysqli_close($conn);
        }
    }
?>
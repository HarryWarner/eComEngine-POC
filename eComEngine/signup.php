<html>


<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="E-Commerce Engine" />
    <meta name="keywords" content="" />
    <title>Sign in</title>
    <link rel="stylesheet" href="style/styles.css">
</head>

<body>



    <h2 class="pageHeadings">E-Commerce Engine</h2>


    <form action="signup.php" method="post">
        Email Address: <input type="text" name="email"><br>
        First Name: <input type="text" name="fname" required><br>
        Last Name: <input type="text" name="lname" required><br>


        Password: <input type="password" name="pwd" id="pwd" required><br>
        Confirm Password: <input type="password" name="confpwd" id="confpwd" required><br>

        <input type="submit" value="Register">
        <input type="reset" value="Reset">
    </form>

    <a href="index.php">Home</a><br>

    <?php
    session_start();
    
    validateForm();
       
        
         
    
    function validateForm(){
        $validEmail = false;
        $validName = false;
        $validPwd = false;
        
        require_once("settings.php");
        $connection = mysqli_connect($host, $user, $password, $dbnm);
        if(mysqli_connect_error()){
                die("connection failed: ".mysqli_connect_error());
            }
        
        
//        validate email address
        if(isset($_POST['email'])){
            if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                $email = $_POST['email'];
                $validEmail = true;
//                echo "Email: ".$email;
            }else{
                echo "Please enter a valid email address";
            }
        }else{
            echo "Please ensure you complete all fields";
        }
        
//        validate name
        if(isset($_POST['fname']) && isset($_POST['lname'])){
            $pattern = '^\pL+$/u';
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            
            if(preg_match('/^\pL+$/u', $fname) && preg_match('/^\pL+$/u', $lname)){
                $validName = true;
//                echo "Name: ".$fname." ".$lname;
            }else{
                echo "Name fields must only contain letters";
            }
            
        }else{
            echo "Please ensure you fill all fields";
        }
        
//        validate password
        if(isset($_POST["pwd"]) && isset($_POST["confpwd"])){
            if($_POST["pwd"] === $_POST["confpwd"]){
                
                if(preg_match('+[a-zA-Z0-9@]+', $_POST["pwd"])){
                    $pwd = encryptPwd($_POST['pwd']);
                    $validPwd = true;
//                    echo "Pwd: ".$pwd;
                }else{
                    echo "Please enter a valid password (letters and numbers only) <br>";
                }
            }else{
                echo "Please ensure both your password, and confirm password match <br>";
            }
        }
        
        
        if($validPwd && $validName && $validEmail){
            $query = "INSERT INTO userdata (ID, firstName, lastName, email, password)
            VALUES (NULL, '$fname', '$lname', '$email', '$pwd')";
             $result = mysqli_query($connection, $query);
        }
    }
        
        function encryptPwd($x){
            $pwd = md5($x);
            return $pwd;
        }
        
    
    
    ?>

</body>

</html>

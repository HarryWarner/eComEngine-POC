<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Web Application Development :: Assignment 3" />
    <meta name="keywords" content="Web,programming" />
    <title>My Friend System Registration Page</title>
    <link rel="stylesheet" href="style/styles.css">
</head>

<body>

    <h2 class="pageHeadings">E-Commerce Engine</h2>
    <h3 class="pageHeadings">Log in Page</h3>

    <form action="login.php" method="post">
        Email Address: <input type="text" name="email" required><br>
        Password: <input type="password" name="pwd" id="pwd" required><br>

        <input type="submit" value="Log in">
        <input type="reset" value="Clear">
    </form>

    <?php
    require_once("settings.php");
    $connection = mysqli_connect($host, $user, $password, $dbnm);

    $validEmail = false;
    $validPassword = false;
    
    if(isset($_POST['email'])){
        $email = $_POST["email"];
        
        echo $email."<br>";
        $sql = "select * from userdata where (email='$email');"; 
        $result = mysqli_query($connection, $sql);
                
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
                if($email==$row['email']){
                    $validEmail = true;
            
                }
            }        
        }
    
    if(isset($_POST['pwd'])){
        $pwd = encryptPwd($_POST['pwd']);
        
        $sql = "select password from userdata where (email='$email');";
        $result = mysqli_query($connection, $sql);
        
        echo "pwd: ".$pwd;
        
         if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
                if($pwd==$row['password']){
                    $validPassword = true;

                }
            }
    }
   
    
    if($validEmail && $validPassword){
        
        echo "Email: ".$email. "Pwd: ".$pwd;
        
         $query = "SELECT fname from userdata where(email='$email');";
            $result = mysqli_query($connection, $query);
                
            //get friend_id and save as session variable
                if(mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_assoc($result);
                    $fname = $row['fname'];
//                    
                }else{
                    echo "ERROR getting first name";
                }
        $query = "SELECT ID from userdata where(email='$email');";
            $result = mysqli_query($connection, $query);
                
            //get friend_id and save as session variable
                if(mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_assoc($result);
                    $id = $row['ID'];
//                    echo $row;
                }else{
                    echo "ERROR getting ID";
                }
    
        
        
        
        session_start();
        $_SESSION["loggedIn"] = "true";
        $_SESSION["user"] = $profile;
        $_SESSION["id"] = $id;
//        header("Location: index.php");
    }else{
        echo "Incorrect Email or Password <br>";
    }
    
    function encryptPwd($x){
            $pwd = md5($x);
            return $pwd;
        }
        
    ?>

    <!--    <a href="index.php">Home Page</a>-->


</body>

</html>

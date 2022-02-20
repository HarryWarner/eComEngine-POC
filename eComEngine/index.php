<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Web Application Development :: Assignment 3" />
    <meta name="keywords" content="Web,programming" />
    <title>My Friend System Registration Page</title>
    <link rel="stylesheet" href="style/styles.css">
</head>

<body>
    <h2 class="pageHeadings"> My Friends System Registration Page</h2>

    <p>Name: Harry Warner</p>
    <p>Email: 102561680@student.swin.edu.au</p><br>

    <p>I declare that this assignment is my individual work. I have not worked collaboratively nor have I copied from any other student's work or from any other source</p>

    <a href="signup.php">Sign up</a>
    <!--    to do-->
    <a href="login.php">Log in</a>
    <!--    to do-->
    <a href="about.php">About</a>


    <?php
    require_once ("settings.php");
    
    $connection = mysqli_connect($host, $user, $password, $dbnm);
    if(mysqli_connect_error()){
        die("connection failed: ".mysqli_connect_error());
    }
    echo "<br>connected successfully<br>";
    
    $query = "SELECT friend_id FROM friends";
    $result = mysqli_query($connection, $query);
    
    if(empty($result)){
         $query = "CREATE TABLE friends (
                          friend_id int(11) AUTO_INCREMENT NOT NULL,
                          friend_email varchar(50) NOT NULL,
                          password varchar(20) NOT NULL,
                          profile_name varchar(30) NOT NULL,
                          date_started date NOT NULL,
                          num_of_friends integer unsigned,
                          PRIMARY KEY (friend_id)
                          )";
                $result = mysqli_query($connection, $query);
    }
        
    $query = "SELECT friend_id1 from myfriends";
    $result = mysqli_query($connection, $query);
    
    if(empty($result)){
        $query = "CREATE TABLE myfriends(
                        friend_id1 int not null,
                        friend_id2 int not null
                        )";
                $result = mysqli_query($connection, $query);
    }
    
    echo "Tables successfully created and populated.";
    
    ?>
</body>

</html>

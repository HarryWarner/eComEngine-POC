<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Web Application Development :: Assignment 3" />
    <meta name="keywords" content="Web,programming" />
    <title>Logout Test</title>
    <link rel="stylesheet" href="style/styles.css">
</head>

<body>
    <?php
    session_unset();
    
    session_destroy();
    
    header("Location: index.php");
    
    ?>
</body>

</html>

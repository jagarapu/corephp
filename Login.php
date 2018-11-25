<?php
session_start();
$usernameE = $passwordE = '';
define('servername', 'localhost');
define('username', 'root');
define('password', '');
define('db', 'corephp');
$conn = mysqli_connect(servername, username, password, db);
error_reporting(0);
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}
$username = $password = $usernameE = $passwordE = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['username'])) {
        $usernameE = 'User name is required';
    } else {
        $username = mysqli_real_escape_string($conn, htmlspecialchars($_POST['username']));
        $sql = "SELECT username FROM login where username = '$username'";
        $row = mysqli_query($conn, $sql);
        $result = mysqli_num_rows($row);
        if ($result) {
            $usernameE = 'Username already exist';
        }
        if (preg_match('/^[a-zA-Z]{4,}$/', $_POST['username']) === 0) {
            $usernameE = 'Only letters and atleast four characters allowed';
        }
        $u = preg_match('/^[a-zA-Z]{4,}$/', $_POST['username']);
    }
    if (empty($_POST['password'])) {
        $passwordE = 'Password is required';
    } else {
        $password = mysqli_real_escape_string($conn, htmlspecialchars($_POST['password']));
        $sql = "SELECT password FROM login where password = '$password'";
        $row = mysqli_query($conn, $sql);
        $result1 = mysqli_num_rows($row);
        if ($result1) {
            $passwordE = 'Password already exist';
        }
        if (preg_match('/^[a-zA-Z]{4,}$/', $_POST['password']) === 0) {
            $passwordE = 'Only letters and atleast four characters allowed';
        }
        $p = preg_match('/^[a-zA-Z]{4,}$/', $_POST['password']);
    }
    if (($_POST['username']) && ($_POST['password'])) {

        $username = $_SESSION['username'] = $_POST['username'];
        $password = $_SESSION['password'] = $_POST['password'];
    }
}
if ($_POST['sub']) {
    if (empty($_POST['username'] && $_POST['password'] && $u && $p) || $result || $result1) {
        //echo 'fill all form fields.<br>';
    } else {
        $sql = "INSERT INTO login (username,password) VALUES ('" . $username . "','" . $password . "')";
        header('Location: Home.php');
    }
}
if ($conn->query($sql) === TRUE) {
    echo 'New record created successfully';
} else {
    // echo 'No records created';
}
$conn->close();
?>
<html>
    <head><b><h3><center>Login Form</center></h3></b>
    <body>
        <style>
            .error {color: red;}
        </style>
        <div align='center'>
        </head> 
        <form method = 'POST' action = ''>  
            <table>
                <tr><td>
                        <label for = 'uname'>Username:</label><span class = 'error'>* </td>
                    <td><input type = 'text' name = 'username' id ='uname' value = '<?php isset($username) ? print $username : ''; ?>'></span>
                        <span class = 'error'><?php isset($usernameE) ? print $usernameE : ''; ?></span></td></tr>

                <tr><td>
                        <label for = 'password'>Password:<span class = 'error'>*</td>
                                <td><input type = 'password' name = 'password'  id = 'password' value = '<?php isset($password) ? print $password : ''; ?>'></span>
                            <span class = 'error'><?php isset($passwordE) ? print $passwordE : ''; ?></span></tr></td>
                <tr><td><input type="submit" value="submit" name="sub"></td></tr>
            </table>
        </form>
    </div>
</body>
</html>   
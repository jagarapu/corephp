<?php
error_reporting(0);
$uname = $fname = $lname = $email = $password = $courses = '';
$unameE = $fnameE = $lnameE = $emailE = $passwordE = $coursesE = '';
$btech = $mca = $mtech = $others = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'corephp';
    $conn = mysqli_connect($servername, $username, $password, $db);
    if (!$conn) {
        die('Connection failed: ' . mysqli_connect_error());
    }
    if (empty($_POST['uname'])) {
        $unameE = 'User name is required';
    } else {
        $uname = htmlspecialchars($_POST['uname']);
        $sql = "SELECT username FROM sample1 where username = '$uname'";
        $row = mysqli_query($conn, $sql);
        $result = mysqli_num_rows($row);
        if ($result) {
            $unameE = 'Username already exist';
        }
        if (preg_match('/^[a-zA-Z]{4,}$/', $_POST['uname']) === 0) {
            $unameE = 'Only letters and atleast four characters allowed';
        }
        $u = preg_match('/^[a-zA-Z]{4,}$/', $_POST['uname']);
    }
    if (empty($_POST['fname'])) {
        $fnameE = 'Firstname is required';
    } else {
        $fname = htmlspecialchars($_POST['fname']);
        if (preg_match('/^[a-zA-Z]{4,}$/', $_POST['fname']) === 0) {
            $fnameE = 'Only letters and atleast four characters allowed';
        }
        $f = preg_match('/^[a-zA-Z]{4,}$/', $_POST['fname']);
    }
    if (empty($_POST['lname'])) {
        $lnameE = 'Lastname is required';
    } else {
        $lname = htmlspecialchars($_POST['lname']);
        if (preg_match('/^[a-zA-Z]{4,}$/', $_POST['lname']) === 0) {
            $lnameE = 'Only letters and atleast four characters allowed';
        }
        $l = preg_match('/^[a-zA-Z]{4,}$/', $_POST['lname']);
    }
    if (empty($_POST['email'])) {
        $emailE = 'Email is required';
    } else {
        $email = htmlspecialchars($_POST['email']);
        $sql = "SELECT email FROM sample1 where email = '$email'";
        $row = mysqli_query($conn, $sql);
        $result1 = mysqli_num_rows($row);
        if ($result1) {
            $emailE = 'Email already exist';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailE = 'Invalid email format';
        }
    }
    if (empty($_POST['password'])) {
        $passwordE = 'Password is required';
    } else {
        $password = htmlspecialchars($_POST['password']);
        if (preg_match('/^[a-zA-Z]{4,}$/', $_POST['password']) === 0) {
            $passwordE = 'Only letters and atleast four characters allowed';
        }
        $p = preg_match('/^[a-zA-Z]{4,}$/', $_POST['password']);
    }
    if (empty($_POST['courses'])) {
        $coursesE = 'Please select atleast one course';
    } else {
        $courses = $_POST['courses'];
    }
    if (isset($courses)) {
        foreach ((array) $courses as $course) {
            if ($course == 'B.tech') {
                $btech = 'checked';
            }
            if ($course == 'M.tech') {
                $mtech = 'checked';
            }
            if ($course == 'Mca') {
                $mca = 'checked';
            }
            if ($course == 'Others') {
                $others = 'checked';
            }
        }
    }
}
?>
<html>
    <head><b><h3>User Registration Form</h3></b>
    <style>
        .error {color: red;}
    </style>
</head> 
<body>
    <form method = 'POST' action = ''>  
        <table>
            <tr><td>
                    <label for = 'uname'>Username:</label><span class = 'error'>* </td>
                <td><input type = 'text' name = 'uname' id ='uname' value = '<?php echo $uname; ?>'></span>
                    <span class = 'error'><?php echo $unameE; ?></span></td></tr>
            <tr><td>
                    <label for = 'fname'>Firstname:<span class = 'error'>*</td>
                            <td><input type = 'text' name = 'fname' id = 'fname' value = '<?php echo $fname; ?>'></span>
                        <span class = 'error'><?php echo $fnameE; ?></span></td></tr>
            <tr><td>
                    <label for = 'lname'>Lastname:<span class = 'error'>*</td>
                            <td><input type = 'text' name = 'lname' id = 'lname' value = '<?php echo $lname; ?>'></span>
                        <span class = 'error'><?php echo $lnameE; ?></span></td></tr>
            <tr><td>
                    <label for = 'email'>Email:<span class = 'error'>*</td>
                            <td><input type = 'text' name = 'email' id = 'email' value = '<?php echo $email; ?>'></span>
                        <span class = 'error'><?php echo $emailE; ?></span> </tr></td>
            <tr><td>
                    <label for = 'password'>Password:<span class = 'error'>*</td>
                            <td><input type = 'password' name = 'password'  id = 'password' value = '<?php echo $password; ?>'></span>
                        <span class = 'error'><?php echo $passwordE; ?></span></tr></td>
            <tr><td>
                    <label for = 'courses'>Courses:<span class = 'error'>*</td>
                            <tr><td></td>
                                <td><input type = 'checkbox' name = 'courses[]' <?php echo $btech; ?> id = 'courses' value = 'B.tech'>B.tech </span>
                        <span class = 'error'><?php echo $coursesE; ?></span></td></tr> 
            <tr><td></td>
                <td><input type = 'checkbox' name = 'courses[]'  <?php echo $mca; ?> id = 'courses' value = 'Mca'>Mca</td></tr>                 
            <tr><td></td>
                <td><input type = 'checkbox' name = 'courses[]' <?php echo $mtech; ?> id = 'courses' value = 'M.tech'>M.tech</td></tr>    
            </td></tr></br>
            <tr><td></td>
                <td><input type = 'checkbox' name = 'courses[]' <?php echo $others; ?> id = 'courses' value = 'Others'>Others</td></tr>  
            <tr><td><input type="submit" value="submit" name="sub"></td></tr>
        </table>
    </form>
</body>
</html>   
<?php
error_reporting(0);
if ($_POST['sub']) {
    if (empty($_POST['uname'] && ($_POST['fname']) && ($_POST['lname']) && ($_POST['email']) &&
                    ($_POST['password']) && ($_POST['courses'] && $u && $f && $l && $p)) || $result || $result1) {
        echo 'fill all form fields.<br>';
    } else {
        $string = '';
        $test = implode(',', $_POST['courses']);
        $sql = "INSERT INTO sample (username,firstname, lastname, email,password,courses)
    VALUES ('" . $_POST["uname"] . "','" . $_POST["fname"] . "','" . $_POST["lname"] . "','" . $_POST["email"] . "','" . $_POST["password"] . "','" . $test . "')";
    }
}
if ($conn->query($sql) === TRUE) {
    echo 'New record created successfully';
    header('Location:saythanks.php');
    exit;
} else {
    echo 'No records created';
}
$conn->close();
?>


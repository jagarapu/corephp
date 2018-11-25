<html>  
    <body>  
        <form action="" method="post" enctype="multipart/form-data">  

            <table>  
                <tr>  
                    <td>Courses:</td>  
                </tr>  
                <tr>   
                    <td><input type="checkbox" name="Courses[]" value="B.tech"></td>
                    <td>B.tech</td> 
                </tr>  
                <tr>   
                    <td><input type="checkbox" name="Courses[]" value="Mca"></td>
                    <td>Mca</td> 
                </tr>  
                <tr>    
                    <td><input type="checkbox" name="Courses[]" value="M.tech"></td>
                    <td>M.tech</td>
                </tr>  
                <tr>  
                    <td><input type="checkbox" name="Courses[]" value="Others"></td> 
                    <td>Others</td>  
                </tr>  
                <tr>  
                    <td><input type="submit" value="submit" name="sub"></td>  
                </tr>  
            </table>  
        </div>  
    </form>  
    <?php
    if (isset($_POST['sub'])) {
        $host = "localhost"; //host name  
        $username = "root"; //database username  
        $password = "sowji"; //
        $db_name = "Practice"; //database name  
        $tbl_name = "request"; //table name  
        $con = mysqli_connect("$host", "$username", "$password", "$db_name");
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }
        echo "Connected successfully.<br>";


        $checkbox1 = $_POST['Courses'];
        $chk = "";
        foreach ($checkbox1 as $chk1) {
            $chk .= $chk1 . ",";
        }
        $in_ch = mysqli_query($con, "insert into request(courses) values ('$chk')");
        if ($in_ch == 1) {
            echo'<script>alert("Inserted Successfully")</script>';
        } else {
            echo'<script>alert("Failed To Insert")</script>';
        }
    }
    ?>  
</body>  
</html>  
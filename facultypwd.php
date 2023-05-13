<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="stylesheet" type="text/css" href="css/faculty.css">
        <link rel="stylesheet" type="text/css" href="css/facultymenu.css">
        <title> Change Password </title>
        <script type="text/javascript">
        </script>
    </head>
    <body>
        <?php
        session_start();
        $uid = $_SESSION['id'];
        if (empty($uid)) {
                        echo "<script>alert('Cant Press back'); location.href='home.php'</script>";
                }
        include 'db.php';
        include 'facultymenu.php';
        if(isset($_POST['change']))
        {
            $npass = $_POST['npass'];
            $cpass = $_POST['cpass'];
            if($npass === $cpass) // Sql@123, sql@123
            {
                $sql2 = "UPDATE faculty_details SET fpwd='$npass' WHERE fuid='$uid' ";
                if(mysqli_query($con, $sql2))
                {
                    echo '<script>alert("Password changed Successful"); location.href="facultypwd.php"</script>';
                }
            }
            else
            {
                echo '<script>alert("New Password and Current Password are not same"); location.href="facultypwd.php"</script>';
            }
        }

?>
    <div style="padding-top: 10px; justify-content: center; display: flex; ">
        <img src="Images/cp.png">
    </div>
    <form class="f1" action="" method="POST" autocomplete="off">
        <h3 class="h3">Change Password</h3>

        <label class="l1">New Password</label>
        <input class="i1" type="password" placeholder="Enter New Password" name="npass" required> <br>
            
        <label class="l1">Re-Enter New Password</label>
        <input class="i1" type="password" placeholder="Re-Enter New Password" name="cpass" required>
        
        <input class="submit" type="submit" name="change">
    </form>
    </body>
</html>
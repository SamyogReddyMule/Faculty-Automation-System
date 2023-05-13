<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Dashboard</title>
        <link rel="stylesheet" type="text/css" href="css/facultymenu.css">
        <link rel="stylesheet" type="text/css" href="css/faculty.css">
</head>
<body>
        <?php
                session_start();
                $uid = $_SESSION['id'];
                if (empty($uid)) {
                        echo "<script>alert('Cant Press back'); location.href='home.php'</script>";
                }
                include 'db.php';
                include 'adminmenu.php';
                if(isset($_POST['view']))
                {
                        $dep = $_POST['fdep'];
                        $a= "SELECT * FROM faculty_details where fdep = '$dep' ";
                        $ar = mysqli_query($con, $a);
                }
                $sql = "SELECT DISTINCT fdep FROM faculty_details";
                $sqlr = mysqli_query($con, $sql);

        ?>
        <form class="f1" id="f1" action="admin.php" method="POST" autocomplete="off" enctype="multipart/form-data">
                <h3 class="h3" >Select Department to View Faculty Details </h3>
                <label >Select Department </label>
                <select class="s1" name="fdep" >
                        <?php while ($sqld = mysqli_fetch_array($sqlr)) { ?>
                                <option value="<?php echo $sqld['fdep']; ?>"><?php echo $sqld['fdep']; ?></option> <?php } ?>
                </select>

                <input class="submit" type="submit"  name="view">
        </form>
        
</body>
</html>

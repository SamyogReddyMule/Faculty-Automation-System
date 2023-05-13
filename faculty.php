<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Faculty Dashboard</title>
        <link rel="stylesheet" type="text/css" href="css/facultymenu.css">
        <link rel="stylesheet" type="text/css" href="css/faculty.css">
</head>
<body>
        <?php
                session_start();
                include 'db.php';
                include 'loginmenu.php';
                if(isset($_POST['view']))
        {
                $dep = $_POST['fdep'];
                $a= "SELECT *FROM faculty_details where fdep = '$dep' ";
                $ar = mysqli_query($con, $a);
                
        }

        ?>
        <form class="f1" id="f1" action="facultyview.php" method="POST" autocomplete="off" enctype="multipart/form-data">
                
                <h3 class="h3" >Select Faculty to View Their Details </h3>

                <label > Select Faculty </label>

                <select class="s1" name="fuid" >
                        <?php while ($ad = mysqli_fetch_array($ar)) { ?>
                        <option value="<?php echo $ad['fuid']; ?>"><?php echo $ad['fname']."(".$ad['fuid'].")"; ?></option> <?php } ?>
                </select>
                <input class="submit" type="submit"  name="view">
        </form>

        
</body>
</html>

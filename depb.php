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
                $dep = $_SESSION['id'];
                if (empty($uid)) {
                        echo "<script>alert('Cant Press back'); location.href='home.php'</script>";
                }
                include 'db.php';
                include 'depmenu.php';
                $sql = "SELECT fuid, fdob FROM faculty_details where fdep='$dep'";
                $sqlr = mysqli_query($con, $sql);
                while ($sqld = mysqli_fetch_array($sqlr))
                {
                        $fuid = $sqld['fuid'];
                        $fdob = $sqld['fdob'];
                        $ftoday = date('Y-m-d');
                        $fage = date_diff(date_create("$fdob"), date_create("$ftoday"))->format('%y Years');
                        mysqli_query($con, "UPDATE faculty_details set fage='$fage' where fuid='$fuid' ");
                }
                $sql1 = "SELECT expid, ejyear FROM experience where ename='Sir C R Reddy College of Engineering' ";
                $sqlr1 = mysqli_query($con, $sql1);
                while ($sqld1 = mysqli_fetch_array($sqlr1))
                {
                        $expid = $sqld1['expid'];
                        $ejyear = $sqld1['ejyear'];
                        $eyear = date('Y');
                        $eexp = intval($eyear) - intval($ejyear);
                        mysqli_query($con, "UPDATE experience set eeyear='$eyear', etime='$eexp' where expid='$expid' ");
                }
                while ($sqld1 = mysqli_fetch_array($sqlr1))
                {
                        $expid = $sqld1['expid'];
                        $ejyear = $sqld1['ejyear'];
                        $eyear = date('Y');
                        $eexp = intval($eyear) - intval($ejyear);
                        mysqli_query($con, "UPDATE experience set eeyear='$eyear', etime='$eexp' where expid='$expid' ");
                }
                $f = "SELECT fuid, fname FROM faculty_details WHERE fdep='CSE'";
                $fr = mysqli_query($con, $f);
                $a = "SELECT fuid, fname FROM faculty_details WHERE fdep='$dep'";
                $ar = mysqli_query($con, $a);

        ?>
        <form class="f1" action="adminprint.php" method="POST" autocomplete="off" enctype="multipart/form-data">
                
                <h3 class="h3" > Select  Faculty to Print Details </h3>

                <label > Select Faculty </label>

                <select class="s1" name="fuid" >
                        <?php while ($ad = mysqli_fetch_array($ar)) { ?>
                        <option value="<?php echo $ad['fuid']; ?>"><?php echo $ad['fname']."(".$ad['fuid'].")"; ?></option> <?php } ?>
                </select>
                <input class="submit" type="submit" formtarget="_blank" name="view">
        </form>
        
</body>
</html>

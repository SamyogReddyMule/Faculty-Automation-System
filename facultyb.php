<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Faculty Dashboard</title>
        <link rel="stylesheet" type="text/css" href="css/facultymenu.css">
        <link rel="stylesheet" type="text/css" href="css/faculty.css">
        <style type="text/css">
                .center {
                        padding-top: 10px;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                }
        </style>
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
                $sql = "SELECT fuid, fdob FROM faculty_details";
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
                if(date('m') >= '07')
                {
                        $d1 = date('Y').'-'.date('y')+1;
                        $d2 = (date('Y')-1).'-'.date('y');
                        $d3 = (date('Y')-2).'-'.date('y')-1;
                }
                if(date('m') <= '07')
                {
                        $d1 = (date('Y')-1).'-'.date('y');
                        $d2 = (date('Y')-2).'-'.date('y')-1;
                        $d3 = (date('Y')-3).'-'.date('y')-2;
                }
        ?>
        <form class="f1" action="" method="POST" autocomplete="off" enctype="multipart/form-data">
                <h3> Statistics </h3>
                <label > Select Academic Year </label>

                <select class="s1" name="year" >
                        <option value="all">Last 3 Acedamic Details</option>
                        <option value="<?php echo $d1; ?>"><?php echo $d1; ?></option>
                        <option value="<?php echo $d2; ?>"><?php echo $d2; ?></option>
                        <option value="<?php echo $d3; ?>"><?php echo $d3; ?></option>
                </select>
                <input class="submit" type="submit" name="view">
        </form>
        <?php
                if(isset($_POST['view']))
                {
                        $a = $_POST['year'];
                        if(date('m') >= '07')
                        {
                                $b1 = date('Y').'-'.date('y')+1;
                                $b2 = (date('Y')-1).'-'.date('y');
                                $b3 = (date('Y')-2).'-'.date('y')-1;
                        }
                        if(date('m') <= '07')
                        {
                                $b1 = (date('Y')-1).'-'.date('y');
                                $b2 = (date('Y')-2).'-'.date('y')-1;
                                $b3 = (date('Y')-3).'-'.date('y')-2;
                        }
                        if ($a === 'all') {
                                $w1 = mysqli_num_rows(mysqli_query($con, "SELECT * FROM certifications where cuid = '$uid' and ctype = 'Workshop' and cyear='$b1' "));
                                $w2 = mysqli_num_rows(mysqli_query($con, "SELECT * FROM certifications where cuid = '$uid' and ctype = 'Workshop' and cyear='$b2' "));
                                $w3 = mysqli_num_rows(mysqli_query($con, "SELECT * FROM certifications where cuid = '$uid' and ctype = 'Workshop' and cyear='$b3' "));
                                $w4 = mysqli_num_rows(mysqli_query($con, "SELECT * FROM certifications where cuid = '$uid' and ctype = 'Workshop' and cyear='$b1' or cyear='$b2' or cyear='$b3' "));

                                $c1 = mysqli_num_rows(mysqli_query($con, "SELECT * FROM certifications where cuid = '$uid' and ctype = 'Course' and cyear='$b1' "));
                                $c2 = mysqli_num_rows(mysqli_query($con, "SELECT * FROM certifications where cuid = '$uid' and ctype = 'Course' and cyear='$b2' "));
                                $c3 = mysqli_num_rows(mysqli_query($con, "SELECT * FROM certifications where cuid = '$uid' and ctype = 'Course' and cyear='$b3' "));
                                $c4 = mysqli_num_rows(mysqli_query($con, "SELECT * FROM certifications where cuid = '$uid' and ctype = 'Course' and cyear='$b1' or cyear='$b2' or cyear='$b3' "));

                                $s1 = mysqli_num_rows(mysqli_query($con, "SELECT * FROM certifications where cuid = '$uid' and ctype = 'Seminar' and cyear='$b1' "));
                                $s2 = mysqli_num_rows(mysqli_query($con, "SELECT * FROM certifications where cuid = '$uid' and ctype = 'Seminar' and cyear='$b2' "));
                                $s3 = mysqli_num_rows(mysqli_query($con, "SELECT * FROM certifications where cuid = '$uid' and ctype = 'Seminar' and cyear='$b3' "));
                                $s4 = mysqli_num_rows(mysqli_query($con, "SELECT * FROM certifications where cuid = '$uid' and ctype = 'Seminar' and cyear='$b1' or cyear='$b2' or cyear='$b3' "));


                                $cc1 = mysqli_num_rows(mysqli_query($con, "SELECT * FROM certifications where cuid = '$uid' and ctype = 'Conference' and cyear='$b1' "));
                                $cc2 = mysqli_num_rows(mysqli_query($con, "SELECT * FROM certifications where cuid = '$uid' and ctype = 'Conference' and cyear='$b2' "));
                                $cc3 = mysqli_num_rows(mysqli_query($con, "SELECT * FROM certifications where cuid = '$uid' and ctype = 'Conference' and cyear='$b3' "));
                                $cc4 = mysqli_num_rows(mysqli_query($con, "SELECT * FROM certifications where cuid = '$uid' and ctype = 'Conference' and cyear='$b1' or cyear='$b2' or cyear='$b3' "));

                                $p1 = mysqli_num_rows(mysqli_query($con, "SELECT * FROM certifications where cuid = '$uid' and ctype = 'Paper Publication'  and cyear='$b1' "));
                                $p2 = mysqli_num_rows(mysqli_query($con, "SELECT * FROM certifications where cuid = '$uid' and ctype = 'Paper Publication'  and cyear='$b2' "));
                                $p3 = mysqli_num_rows(mysqli_query($con, "SELECT * FROM certifications where cuid = '$uid' and ctype = 'Paper Publication'  and cyear='$b3' "));
                                $p4 = mysqli_num_rows(mysqli_query($con, "SELECT * FROM certifications where cuid = '$uid' and ctype = 'Paper Publication'  and cyear='$b1' or cyear='$b2' or cyear='$b3' "));

                                echo '<table class = "cert">';
                                echo '<tr>';
                                echo '<th> Type/Year </th>
                                <th>'.$b1.'</th>
                                <th>'.$b2.'</th>
                                <th>'.$b3.'</th>
                                <th> Total </th>';
                                echo '</tr>';

                                echo '<tr>';
                                echo '<td> Workshop </td>
                                <th>'.$w1.'</th>
                                <th>'.$w2.'</th>
                                <th>'.$w3.'</th>
                                <th>'.$w4.'</th>';
                                echo '</tr>';

                                echo '<tr>';
                                echo '<td> Course </td>
                                <th>'.$c1.'</th>
                                <th>'.$c2.'</th>
                                <th>'.$c3.'</th>
                                <th>'.$c4.'</th>';
                                echo '</tr>';

                                echo '<tr>';
                                echo '<td> Seminar </td>
                                <th>'.$s1.'</th>
                                <th>'.$s2.'</th>
                                <th>'.$s3.'</th>
                                <th>'.$s4.'</th>';
                                echo '</tr>';

                                echo '<tr>';
                                echo '<td> Conference </td>
                                <th>'.$cc1.'</th>
                                <th>'.$cc2.'</th>
                                <th>'.$cc3.'</th>
                                <th>'.$cc4.'</th>';
                                echo '</tr>';

                                echo '<tr>';
                                echo '<td> Paper Publications </td>
                                <th>'.$p1.'</th>
                                <th>'.$p2.'</th>
                                <th>'.$p3.'</th>
                                <th>'.$p4.'</th>';
                                echo '</tr>';

                                echo '</table>';
                        }
                        if($a === $b1 || $a === $b2 || $a === $b3 )
                        {
                                $a1 = mysqli_num_rows(mysqli_query($con, "SELECT * FROM certifications where cuid = '$uid' and ctype = 'Workshop' and cyear='$a' "));
                                $a2 = mysqli_num_rows(mysqli_query($con, "SELECT * FROM certifications where cuid = '$uid' and ctype = 'Course' and cyear='$a' "));
                                $a3 = mysqli_num_rows(mysqli_query($con, "SELECT * FROM certifications where cuid = '$uid' and ctype = 'Seminar' and cyear='$a' "));
                                $a4 = mysqli_num_rows(mysqli_query($con, "SELECT * FROM certifications where cuid = '$uid' and ctype = 'Conference' and cyear='$a' "));
                                $a5 = mysqli_num_rows(mysqli_query($con, "SELECT * FROM certifications where cuid = '$uid' and ctype = 'Paper Publication' and cyear='$a' "));
                                $a6 = mysqli_num_rows(mysqli_query($con, "SELECT * FROM certifications where cuid = '$uid' and cyear='$a' "));

                                echo '<table class = "cert">';
                                echo '<tr>';
                                echo '<th> Type/Year </th>
                                <th>'.$a.'</th>';
                                echo '</tr>';

                                echo '<tr>';
                                echo '<th> Workshop </th>
                                <th>'.$a1.'</th>';
                                echo '</tr>';

                                echo '<tr>';
                                echo '<th> Course </th>
                                <th>'.$a2.'</th>';
                                echo '</tr>';

                                echo '<tr>';
                                echo '<th> Seminar </th>
                                <th>'.$a3.'</th>';
                                echo '</tr>';

                                echo '<tr>';
                                echo '<th> Conference </th>
                                <th>'.$a4.'</th>';
                                echo '</tr>';

                                echo '<tr>';
                                echo '<th> Paper Publications </th>
                                <th>'.$a5.'</th>';
                                echo '</tr>';

                                echo '<tr>';
                                echo '<th> Total </th>
                                <th>'.$a6.'</th>';
                                echo '</tr>';

                                echo '</table>';

                        }
                }
        ?>
</body>
</html>

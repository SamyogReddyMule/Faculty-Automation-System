<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> View Faculty Details </title>
        <link rel="stylesheet" type="text/css" href="css/faculty.css">
        <style type="text/css">
                table, th, tr, td {
                        border: 1px solid black;
                        margin-left: auto;
                        margin-right: auto;
                        
                }
                h3 {

                        width: 20%;
                        text-align: center;
                        color:red;
                }
                h3.h2{
                        width: 40%;
                        font-size: 32px;
                        font-weight: 500;
                        line-height: 42px;
                        text-align: center;
                        color: darkviolet;
                }
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
        include 'db.php';
	include 'menu.php';
        if(isset($_POST['view']))
        {
                $fuid = $_POST['fuid'];
                $dt = "SELECT *FROM faculty_details where fuid='$fuid' ";
                $dtr = mysqli_query($con, $dt);
                $dd = mysqli_fetch_array($dtr);

                $ed = "SELECT *FROM education where euid='$fuid' ";
                $edr = mysqli_query($con, $ed);

                $ex = "SELECT *FROM experience where expid='$fuid' ";
                $exr = mysqli_query($con, $ex);

                $w = "SELECT * FROM certifications where cuid = '$fuid' and ctype = 'Workshop' ";
                $wr = mysqli_query($con, $w);

                $c = "SELECT * FROM certifications where cuid = '$fuid' and ctype = 'Course' ";
                $cr = mysqli_query($con, $c);

                $s = "SELECT * FROM certifications where cuid = '$fuid' and ctype = 'Seminar' ";
                $sr = mysqli_query($con, $s);

                $cc = "SELECT * FROM certifications where cuid = '$fuid' and ctype = 'Conference' ";
                $ccr = mysqli_query($con, $cc);

                $p = "SELECT * FROM certifications where cuid = '$fuid' and ctype = 'Paper Publication' ";
                $pr = mysqli_query($con, $p);

                $b = "SELECT * FROM certifications where cuid = '$fuid' and ctype = 'Books' ";
		$br = mysqli_query($con, $b);

                $a = "SELECT * FROM awards where cuid = '$fuid'";
                $ar = mysqli_query($con, $a);

                $pa = "SELECT *FROM patents where cuid='$fuid' ";
                $par = mysqli_query($con, $pa);

                $pjs = "SELECT * FROM projects where cuid = '$fuid' and ctype = 'Sponsored' ";
                $pjsr = mysqli_query($con, $pjs);

                $pjc = "SELECT * FROM projects where cuid = '$fuid' and ctype = 'Consultancy' ";
		$pjcr = mysqli_query($con, $pjc);

                $me = "SELECT * FROM memberships where cuid = '$fuid'";
                $mer = mysqli_query($con, $me);

                $re = "SELECT *FROM responsibilities where cuid='$fuid' ";
                $rer = mysqli_query($con, $re);

        ?>
                <h3 class="h2"  > Personal Details </h3>
                <table id="t1"  class="cert">
                        <tr>
                                <td> Unique ID </td>
                                <th> <?php echo $dd['fuid']; ?> </th>
                        </tr>
                        <tr>
                                <td> Name </td>
                                <th> <?php echo $dd['fname']; ?> </th>
                        </tr>
                        <tr>
                                <td> Designation </td>
                                <th> <?php echo $dd['fdes']; ?> </th>
                        </tr>
                        <tr>
                                <td> Department </td>
                                <th> <?php echo $dd['fdep']; ?> </th>
                        </tr>
                        <tr>
                                <td> Date of Birth </td>
                                <th> <?php echo $dd['fdob']; ?> </th>
                        </tr>
                        <tr>
                                <td> Gender </td>
                                <th> <?php echo $dd['fgen']; ?> </th>
                        </tr>
                        <tr>
                                <td> Phone Number </td>
                                <th> <?php echo $dd['fphn']; ?> </th>
                        </tr>
                        <tr>
                                <td> Email </td>
                                <th> <?php echo $dd['femail']; ?> </th>
                        </tr>
                        <tr>
                                <td> Address </td>
                                <th> <?php echo $dd['faddress']; ?> </th>
                        </tr>
                </table>
                <h3 class="h2" > Education </h3>
                <table id="t1" class="cert">
                        <tr>
                                <th> School/College </th>
                                <th> Board/University </th>
                                <th> Program </th>
                                <th> Branch </th>
                                <th> Year of Passout </th>
                                <th> Percentage </th>
                        </tr>
                        <?php
                        while ($edud = mysqli_fetch_array($edr))
                        {
                                echo '<tr>
                                <td> '.$edud["edname"].' </td>
                                <td> '.$edud["edboard"].' </td>
                                <td> '.$edud["edprogram"].' </td>
                                <td> '.$edud["edbranch"].' </td>
                                <td> '.$edud["edpyear"].' </td>
                                <td> '.$edud["edpcntg"].' </td>
                                </tr>';
                        }
                        ?>
                </table>
                <h3 class="h2"  > Experience </h3>
                <table id="t1" class="cert">
                        <tr>
                                <th> School/College </th>
                                <th> Designation </th>
                                <th> Year of Joining </th>
                                <th> Year of Ending </th>
                                <th> Experience in Years </th>
                        </tr>
                        <?php
                        while ($expd = mysqli_fetch_array($exr))
                        {
                                echo '<tr>
                                <td> '.$expd["ename"].' </td>
                                <td> '.$expd["edes"].' </td>
                                <td> '.$expd["ejyear"].' </td>
                                <td> '.$expd["eeyear"].' </td>
                                <td> '.$expd["etime"].' </td>
                                </tr>';
                        }
                        ?>
                </table>
	

                
                <h3 class="h2"  > Workshop </h3>
                <table id="t1" class="cert">
                        <tr>
                                <th> Title </th>
                                <th> Year </th>
                                <th> Duration </th>
                                <th> Start </th>
                                <th> End </th>
                        </tr>
                        <?php
                        while ($wd = mysqli_fetch_array($wr))
                        {
                                echo '<tr>
                                <td> '.$wd["cname"].' </td>
                                <td> '.$wd["cyear"].' </td>
                                <td> '.$wd["cdur"].' </td>
                                <td> '.$wd["cstart"].' </td>
                                <td> '.$wd["cend"].' </td>
                                </tr>';
                        }
                        ?>
                </table>
                <h3 class="h2"  > Certifications / Course </h3>
                <table id="t1" class="cert">
                        <tr>
                                <th> Title </th>
                                <th> Year </th>
                                <th> Duration </th>
                                <th> Start </th>
                                <th> End </th>
                        </tr>
                        <?php
                        while ($cd = mysqli_fetch_array($cr))
                        {
                                echo '<tr>
                                <td> '.$cd["cname"].' </td>
                                <td> '.$cd["cyear"].' </td>
                                <td> '.$cd["cdur"].' </td>
                                <td> '.$cd["cstart"].' </td>
                                <td> '.$cd["cend"].' </td>
                                </tr>';
                        }
                        ?>
                </table>
                <h3 class="h2"  > Seminar </h3>
                <table id="t1" class="cert">
                        <tr>
                                <th> Title </th>
                                <th> Year </th>
                                <th> Duration </th>
                                <th> Start </th>
                                <th> End </th>
                        </tr>
                        <?php
                        while ($sd = mysqli_fetch_array($sr))
                        {
                                echo '<tr>
                                <td> '.$sd["cname"].' </td>
                                <td> '.$sd["cyear"].' </td>
                                <td> '.$sd["cdur"].' </td>
                                <td> '.$sd["cstart"].' </td>
                                <td> '.$sd["cend"].' </td>
                                </tr>';
                        }
                        ?>
                </table>
                <h3 class="h2"  > Conference </h3>
                <table id="t1" class="cert">
                        <tr>
                                <th> Title </th>
                                <th> Year </th>
                                <th> Name of the Journal / Conference </th>
                                <th> Volume </th>
                                <th> UGC / SCOPUS / SCI Indexed </th>
                        </tr>
                        <?php
                        while ($ccd = mysqli_fetch_array($ccr))
                        {
                                echo '<tr>
                                <td> '.$ccd["cname"].' </td>
                                <td> '.$ccd["cyear"].' </td>
                                <td> '.$ccd["cjournal"].' </td>
                                <td> '.$ccd["cvol"].' </td>
                                <td> '.$ccd["cindex"].' </td>
                                </tr>';
                        }
                        ?>
                </table>
                <h3 class="h2"  > Paper Publications </h3>
                <table id="t1" class="cert">
                        <tr>
                                <th> Title </th>
                                <th> Year </th>
                                <th> Name of the Journal / Conference </th>
                                <th> Volume </th>
                                <th> UGC / SCOPUS / SCI Indexed </th>
                        </tr>
                        <?php
                        while ($pd = mysqli_fetch_array($pr))
                        {
                                echo '<tr>
                                <td> '.$pd["cname"].' </td>
                                <td> '.$pd["cyear"].' </td>
                                <td> '.$pd["cjournal"].' </td>
                                <td> '.$pd["cvol"].' </td>
                                <td> '.$pd["cindex"].' </td>
                                </tr>';
                        }
                        ?>
                </table>
                <h3 class="h2"> Books </h3>
	        <table id="t1" class="cert">
		<tr>
			<th> Title </th>
			<th> Year </th>
			<th> Name of the Journal/Conference </th>
			<th> Volume </th>
			<th> UGC/SCOPUS/SCI Indexed </th>
		</tr>
 		<?php
			while ($bd = mysqli_fetch_array($br))
			{
				echo '<tr>
				<td> '.$bd["cname"].' </td>
				<td> '.$bd["cyear"].' </td>
				<td> '.$bd["cjournal"].' </td>
				<td> '.$bd["cvol"].' </td>
				<td> '.$bd["cindex"].' </td>
               	</tr>';
          	}
		?>
	        </table>
                <h3 class="h2"> Awards </h3>
	        <table id="t1" class="cert">
                <tr>
                        <th> Title </th>
			<th> Acedamic Year</th>
			<th> Awarded by</th>
			<th> Contribution</th>
		</tr>
                <?php
		
			while($ad = mysqli_fetch_array($ar))
			{
					echo '<tr>
					<td> '.$ad["cname"].' </td>
					<td> '.$ad["cyear"].' </td>
					<td> '.$ad["caward"].' </td>
					<td> '.$ad["ccontribution"].' </td>
               		</tr>';
      		}
                ?>
                </table>
                <h3 class="h2"> Patents </h3>'          
		<table id="t1" class="cert">'
                <tr>
                        <th> Title </th>
			<th> Application Number</th>
		        <th> Position </th>
                        <th> Year </th>
		</tr>
                <?php
                while($pad = mysqli_fetch_array($par))
			{
					echo '<tr>
						<td> '.$pad["cname"].' </td>
						<td> '.$pad["cnumber"].' </td>
						<td> '.$pad["cpos"].' </td>
						<td> '.$pad["cyear"].' </td>
               		</tr>';
      		}
                ?>
                </table>
                <h3 class="h2"> Memberships </h3>
	        <table id="t1" class="cert">
                <tr>
                        <th> Title </th>
			<th> Membership Number</th>
			<th> Membership Type</th>
		</tr>
                <?php
		
			while($merd = mysqli_fetch_array($mer))
			{
					echo '<tr>
					<td> '.$merd["cname"].' </td>
					<td> '.$merd["cnumber"].' </td>
					<td> '.$merd["ctype"].' </td>
               		</tr>';
      		}
                ?>
                </table>
                <h3 class="h2"> Responsibilities </h3>
	        <table id="t1" class="cert">
                <tr>
                        <th> Description </th>
			<th> Level</th>
		</tr>
                <?php
		
			while($red = mysqli_fetch_array($rer))
			{
					echo '<tr>
					<td> '.$red["cdescription"].' </td>
					<td> '.$red["clevel"].' </td>
               		</tr>';
      		}
                ?>
                </table>
                <h3 class="h2"> Sponsored Projects </h3>
	        <table id="t1" class="cert">
                <tr>
                        <th> Title </th>
			<th> Sponsored by</th>
			<th> Amount</th>
			<th> Period</th>
                        <th> Status</th>
		</tr>
                <?php
		
			while($pjsd = mysqli_fetch_array($pjsr))
			{
					echo '<tr>
					<td> '.$pjsd["cname"].' </td>
					<td> '.$pjsd["cperson"].' </td>
					<td> '.$pjsd["camount"].' </td>
					<td> '.$pjsd["cperiod"].' </td>
                                        <td> '.$pjsd["cstatus"].' </td>
               		</tr>';
      		}
                ?>
                </table>
                <h3 class="h2"> Consultancy Projects </h3>
	        <table id="t1" class="cert">
                <tr>
                        <th> Title </th>
			<th> Agency</th>
			<th> amount</th>
			<th> Period</th>
                        <th> Status</th>
		</tr>
                <?php
		
			while($pjcd = mysqli_fetch_array($pjcr))
			{
					echo '<tr>
					<td> '.$pjcd["cname"].' </td>
					<td> '.$pjcd["cperson"].' </td>
					<td> '.$pjcd["camount"].' </td>
					<td> '.$pjcd["cperiod"].' </td>
                                        <td> '.$pjcd["cstatus"].' </td>
               		</tr>';
      		}
                ?>
                </table>
        <?php } ?>
        
</body>
</html>
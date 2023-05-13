<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Achievements</title>
	<link rel="stylesheet" type="text/css" href="css/faculty.css">
	<link rel="stylesheet" type="text/css" href="css/facultymenu.css">
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
	?>
		<h3 class="h2"> Awards</h3>
		<table id="t1" class="cert">
		<tr>
            <th> Title </th>
			<th> Acedamic Year</th>
			<th> Awarded by</th>
			<th> Contribution</th>
			<th> File </th>
		</tr>	
		<?php
		$f = " SELECT fuid, fname FROM faculty_details ";
		$fr = mysqli_query($con, $f);
		while($fd = mysqli_fetch_array($fr))
		{
			echo '<tr> <th colspan="6" style="background-color: grey; ">'.$fd["fname"].'</th></tr>';
			$sid = $fd["fuid"];
			$s = " SELECT *FROM awards where cuid='$sid' ";
			$sr = mysqli_query($con, $s);
			while($sd = mysqli_fetch_array($sr))
			{
					echo '<tr>
					<td> '.$sd["cname"].' </td>
					<td> '.$sd["cyear"].' </td>
					<td> '.$sd["caward"].' </td>
					<td> '.$sd["ccontribution"].' </td>
					<td> <a href="certs/'.$sd["cfile"].'" target="_blank"> '.$sd["cfile"].' </td>
               		</tr>';
      		}
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
			    <th> File </th>
			</tr>
        <?php
		$f1 = " SELECT fuid, fname FROM faculty_details ";
		$fr1 = mysqli_query($con, $f1);
		while($fd1 = mysqli_fetch_array($fr1))
		{
			echo '<tr> <th colspan="6" style="background-color: grey; ">'.$fd1["fname"].'</th></tr>';
			$sid = $fd1["fuid"];
			$s1 = " SELECT *FROM patents where cuid='$sid' ";
			$sr1 = mysqli_query($con, $s1);
			while($ld = mysqli_fetch_array($sr1))
			{
					echo '<tr>
						<td> '.$ld["cname"].' </td>
						<td> '.$ld["cnumber"].' </td>
						<td> '.$ld["cpos"].' </td>
						<td> '.$ld["cyear"].' </td>
						<td> <a href="certs/'.$ld["cfile"].'" target="_blank"> '.$ld["cfile"].' </td>
               		</tr>';
      		}
      	}
        ?>
        </table>

		<h3 class="h2"> Memberships </h3>'
		<table id="t1" class="cert">'
	
			<tr>
                <th> Title </th>
			    <th> Membership Number</th>
			    <th> Membership Type </th>
			    <th> File </th>
			</tr>
        <?php
		$f1 = " SELECT fuid, fname FROM faculty_details ";
		$fr1 = mysqli_query($con, $f1);
		while($fd1 = mysqli_fetch_array($fr1))
		{
			echo '<tr> <th colspan="6" style="background-color: grey; ">'.$fd1["fname"].'</th></tr>';
			$sid = $fd1["fuid"];
			$s1 = " SELECT *FROM memberships where cuid='$sid' ";
			$sr1 = mysqli_query($con, $s1);
			while($ld = mysqli_fetch_array($sr1))
			{
					echo '<tr>
						<td> '.$ld["cname"].' </td>
						<td> '.$ld["cnumber"].' </td>
						<td> '.$ld["ctype"].' </td>
						<td> <a href="certs/'.$ld["cfile"].'" target="_blank"> '.$ld["cfile"].' </td>
               		</tr>';
      		}
      	}
        ?>
        </table>

      	<h3 class="h2"> Books </h3>
		<table id="t1" class="cert">
			<tr>
                <th> Name </th>
			    <th> Year </th>
			    <th> Name of the Journal/Conference </th>
			    <th> Volume </th>
			    <th> UGC/SCOPUS/SCI Indexed </th>
				<th> File </th>
			</tr>
        <?php
		$f2 = " SELECT fuid, fname FROM faculty_details ";
		$fr2 = mysqli_query($con, $f2);
		while($fd2 = mysqli_fetch_array($fr2))
		{
			echo '<tr> <th colspan="8" style="background-color: grey; ">'.$fd2["fname"].'</th></tr>';
			$sid = $fd2["fuid"];
			$s2 = " SELECT *FROM certifications where cuid='$sid' and ctype = 'Books'";
			$sr2 = mysqli_query($con, $s2);
			while($wd = mysqli_fetch_array($sr2))
			{
					echo '<tr>
					<td> '.$wd["cname"].' </td>
					<td> '.$wd["cyear"].' </td>
					<td> '.$wd["cjournal"].' </td>
					<td> '.$wd["cvol"].' </td>
					<td> '.$wd["cindex"].' </td>
					<td> <a href="certs/'.$wd["cfile"].'" target="_blank"> '.$wd["cfile"].' </td>
            		</tr>';
			}
      	}
		?>
		</table>
		<table>
		<h3 class="h2"> Responsibilities</h3>
		<table id="t1" class="cert">
		<tr>
            <th> Description </th>
			<th> Level</th>
		</tr>	
		<?php
		$f3 = " SELECT fuid, fname FROM faculty_details ";
		$fr3 = mysqli_query($con, $f3);
		while($fd3 = mysqli_fetch_array($fr3))
		{
			echo '<tr> <th colspan="6" style="background-color: grey; ">'.$fd3["fname"].'</th></tr>';
			$sid = $fd3["fuid"];
			$s3 = " SELECT *FROM responsibilities where cuid='$sid' ";
			$sr3 = mysqli_query($con, $s3);
			while($sd = mysqli_fetch_array($sr3))
			{
					echo '<tr>
					<td> '.$sd["cdescription"].' </td>
					<td> '.$sd["clevel"].' </td>
               		</tr>';
      		}
      	}
        ?>
      	</table>

		  <h3 class="h2"> Sponsored Projects</h3>'
		<table id="t1" class="cert">'
	
			<tr>
                <th> Title </th>
			    <th> Sponsored by</th>
			    <th> Amount </th>
                <th> Period </th>
			    <th> File </th>
			</tr>
        <?php
		$f1 = " SELECT fuid, fname FROM faculty_details ";
		$fr1 = mysqli_query($con, $f1);
		while($fd1 = mysqli_fetch_array($fr1))
		{
			echo '<tr> <th colspan="6" style="background-color: grey; ">'.$fd1["fname"].'</th></tr>';
			$sid = $fd1["fuid"];
			$s1 = " SELECT *FROM projects where cuid='$sid' and ctype='Sponsored' ";
			$sr1 = mysqli_query($con, $s1);
			while($ld = mysqli_fetch_array($sr1))
			{
					echo '<tr>
						<td> '.$ld["cname"].' </td>
						<td> '.$ld["cperson"].' </td>
						<td> '.$ld["camount"].' </td>
						<td> '.$ld["cperiod"].' </td>
						<td> <a href="certs/'.$ld["cfile"].'" target="_blank"> '.$ld["cfile"].' </td>
               		</tr>';
      		}
      	}
        ?>
        </table>

		<h3 class="h2"> Consultancy Projects </h3>'
		<table id="t1" class="cert">'
	
			<tr>
				<th> Title </th>
			    <th> Sponsored by</th>
			    <th> Amount </th>
                <th> Period </th>
			    <th> File </th>
			</tr>
        <?php
		$f1 = " SELECT fuid, fname FROM faculty_details ";
		$fr1 = mysqli_query($con, $f1);
		while($fd1 = mysqli_fetch_array($fr1))
		{
			echo '<tr> <th colspan="6" style="background-color: grey; ">'.$fd1["fname"].'</th></tr>';
			$sid = $fd1["fuid"];
			$s1 = " SELECT *FROM projects where cuid='$sid' and ctype='Consultancy' ";
			$sr1 = mysqli_query($con, $s1);
			while($ld = mysqli_fetch_array($sr1))
			{
					echo '<tr>
						<td> '.$ld["cname"].' </td>
						<td> '.$ld["cperson"].' </td>
						<td> '.$ld["camount"].' </td>
						<td> '.$ld["cperiod"].' </td>
						<td> <a href="certs/'.$ld["cfile"].'" target="_blank"> '.$ld["cfile"].' </td>
               		</tr>';
      		}
      	}
        ?>
        </table>
	
	</body>
</html>
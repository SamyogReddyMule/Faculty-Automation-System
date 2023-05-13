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
		include 'facultymenu.php';
	?>
		<?php
			$s = "SELECT * FROM awards where cuid = '$uid' ORDER BY cyear DESC  ";
			$sr = mysqli_query($con, $s);
			$sc = mysqli_num_rows($sr);
			if(date('m') >= '06')
			{
				$date = date('Y').'-'.date('y')+1;
			}
			else
			{
				$date = (date('Y')-1).'-'.date('y');
			}
			$l = "SELECT * FROM patents where cuid = '$uid' ORDER BY cyear DESC ";
			$lr = mysqli_query($con, $l);
			$lc = mysqli_num_rows($lr);

			$w = "SELECT * FROM certifications where cuid = '$uid'  and ctype='Books' order by cyear asc";
			$wr = mysqli_query($con, $w);
			$wc = mysqli_num_rows($wr);

			$me = "SELECT * FROM memberships where cuid = '$uid'  ";
			$mer = mysqli_query($con, $me);
			$mec = mysqli_num_rows($mer);

			$r = "SELECT * FROM responsibilities where cuid = '$uid'  ";
			$rr = mysqli_query($con, $r);
			$rc = mysqli_num_rows($rr);

			$ps = "SELECT * FROM projects where cuid = '$uid'  and ctype = 'Sponsored' ORDER BY cperiod  ";
			$psr = mysqli_query($con, $ps);
			$psc = mysqli_num_rows($psr);

			$pc = "SELECT * FROM projects where cuid = '$uid' and ctype = 'Consultancy' ORDER BY cperiod  ";
			$pcr = mysqli_query($con, $pc);
			$pcc = mysqli_num_rows($pcr);
		?>
	<div style="padding-top: 10px; justify-content: center; display: flex;">
		<img src="Images/achieve.jfif">
	</div>
	<h3 class="h2"> Awards </h3>
	<table id="t1" class="cert">
		<tr>
            <th> Title </th>
			<th> Awarded by</th>
			<th> Contribution</th>
			<th> Acedamic Year</th>
			<th> File </th>
		</tr>
		<?php
			while ($sd = mysqli_fetch_assoc($sr))
			{
				echo '<tr>
				<td> '.$sd["cname"].' </td>
				<td> '.$sd["caward"].' </td>
				<td> '.$sd["ccontribution"].' </td>
				<td> '.$sd["cyear"].' </td>
				<td><a href="certs/'.$sd["cfile"].'" target="_blank"> '.$sd["cfile"].' </td>
               	</tr>';
      		}
		?>
	</table>
	<h3 class="h2"> Patents </h3>
	<table id="t1" class="cert">
		<tr>
            <th> Title </th>
			<th> Application Number</th>
			<th> Position </th>
            <th> Year </th>
			<th> File </th>
		</tr>
		<?php
			while ($ld = mysqli_fetch_array($lr))
			{
				echo '<tr>
				<td> '.$ld["cname"].' </td>
				<td> '.$ld["cnumber"].' </td>
				<td> '.$ld["cpos"].' </td>
				<td> '.$ld["cyear"].' </td>
				<td><a href="certs/'.$ld["cfile"].'" target="_blank"> '.$ld["cfile"].' </td>
               	</tr>';
     		}
		?>
	</table>
	<h3 class="h2"> Books </h3>
	<table id="t1" class="cert">
		<tr>
            <th> Title </th>
			<th> Year </th>
			<th> Books </th>
			<th> Volume </th>
			<th> UGC/SCOPUS/SCI Indexed </th>
			<th> File </th>
		</tr>
		<?php
			while ($wd = mysqli_fetch_array($wr))
			{
				echo '<tr>
				<td> '.$wd["cname"].' </td>
				<td> '.$wd["cyear"].' </td>
				<td> '.$wd["cjournal"].' </td>
				<td> '.$wd["cvol"].' </td>
				<td> '.$wd["cindex"].' </td>
				<td><a href="certs/'.$wd["cfile"].'" target="_blank"> '.$wd["cfile"].' </td>
            	</tr>';
       		}
		?>
	</table>

	<h3 class="h2"> Responsibilities </h3>
	<table id="t1" class="cert">
		<tr>
            <th> Description </th>
			<th> Level </th>
		</tr>
		<?php
			while ($wd = mysqli_fetch_array($rr))
			{
				echo '<tr>
				<td> '.$wd["cdescription"].' </td>
				<td> '.$wd["clevel"].' </td>
            	</tr>';
       		}
		?>
	</table>

	<h3 class="h2"> Memberships </h3>
	<table id="t1" class="cert">
		<tr>
            <th> Title </th>
			<th> Membership Number </th>
			<th> Membership Type </th>
			<th> File </th>
		</tr>
		<?php
			while ($wd = mysqli_fetch_array($mer))
			{
				echo '<tr>
				<td> '.$wd["cname"].' </td>
				<td> '.$wd["cnumber"].' </td>
				<td> '.$wd["ctype"].' </td>
				<td><a href="certs/'.$wd["cfile"].'" target="_blank"> '.$wd["cfile"].' </td>
            	</tr>';
       		}
		?>
	</table>

	<h3 class="h2"> Sponsored Projects </h3>
	<table id="t1" class="cert">
		<tr>
            <th> Title </th>
			<th> Sponsored by </th>
			<th> Amount </th>
			<th> Period </th>
			<th> Status </th>
			<th> File </th>
		</tr>
		<?php
			while ($wd = mysqli_fetch_array($psr))
			{
				echo '<tr>
				<td> '.$wd["cname"].' </td>
				<td> '.$wd["cperson"].' </td>
				<td> '.$wd["camount"].' </td>
				<td> '.$wd["cperiod"].' </td>
				<td> '.$wd["cstatus"].' </td>
				<td><a href="certs/'.$wd["cfile"].'" target="_blank"> '.$wd["cfile"].' </td>
            	</tr>';
       		}
		?>
	</table>

	<h3 class="h2"> Consultancy Projects </h3>
	<table id="t1" class="cert">
		<tr>
            <th> Title </th>
			<th> Agency </th>
			<th> Amount </th>
			<th> Period </th>
			<th> Status </th>
			<th> File </th>
		</tr>
		<?php
			while ($wd = mysqli_fetch_array($pcr))
			{
				echo '<tr>
				<td> '.$wd["cname"].' </td>
				<td> '.$wd["cperson"].' </td>
				<td> '.$wd["camount"].' </td>
				<td> '.$wd["cperiod"].' </td>
				<td> '.$wd["cstatus"].' </td>
				<td><a href="certs/'.$wd["cfile"].'" target="_blank"> '.$wd["cfile"].' </td>
            	</tr>';
       		}
		?>
	</table>
</body>
</html>
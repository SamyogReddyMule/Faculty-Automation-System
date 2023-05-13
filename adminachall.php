<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Faculty Search </title>
	<link rel="stylesheet" type="text/css" href="css/faculty.css">
	<link rel="stylesheet" type="text/css" href="css/facultymenu.css">
	<script type="text/javascript">
		function add() {
			document.getElementById('f1').style.display = 'block';
			document.getElementById('t1').style.display = 'none';
			document.getElementById('f2').style.display = 'none';
		}
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
		include 'adminmenu.php';
		$f = "SELECT fuid, fname FROM faculty_details";
		$fr = mysqli_query($con, $f);
	?>
	<form class="f1" action="" method="POST" autocomplete="off" enctype="multipart/form-data">
		<label > Select Faculty </label>

		<select class="s1" name="fuid" >
			<?php while ($fd = mysqli_fetch_array($fr)) { ?>
			<option value="<?php echo $fd['fuid']; ?>"><?php echo $fd['fname']."(".$fd['fuid'].")"; ?></option> <?php } ?>
		</select> <br>

		<label > Select Type </label>

		<select class="s1" name="ctype" >
			<option value="Awards">Awards</option>
			<option value="Patents">Patents</option>
			<option value="Books">Books</option>
			<option value="Responsibilities">Responsibilities</option>
			<option value="Memberships">Memberships</option>
			<option value="Sponsored Projects">Sponsored Projects</option>
            <option value="Consultancy Projects">Consultancy Projects</option>
		</select>
		<input class="submit" type="submit" name="view">
	</form>
	<?php 
		if(isset($_POST['view']))
		{
			$ctype = $_POST['ctype'];
            $fuid = $_POST['fuid'];
			$ca = "SELECT *FROM awards where cuid='$fuid' ";
			$car = mysqli_query($con, $ca);
			echo '<h3 class="h2">'.$ctype.'</h3>';
			if($ctype === 'Awards') {
				?>
			<table id="t1" class="cert">
				<tr>
					<th> Title </th>
					<th> Awarded by </th>
					<th> Contribution </th>
					<th> Academic Year </th>
					<th> File </th>
				</tr>
			<?php
			while ($wv = mysqli_fetch_array($car)) {
			?>	
				<tr>
					<td><?php echo $wv["cname"]; ?> </td>
					<td><?php echo $wv["caward"]; ?></td>
					<td><?php echo $wv["ccontribution"]; ?></td>
					<td><?php echo $wv["cyear"]; ?></td>
					<td><a style="text-decoration: none;" href="certs/<?php echo $wv["cfile"]; ?>" target="_blank"><?php echo $wv["cfile"]; ?> </a></td>
            	</tr>
            <?php
			}
		?>
		    </table>
		<?php
		}
		if($ctype === 'Books' ) {
            $ce = "SELECT *FROM certifications where cuid='$fuid' and ctype='$ctype' ";
			$cer = mysqli_query($con, $ce);
			?>
            
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
		while ($wev = mysqli_fetch_array($cer)) {
		?>	
			<tr>
				<td><?php echo $wev["cname"]; ?> </td>
				<td><?php echo $wev["cyear"]; ?></td>
				<td><?php echo $wev["cjournal"]; ?></td>
				<td><?php echo $wev["cvol"]; ?></td>
				<td><?php echo $wev["cindex"]; ?></td>
				<td><a style="text-decoration: none;" href="certs/<?php echo $wev["cfile"]; ?>" target="_blank"><?php echo $wev["cfile"]; ?> </a></td>
			</tr>
            <?php
			}
		?>
		</table>

        <?php
		}
		if($ctype === 'Patents' ) {
            $ce = "SELECT *FROM patents where cuid='$fuid'  ";
			$cer = mysqli_query($con, $ce);
			?>
            
		<table id="t1" class="cert">
			<tr>
				<th> Title </th>
				<th> Apllication Number </th>
				<th> Position </th>
				<th> Year </th>
				<th> File </th>
			</tr>
		<?php
		while ($wev = mysqli_fetch_array($cer)) {
		?>	
			<tr>
				<td><?php echo $wev["cname"]; ?> </td>
				<td><?php echo $wev["cnumber"]; ?></td>
				<td><?php echo $wev["cpos"]; ?></td>
				<td><?php echo $wev["cyear"]; ?></td>
				<td><a style="text-decoration: none;" href="certs/<?php echo $wev["cfile"]; ?>" target="_blank"><?php echo $wev["cfile"]; ?> </a></td>
			</tr>
            <?php
			}
		?>
		</table>

        <?php
		}
		if($ctype === 'Responsibilities' ) {
            $ce = "SELECT *FROM responsibilities where cuid='$fuid' ";
			$cer = mysqli_query($con, $ce);
			?>
            
		<table id="t1" class="cert">
			<tr>
				<th> Description </th>
				<th> Level </th>

			</tr>
		<?php
		while ($wev = mysqli_fetch_array($cer)) {
		?>	
			<tr>
				<td><?php echo $wev["cdescription"]; ?> </td>
				<td><?php echo $wev["clevel"]; ?></td>
			</tr>
            <?php
			}
		?>
		</table>

        <?php
		}
		if($ctype === 'Memberships' ) {
            $ce = "SELECT *FROM memberships where cuid='$fuid'  ";
			$cer = mysqli_query($con, $ce);
			?>
            
		<table id="t1" class="cert">
			<tr>
				<th> Title </th>
				<th> Membership Number</th>
				<th> Membership Type </th>
				<th> File </th>
			</tr>
		<?php
		while ($wev = mysqli_fetch_array($cer)) {
		?>	
			<tr>
				<td><?php echo $wev["cname"]; ?> </td>
				<td><?php echo $wev["cnumber"]; ?></td>
				<td><?php echo $wev["ctype"]; ?></td>
				<td><a style="text-decoration: none;" href="certs/<?php echo $wev["cfile"]; ?>" target="_blank"><?php echo $wev["cfile"]; ?> </a></td>
			</tr>
            <?php
			}
		?>
		</table>

        <?php
		}
		if($ctype === 'Sponsored Projects' ) {
            $ce = "SELECT * FROM projects where cuid='$fuid' and ctype='Sponsored' ";
			$cer = mysqli_query($con, $ce);
			?>
            
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
		while ($wev = mysqli_fetch_array($cer)) {
		?>	
			<tr>
				<td><?php echo $wev["cname"]; ?> </td>
				<td><?php echo $wev["cperson"]; ?></td>
				<td><?php echo $wev["camount"]; ?></td>
				<td><?php echo $wev["cperiod"]; ?></td>
				<td><?php echo $wev["cstatus"]; ?></td>
				<td><a style="text-decoration: none;" href="certs/<?php echo $wev["cfile"]; ?>" target="_blank"><?php echo $wev["cfile"]; ?> </a></td>
			</tr>
            <?php
			}
		?>
		</table>

        <?php
		}
		if($ctype === 'Consultancy Projects' ) {
            $ce = "SELECT * FROM projects where cuid='$fuid' and ctype='Consultancy' ";
			$cer = mysqli_query($con, $ce);
			?>
            
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
		while ($wev = mysqli_fetch_array($cer)) {
		?>	
			<tr>
				<td><?php echo $wev["cname"]; ?> </td>
				<td><?php echo $wev["cperson"]; ?></td>
				<td><?php echo $wev["camount"]; ?></td>
				<td><?php echo $wev["cperiod"]; ?></td>
				<td><?php echo $wev["cstatus"]; ?></td>
				<td><a style="text-decoration: none;" href="certs/<?php echo $wev["cfile"]; ?>" target="_blank"><?php echo $wev["cfile"]; ?> </a></td>
			</tr>
            <?php
			}
		?>
		</table>
		<?php
		}
	}
	?>
</body>
</html>
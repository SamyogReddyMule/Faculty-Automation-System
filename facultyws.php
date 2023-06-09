<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Workshop </title>
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
		include 'facultymenu.php';
		$w = "SELECT * FROM certifications where cuid = '$uid' and ctype = 'Workshop' ";
		$wr = mysqli_query($con, $w);
	?>
	<div style="padding-top: 10px; justify-content: center; display: flex; ">
		<img src="Images/workshop.png">
	</div>
	<h3 class="h2"> Workshop </h3>
	<table id="t1" class="cert" style="margin-top: 10px;">
		<tr class="tr1">
			<th> Title </th>
			<th> Year </th>
			<th> Start </th>
			<th> End </th>
			<th> Duration </th>
			<th> File </th>
			<th> Edit </th>
			<th> Delete </th>
		</tr>
		<?php
			while ($wv = mysqli_fetch_array($wr))
			{
				$nam = urlencode($wv["cname"]);
				$nam1 = urlencode($wv["cyear"]);
				$nam2 = urlencode($wv["cstart"]);
			?>
			<tr>
				<td><?php echo $wv["cname"]; ?> </td>
				<td><?php echo $wv["cyear"]; ?></td>
				<td><?php echo $wv["cstart"]; ?></td>
				<td><?php echo $wv["cend"]; ?></td>
				<td><?php echo $wv["cdur"]; ?></td>
				<td><a style="text-decoration: none;" href="certs/<?php echo $wv["cfile"]; ?>" target="_blank"><?php echo $wv["cfile"]; ?> </td>
				<th><a style="text-decoration: none;" href="facultyws.php?upd=<?php echo $nam; ?>&upd1=<?php echo $nam1; ?>&upd2=<?php echo $nam2; ?>" > Y </a></th>
                <th><a style="text-decoration: none;" onClick="javascript: return confirm('Do you want to delete the Workshop <?php echo $wv['cname']; ?>');" href="facultyws.php?del=<?php echo $nam; ?>&del1=<?php echo $nam1; ?>&del2=<?php echo $nam2; ?>" > X </a></th>
            </tr>
        <?php } ?>
		<tr>
			<td style="text-align: center;" colspan="8"><button class="b1" id = "b1" onclick="add()" > Add </button> </td>
		</tr> 
	</table>

	 <form class="f1" id="f1" action="" method="POST" style="display: none" enctype="multipart/form-data">
        <h3 class="h3">Insert Workshop</h3>

        <label class="l1"> Title </label>
        <input class="i1" type="text" placeholder="Enter Workshop Title" name="cn" required><br>

        <label class="l1" > Acedamic Year </label>
        <input class="i1" type="text" placeholder=" Enter Acedamic Year" pattern="((?:[0-9]{4})-(?:[0-9]{2}))" name="cy" required> <br>

        <label class="l1"> Start Date </label>
        <input class="i1" type="date" name="cs" min="1922-01-01" max="<?php echo date('Y-m-d'); ?>" required> <br>

        <label class="l1"> End Date </label>
        <input class="i1" type="date" name="ce" min="1922-01-01" max="<?php echo date('Y-m-d'); ?>" required> <br>

        <label class="l1"> File </label>
        <input class="i1" type="file" name="cf" autocomplete="off" required> <br>

        <input class="submit" type="submit" name="add">
    </form>
    <?php
    	if(isset($_POST['add']))
		{
			$cn = $_POST['cn'];
			$cy = $_POST['cy'];
			$cs = $_POST['cs'];
			$ce = $_POST['ce'];
			$year = date_diff(date_create("$cs"), date_create("$ce"))->y;
			$mon = date_diff(date_create("$cs"), date_create("$ce"))->m;
			$day = date_diff(date_create("$cs"), date_create("$ce"))->d+1;
			$t = $year.' Year '.$mon.' Months '.$day.' Days';
			$cf = $_FILES['cf']['name'];
			$qsa = "SELECT * FROM certifications where cuid = '$uid' and ctype = 'Workshop' and cname='$cn' and cyear='$cy' and cstart='$cs' ";
			$qsar = mysqli_query($con, $qsa);
			if(mysqli_num_rows($qsar) != 1)
			{
				$fT = $_FILES['cf']['tmp_name'];
    			$fY = $_FILES['cf']['type'];
    			$fNC = explode(".", $cf);
    			$fE = strtolower(end($fNC));
    			$nFN = "$uid-$cf";
    			$afE = 'pdf';
    			if ($fE == $afE)
    			{
      				$uFD = './certs/';
      				$dp = $uFD . $nFN;
      				if (!file_exists($dp))
      				{
      					if(move_uploaded_file($fT, $dp)) 
      					{
      						$sql2 = "INSERT into certifications SET cfile='$nFN', cname='$cn', cdur='$t', cstart='$cs', cend='$ce', cyear='$cy', ctype='Workshop', cuid='$uid'";
      						if (mysqli_query($con, $sql2))
      						{
      							echo '<script>alert("Workshop Added Successfully"); location.href="facultyws.php"</script>';
      						}
      						else
      						{
      							echo '<script>alert("Error while Adding"); location.href="facultyws.php"</script>';
      						}
      					}
      				}
      				if (file_exists($dp)) 
      				{
      					echo '<script>alert("File name Already exist. Please rename file and Try Again"); location.href="facultyws.php";</script>';
      				}
      			}
      			if($fE != $afE)
      			{
      				echo '<script>alert("File extension must be pdf"); location.href="facultyws.php";</script>';
      			}
      		}
      		if(mysqli_num_rows($qsar) == 1)
      		{
      			echo '<script>alert("Workshop Already exist."); location.href="facultyws.php";</script>';
      		}
      	}
		if(!empty($_GET['upd']) && !empty($_GET['upd1']) && !empty($_GET['upd2']))
		{
			$uci = $_GET['upd'];
			$uci1 = $_GET['upd1'];
			$uci2 = $_GET['upd2'];
			$sql1 = "SELECT * FROM certifications where cuid='$uid' and cname = '$uci' and ctype='Workshop' and cyear='$uci1' and cstart='$uci2' ";
			$wur = mysqli_query($con, $sql1);
			$wud = mysqli_fetch_array($wur);
			$pcf = $wud['cfile'];
			echo '<script> document.getElementById("f1").style.display = "none";
			document.getElementById("t1").style.display = "none"; </script>';
			echo '<form class="f1" id="f2" action="" method="POST" enctype="multipart/form-data">
			<h3 class="h3">Update Workshop</h3>

        	<label class="l1"> Title </label>
        	<input class="i1" type="text" placeholder="Enter Workshop Name" value="'.$wud["cname"].'" name="ucn" required> <br>

        	<label class="l1" > Acedamic Year </label>
	        <input class="i1" type="text" placeholder=" Enter Acedamic Year" value="'.$wud["cyear"].'" pattern="((?:[0-9]{4})-(?:[0-9]{2}))" name="ucy" required> <br>

	        <label class="l1"> Start Date </label>
	        <input class="i1" type="date" name="ucs" value="'.$wud["cstart"].'" min="1922-01-01" max="'.date('Y-m-d').'" required> <br>

	        <label class="l1" > End Date </label>
	        <input class="i1" type="date" name="uce" value="'.$wud["cend"].'" min="1922-01-01" max="'.date('Y-m-d').'" required> <br>

	        <label class="l1" > File </label>
	        <input class="i1" type="file" name="ucf" autocomplete="off"> <br>

	        <input class="submit" type="submit" name="upd">
	            </form>';
    	}
     	?>
    	<?php
		if(isset($_POST['upd']))
		{
			$ucn=$_POST['ucn'];
			$ucs=$_POST['ucs'];
			$uce=$_POST['uce'];
			$ucy=$_POST['ucy'];
			$uyear = date_diff(date_create("$ucs"), date_create("$uce"))->y;
			$umon = date_diff(date_create("$ucs"), date_create("$uce"))->m;
			$uday = date_diff(date_create("$ucs"), date_create("$uce"))->d+1;
			$ct = $uyear.' Year '.$umon.' Months '.$uday.' Days';
			if($ucn != $uci || $ucs != $uci2 || $ucy != $uci1) 
			{ 
				$sqlz = "SELECT * FROM certifications where cuid='$uid' and cname = '$ucn' and ctype='Workshop' and cyear='$ucy' and cstart='$ucs' ";
				if(mysqli_num_rows(mysqli_query($con, $sqlz)) != 1)
				{
					if($_FILES['ucf']['error'] != UPLOAD_ERR_NO_FILE)
					{
						$uafE = 'pdf';
						$ucf = $_FILES['ucf']['name'];
						$ufT = $_FILES['ucf']['tmp_name'];
    					$ufY = $_FILES['ucf']['type'];
    					$ufNC = explode(".", $ucf);
 						$ufE = strtolower(end($ufNC));
    					if ($ufE == $uafE)
    					{
    						$cpd = "certs/".$pcf;
    						unlink($cpd);
    						$unFN = "$uid-$ucf";
      						$uuFD = './certs/';
      						$udp = $uuFD . $unFN;
      						if (!file_exists($udp))
      						{
       							if(move_uploaded_file($ufT, $udp)) 
      							{
									$wu12 = "UPDATE certifications SET cfile='$unFN', cname='$ucn', cdur='$ct', cstart='$ucs', cend='$uce', cyear='$ucy' where cuid='$uid' and cname='$uci' and ctype='Workshop' and cyear='$uci1' and cstart='$uci2' ";
									if (mysqli_query($con, $wu12))
									{
										echo '<script>alert("Workshop Details Updated Successfully"); location.href="facultyws.php"</script>';
									}
									else
									{
										echo '<script>alert("Error while updating"); location.href="facultyws.php"</script>';
									}
								}
							}
							if (file_exists($udp))
      						{
      							echo '<script>alert("File name Already exist. Please rename file and Try Again"); location.href="facultyws.php";</script>';
      						}
      					}
						if($ufE != $uafE)
      					{
      						echo '<script>alert("File extension must be pdf"); location.href="facultyws.php";</script>';
      					}
					}
					if($_FILES['ucf']['error'] == UPLOAD_ERR_NO_FILE)
					{
						$wu21 = "UPDATE certifications SET cname='$ucn', cdur='$ct', cstart='$ucs', cend='$uce', cyear='$ucy' where cuid='$uid' and cname='$uci' and ctype='Workshop' and cyear='$uci1' and cstart='$uci2'  ";
						if (mysqli_query($con, $wu21))
						{
							echo '<script>alert("Workshop Details updated Successfully"); location.href="facultyws.php"</script>';
						}
						else
						{
							echo '<script>alert("Error while updating"); location.href="facultyws.php"</script>';
						}
					}
				}
				if(mysqli_num_rows($sqlzr) == 1)
				{
					echo '<script>alert("Workshop Already exist."); location.href="facultyws.php";</script>';
				}
			}
			if($ucn === $uci && $ucs === $uci2 && $ucy === $uci1)
			{
				if($_FILES['ucf']['error'] != UPLOAD_ERR_NO_FILE)
				{
					$uafE = 'pdf';
					$ucf = $_FILES['ucf']['name'];
					$ufT = $_FILES['ucf']['tmp_name'];
    				$ufY = $_FILES['ucf']['type'];
    				$ufNC = explode(".", $ucf);
 					$ufE = strtolower(end($ufNC));
    				if ($ufE == $uafE) 
    				{
    					$cpd = "certs/".$pcf;
    					unlink($cpd);
    					$unFN = "$uid-$ucf";
      					$uuFD = './certs/';
      					$udp = $uuFD . $unFN;
						if (file_exists($udp))
      					{
      						echo '<script>alert("File name Already exist. Please rename file and Try Again"); location.href = "facultyws.php";</script>';
      					}
      					if (!file_exists($udp))
      					{
       						if(move_uploaded_file($ufT, $udp)) 
      						{
								$wu1 = "UPDATE certifications SET cfile='$unFN', cname='$ucn', cdur='$ct', cstart='$ucs', cend='$uce', cyear='$ucy' where cuid='$uid' and cname='$uci' and ctype='Workshop' and cyear='$uci1' and cstart='$uci2' ";
								if (mysqli_query($con, $wu1))
								{
									echo '<script>alert("Workshop Details Updated Successfully"); location.href="facultyws.php"</script>';
								}
								else
								{
									echo '<script>alert("Error while updating"); location.href="facultyws.php"</script>';
								}
							}
						}
						if (file_exists($udp))
      					{
      						echo '<script>alert("File name Already exist. Please rename file and Try Again"); location.href="facultyws.php";</script>';
      					}
      				}
					if($ufE != $uafE)
      				{
      					echo '<script>alert("File extension must be pdf"); location.href="facultyws.php";</script>';
      				}
				}
				if($_FILES['ucf']['error'] == UPLOAD_ERR_NO_FILE)
				{
					$wu2 = "UPDATE certifications SET cname='$ucn', cdur='$ct', cstart='$ucs', cend='$uce', cyear='$ucy' where cuid='$uid' and cname='$uci' and ctype='Workshop' and cyear='$ucy' and cstart='$ucs' ";
					if (mysqli_query($con, $wu2))
					{
						echo '<script>alert("Workshop Details updated Successfully"); location.href="facultyws.php"</script>';
					}
					else
					{
						echo '<script>alert("Error while updating"); location.href="facultyws.php"</script>';
					}
				}
      		}
		}
		if(!empty($_GET['del']) && !empty($_GET['del1']) && !empty($_GET['del2'])) //code to delete the selected Workshop
		{
			$m = $_GET['del'];
			$m1 = $_GET['del1'];
			$m2 = $_GET['del2'];
			$selectSql = "SELECT * from certifications where cuid='$uid' and cname = '$m' and ctype='Workshop' and cyear='$m1' and cstart='$m2' ";
			$rsSelect = mysqli_query($con, $selectSql);
			$getRow = mysqli_fetch_assoc($rsSelect);
			$getName = $getRow['cfile'];
			$createDeletePath = "certs/".$getName;
			if(unlink($createDeletePath))
			{
				$sqle = "DELETE FROM certifications where cuid='$uid' and cname = '$m' and ctype='Workshop' and cyear='$m1' and cstart='$m2' ";
				if(mysqli_query($con, $sqle))
				{
					echo '<script>alert("Deleted Successfully"); location.href="facultyws.php"</script>';
				}
				else
				{
					echo '<script>alert("Error while Deleting"); location.href="facultyws.php"</script>';
				}
			}
		}
		?>
</body>
</html>
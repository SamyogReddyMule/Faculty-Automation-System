<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Projects</title>
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
        $dep = $_SESSION['id'];
		if (empty($uid)) {
                        echo "<script>alert('Cant Press back'); location.href='home.php'</script>";
                }
		include 'db.php';
		include 'depmenu.php';
		$f = "SELECT fuid, fname FROM faculty_details where fdep='$dep' ";
		$fr = mysqli_query($con, $f);	
	?>
	<div style="padding-top: 10px; justify-content: center; display: flex; ">
		<img src="Images/projects.png">
	</div>
	<h3 class="h2"> Projects </h3>
	<table id="t1" class="cert">
		<tr>
            <th> Title </th>
			<th> Type </th>
			<th> Person</th>
			<th> Amount </th>
            <th> Period </th>
			<th> Status </th>
			<th> File </th>
			<th> Edit </th>
			<th> Delete </th>
		</tr>
		</tr>
	<?php
	while($fd = mysqli_fetch_array($fr))
		{
			echo '<tr> <th colspan="9" style="background-color: grey; "> '.$fd["fname"].'</th> </tr>';
			$uidi = $fd["fuid"];
			$w = "SELECT * FROM projects where cuid='$uidi' ";
			$wr = mysqli_query($con, $w);
			while($wv = mysqli_fetch_array($wr))
			{
				$nam1 = urlencode($wv["cname"]);
				$nam = urlencode($wv["cuid"]);
				$nam2 = urlencode($wv["cperiod"]);
			?>
			<tr>
				<td><?php echo $wv["cname"]; ?> </td>
				<td><?php echo $wv["ctype"]; ?> </td>
				<td><?php echo $wv["cperson"]; ?></td>
				<td><?php echo $wv["camount"]; ?></td>
				<td><?php echo $wv["cperiod"]; ?></td>
				<td><?php echo $wv["cstatus"]; ?> </td>
				<td><a style="text-decoration: none;" href="certs/<?php echo $wv["cfile"]; ?>" target="_blank"><?php echo $wv["cfile"]; ?> </td>
				<th><a style="text-decoration: none;" href="depproj.php?upd=<?php echo $nam; ?>&upd1=<?php echo $nam1; ?>&upd2=<?php echo $nam2; ?>" id="upd" title="Edit Projects"> Y </a></th>
                <th><a style="text-decoration: none;" onclick="javascript: return confirm('Do you wnat to delete Projects <?php echo $wv['cname'];?>');" href="depproj.php?del=<?php echo $nam; ?>&del1=<?php echo $nam1; ?>&del2=<?php echo $nam2; ?>" > X </a></th>
            </tr>
        <?php 
    	}
    }
     ?>
		<tr>
			<td style="text-align: center;" colspan="8"><button class="b1" id = "b1" onclick="add()" > Add </button> </td>
		</tr>
	</table>

	<form class="f1" id="f1" action="" method="POST" style="display: none" enctype="multipart/form-data">
       <h3 class="h3">Insert Projects</h3>

        <label class="l1" > Unique ID </label>
        <input class="i1" type="text" placeholder="Enter Unique ID of Faculty" name="ci" required> <br>

        <label class="l1"> Title </label>
        <input class="i1" type="text" placeholder="Enter Projects Title" name="cn" required><br>

		<label class="l1"> Project Type </label>
        <select class="s1" name="ca"  required>
			<option value="Sponsored">Sponsored</option>
			<option value="Consultancy">Consultancy</option>
		</select> <br>

        <label class="l1"> Sponsored by/ Agency </label>
        <input class="i1" type="text" name="cs" required> <br>

        <label class="l1"> Amount</label>
        <input class="i1" type="text" name="ce" required> <br>

		<label class="l1"> Period </label>
        <input class="i1" type="text" placeholder="Enter period" name="cy"  required> <br>
		
        <label class="l1"> Status </label>
        <select class="s1" name="ct"  required>
				<option value="Completed">Completed</option>
				<option value="Ongoing">Ongoing</option>
			</select>  <br>

        <label class="l1"> File </label>
        <input class="i1" type="file" name="cf" autocomplete="off" required> <br>

        <input class="submit" type="submit" name="add">
    </form>
    <?php
    	if(isset($_POST['add']))
		{
			$ci = $_POST['ci'];
			$cn = $_POST['cn'];
			$cy = $_POST['cy'];
			$cs = $_POST['cs'];
			$ce = $_POST['ce'];
			$ct = $_POST['ct'];
			$ca = $_POST['ca'];
			$cf = $_FILES['cf']['name'];
			$qsa = "SELECT * FROM projects where cuid = '$ci' and cname='$cn' and cperiod='$cy'and ctype='$ca' ";
			$qsar = mysqli_query($con, $qsa);
			$qsa2 = "SELECT * FROM faculty_details where fuid = '$ci' ";
			if(mysqli_num_rows(mysqli_query($con, $qsa2)) == 1)
			{
				if(mysqli_num_rows($qsar) != 1)
				{
					$fT = $_FILES['cf']['tmp_name'];
    				$fY = $_FILES['cf']['type'];
    				$fNC = explode(".", $cf);
    				$fE = strtolower(end($fNC));
    				$nFN = "$ci-$cf";
    				$afE = 'pdf';
    				if ($fE == $afE)
    				{
      					$uFD = './certs/';
      					$dp = $uFD . $nFN;
      					if (!file_exists($dp))
      					{
      						if(move_uploaded_file($fT, $dp))
      						{
      							$sql2 = "INSERT into projects SET cfile='$nFN', cname='$cn', cperson='$cs', camount='$ce', cperiod='$cy', cuid='$ci, ctype='$ca', cstatus='$ct'";
      							if (mysqli_query($con, $sql2))
      							{
      								echo '<script>alert("Projects Added Successfully"); location.href="depproj.php"</script>';
      							}
      							else
      							{
      								echo '<script>alert("Error while Adding"); location.href="depproj.php"</script>';
      							}
      						}
      					}
      					if (file_exists($dp))
      					{
      						echo '<script>alert("File name Already exist. Please rename file and Try Again"); location.href="depproj.php";</script>';
      					}
      				}
      				if($fE != $afE)
      				{
      					echo '<script>alert("File extension must be pdf"); location.href="depproj.php";</script>';
      				}
      			}
      			if(mysqli_num_rows($qsar) == 1)
      			{
      				echo '<script>alert("Projects Already exist."); location.href="depproj.php";</script>';
      			}
      		}
      		if(mysqli_num_rows(mysqli_query($con, $qsa2)) != 1)
      		{
      			echo '<script>alert("Faculty doesnt exist"); location.href="depproj.php";</script>';
      		}
		}
		if(!empty($_GET['upd']) && !empty($_GET['upd1']) && !empty($_GET['upd2']))
		{
			$uci = $_GET['upd'];
			$uci1 = $_GET['upd1'];
			$uci2 = $_GET['upd2'];
			$sql1 = "SELECT * FROM projects where cuid='$uci' and cname = '$uci1' and cperiod='$uci2'  ";
			$wur = mysqli_query($con, $sql1);
			$wud = mysqli_fetch_array($wur);
			$pcf = $wud['cfile'];
			echo '<script> document.getElementById("f1").style.display = "none";
			document.getElementById("t1").style.display = "none"; </script>';
			echo '<form class="f1" id="f2" action="" method="POST" enctype="multipart/form-data">
			<h3 class="h3">Update Projects</h3>

			<label class="l1" > Unique ID </label>
        	<input class="i1" type="text" placeholder="Enter Unique ID of Faculty" name="ciu" value="'.$wud["cuid"].'" required> <br>

        	<label class="l1"> Title </label>
        	<input class="i1" type="text" placeholder="Enter Projects Name" value="'.$wud["cname"].'" name="ucn" required> <br>

			<label class="l1"> Type </label>
			<select class="s1" name="uca" value="'.$wud["ctype"].'" required>
			<option value="Sponsored">Sponsored</option>
			<option value="Consultancy">Consultancy</option>
		</select> <br>
		
        	<label class="l1"> Period </label>
        	<input class="i1" type="text" placeholder="Enter Year" name="ucy" value="'.$wud["cperiod"].'" required> <br>

	        <label class="l1"> Sponsored by / Agency </label>
	        <input class="i1" type="text" name="ucs" value="'.$wud["cperson"].'" required> <br>

	        <label class="l1" > Amount </label>
	        <input class="i1" type="text" name="uce" value="'.$wud["camount"].'" required> <br>

	        <label class="l1"> Status </label>
        	<select class="s1" name="uct" value="'.$wud["cstatus"].'" required>
					<option value="Completed">Completed</option>
					<option value="Ongoing">Ongoing</option>
				</select> <br>

	        <label class="l1" > File </label>
	        <input class="i1" type="file" name="ucf" autocomplete="off"> <br>

	        <input class="submit" type="submit" name="upd">
	            </form>';
    	}
     	?>
    	<?php
		if(isset($_POST['upd']))
		{
			$ciu=$_POST['ciu'];
			$ucn=$_POST['ucn'];
			$uca=$_POST['uca'];
			$ucs=$_POST['ucs'];
			$uce=$_POST['uce'];
			$ucy=$_POST['ucy'];
			$uct=$_POST['uct'];
			$uqsa2 = "SELECT * FROM faculty_details where fuid = '$ciu' ";
			if(mysqli_num_rows(mysqli_query($con, $uqsa2)) == 1)
			{
				if($ciu != $uci || $ucn != $uci1 || $ucy != $uci2) 
				{ 
					$sqlz = "SELECT * FROM projects where cuid='$ciu' and cname = '$ucn'  and cperiod='$ucy' and cperson='$ucs' ";
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
    							$unFN = "$ciu-$ucf";
      							$uuFD = './certs/';
      							$udp = $uuFD . $unFN;
      							if (!file_exists($udp))
      							{
       								if(move_uploaded_file($ufT, $udp)) 
      								{
										$wu12 = "UPDATE projects SET cfile='$unFN', cname='$ucn',  cperson='$ucs', camount='$uce', cperiod='$ucy', cuid='$ciu', ctype='$uca', cstatus='$uct' where cuid='$uci' and cname='$uci1' and  cperiod='$uci2' ";
										if (mysqli_query($con, $wu12))
										{
											echo '<script>alert("Projects Details Updated Successfully"); location.href="depproj.php"</script>';
										}
										else
										{
											echo '<script>alert("Error while updating"); location.href="depproj.php"</script>';
										}
									}
								}
								if (file_exists($udp))
      							{
      								echo '<script>alert("File name Already exist. Please rename file and Try Again"); location.href="depproj.php";</script>';
      							}
      						}
							if($ufE != $uafE)
      						{
      							echo '<script>alert("File extension must be pdf"); location.href="depproj.php";</script>';
      						}
						}
						if($_FILES['ucf']['error'] == UPLOAD_ERR_NO_FILE)
						{
							$wu21 = "UPDATE projects SET cname='$ucn',  cperson='$ucs', camount='$uce', cperiod='$ucy', cuid='$ciu', ctype='$uca', cstatus='$uct' where cuid='$uci' and cname='$uci1' and cperiod='$uci2' ";
							if (mysqli_query($con, $wu21))
							{
								echo '<script>alert("Projects Details updated Successfully"); location.href="depproj.php"</script>';
							}
							else
							{
								echo '<script>alert("Error while updating"); location.href="depproj.php"</script>';
							}
						}
					}
					if(mysqli_num_rows($sqlzr) == 1)
					{
						echo '<script>alert("Projects Already exist."); location.href="depproj.php";</script>';
					}
				}	
				if($ciu == $uci && $ucn == $uci1 && $ucy == $uci2)
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
    						$unFN = "$ciu-$ucf";
      						$uuFD = './certs/';
      						$udp = $uuFD . $unFN;
							if (file_exists($udp))
      						{
      							echo '<script>alert("File name Already exist. Please rename file and Try Again"); location.href = "depproj.php";</script>';
      						}
      						if (!file_exists($udp))
      						{
       							if(move_uploaded_file($ufT, $udp)) 
      							{
									$wu1 = "UPDATE projects SET cfile='$unFN', cname='$ucn',  cperson='$ucs', camount='$uce', cperiod='$ucy', cuid='$ciu', ctype='$uca', cstatus='$uct' where cuid='$uci' and cname='$uci1'  and cperiod='$uci2' ";
									if (mysqli_query($con, $wu1))
									{
										echo '<script>alert("Projects Details Updated Successfully"); location.href="depproj.php"</script>';
									}
									else
									{
										echo '<script>alert("Error while updating"); location.href="depproj.php"</script>';
									}
								}
							}
							if (file_exists($udp))
      						{
      							echo '<script>alert("File name Already exist. Please rename file and Try Again"); location.href="depproj.php";</script>';
      						}
      					}
						if($ufE != $uafE)
      					{
      						echo '<script>alert("File extension must be pdf"); location.href="depproj.php";</script>';
      					}
					}	
					if($_FILES['ucf']['error'] == UPLOAD_ERR_NO_FILE)
					{
						$wu2 = "UPDATE projects SET cname='$ucn',  cperson='$ucs', camount='$uce', cperiod='$ucy', cuid='$ciu', ctype='$uca', cstatus='$uct' where cuid='$ciu' and cname='$uci1' and cperiod='$ucy' ";
						if (mysqli_query($con, $wu2))
						{
							echo '<script>alert("Projects Details updated Successfully"); location.href="depproj.php"</script>';
						}
						else
						{
							echo '<script>alert("Error while updating"); location.href="depproj.php"</script>';
						}
					}
      			}
			}
			if(mysqli_num_rows(mysqli_query($con, $uqsa2)) != 1)
			{
				echo '<script>alert("Please check the faculty ID"); location.href="depproj.php"</script>';
			}
		}
		if(!empty($_GET['del']) && !empty($_GET['del1']) && !empty($_GET['del2'])) //code to delete the selected Projects
		{
			$m = $_GET['del'];
			$m1 = $_GET['del1'];
			$m2 = $_GET['del2'];
			$selectSql = "SELECT * from projects where cuid='$m' and cname = '$m1' and  cperiod='$m2' ";
			$rsSelect = mysqli_query($con, $selectSql);
			$getRow = mysqli_fetch_assoc($rsSelect);
			$getName = $getRow['cfile'];
			$createDeletePath = "certs/".$getName;
			if(unlink($createDeletePath))
			{
				$sqle = "DELETE FROM projects where cuid='$m' and cname = '$m1' and cperiod='$m2' ";
				if(mysqli_query($con, $sqle))
				{
					echo '<script>alert("Deleted Successfully"); location.href="depproj.php"</script>';
				}
				else
				{
					echo '<script>alert("Error while Deleting"); location.href="depproj.php"</script>';
				}
			}
		}
		?>
</body>
</html>
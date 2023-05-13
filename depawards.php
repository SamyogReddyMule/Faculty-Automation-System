<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Award</title>
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
		$f = "SELECT fuid, fname FROM faculty_details where fdep='$dep'";
		$fr = mysqli_query($con, $f);	
	?>
	<div style="padding-top: 10px; justify-content: center; display: flex; ">
		<img src="Images/awards.jpg">
	</div>
	<h3 class="h2"> Awards </h3>
	<table id="t1" class="cert">
		<tr>
            <th> Title </th>
			<th> Awarded by</th>
			<th> Contribution</th>
			<th> Acedamic Year</th>
			<th> File </th>
			<th> Edit </th>
			<th> Delete </th>
		</tr>
	<?php
	while($fd = mysqli_fetch_array($fr))
		{
			echo '<tr> <th colspan="8" style="background-color: grey; "> '.$fd["fname"].'</th> </tr>';
			$uidi = $fd["fuid"];
			$w = "SELECT * FROM awards where cuid='$uidi' ";
			$wr = mysqli_query($con, $w);
			while($wv = mysqli_fetch_array($wr))
			{
				$nam1 = urlencode($wv["cname"]);
				$nam = urlencode($wv["cuid"]);
				$nam2 = urlencode($wv["cyear"]);
			?>
			<tr>
				<td><?php echo $wv["cname"]; ?> </td>
				<td><?php echo $wv["caward"]; ?></td>
				<td><?php echo $wv["ccontribution"]; ?></td>
				<td><?php echo $wv["cyear"]; ?></td>
				<td><a style="text-decoration: none;" href="certs/<?php echo $wv["cfile"]; ?>" target="_blank"><?php echo $wv["cfile"]; ?> </td>
				<th><a style="text-decoration: none;" href="depawards.php?upd=<?php echo $nam; ?>&upd1=<?php echo $nam1; ?>&upd2=<?php echo $nam2; ?>" id="upd" title="Edit Award"> Y </a></th>
                <th><a style="text-decoration: none;" onclick="javascript: return confirm('Do you wnat to delete Award <?php echo $wv["cname"]; ?>');" href="depawards.php?del=<?php echo $nam; ?>&del1=<?php echo $nam1; ?>&del2=<?php echo $nam2; ?>" > X </a></th>
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
       <h3 class="h3">Insert Awards</h3>

        <label class="l1" > Unique ID </label>
        <input class="i1" type="text" placeholder="Enter Unique ID of Faculty" name="ci" required> <br>

        <label class="l1"> Title </label>
        <input class="i1" type="text" placeholder="Enter Award Title" name="cn" required><br>

        <label class="l1"> Year </label>
        <input class="i1" type="text" placeholder="Enter Year" name="cy" <?php echo date("Y"); ?>  required> <br>

        <label class="l1"> Awarded by</label>
        <input class="i1" type="text" name="cs" required> <br>

        <label class="l1"> Contribution</label>
        <input class="i1" type="text" name="ce" required> <br>

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
			$cf = $_FILES['cf']['name'];
			$qsa = "SELECT * FROM awards where cuid = '$ci' and cname='$cn' and cyear='$cy' ";
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
      							$sql2 = "INSERT into awards SET cfile='$nFN', cname='$cn', caward='$cs', ccontribution='$ce', cyear='$cy', cuid='$ci'";
      							if (mysqli_query($con, $sql2))
      							{
      								echo '<script>alert("Award Added Successfully"); location.href="depawards.php"</script>';
      							}
      							else
      							{
      								echo '<script>alert("Error while Adding"); location.href="depawards.php"</script>';
      							}
      						}
      					}
      					if (file_exists($dp))
      					{
      						echo '<script>alert("File name Already exist. Please rename file and Try Again"); location.href="depawards.php";</script>';
      					}
      				}
      				if($fE != $afE)
      				{
      					echo '<script>alert("File extension must be pdf"); location.href="depawards.php";</script>';
      				}
      			}
      			if(mysqli_num_rows($qsar) == 1)
      			{
      				echo '<script>alert("Award Already exist."); location.href="depawards.php";</script>';
      			}
      		}
      		if(mysqli_num_rows(mysqli_query($con, $qsa2)) != 1)
      		{
      			echo '<script>alert("Faculty doesnt exist"); location.href="depawards.php";</script>';
      		}
		}
		if(!empty($_GET['upd']) && !empty($_GET['upd1']) && !empty($_GET['upd2']))
		{
			$uci = $_GET['upd'];
			$uci1 = $_GET['upd1'];
			$uci2 = $_GET['upd2'];
			$sql1 = "SELECT * FROM awards where cuid='$uci' and cname = '$uci1' and cyear='$uci2'  ";
			$wur = mysqli_query($con, $sql1);
			$wud = mysqli_fetch_array($wur);
			$pcf = $wud['cfile'];
			echo '<script> document.getElementById("f1").style.display = "none";
			document.getElementById("t1").style.display = "none"; </script>';
			echo '<form class="f1" id="f2" action="" method="POST" enctype="multipart/form-data">
			<h3 class="h3">Update award</h3>

			<label class="l1" > Unique ID </label>
        	<input class="i1" type="text" placeholder="Enter Unique ID of Faculty" name="ciu" value="'.$wud["cuid"].'" required> <br>

        	<label class="l1"> Title </label>
        	<input class="i1" type="text" placeholder="Enter award Name" value="'.$wud["cname"].'" name="ucn" required> <br>

        	<label class="l1"> Year </label>
        	<input class="i1" type="text" placeholder="Enter Year" name="ucy" value="'.$wud["cyear"].'"  required> <br>

	        <label class="l1"> Awarded by </label>
	        <input class="i1" type="text" name="ucs" value="'.$wud["caward"].'" required> <br>

	        <label class="l1" > Contribution </label>
	        <input class="i1" type="text" name="uce" value="'.$wud["ccontribution"].'" required> <br>

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
			$ucs=$_POST['ucs'];
			$uce=$_POST['uce'];
			$ucy=$_POST['ucy'];
			$uct=$_POST['uct'];
			$uqsa2 = "SELECT * FROM faculty_details where fuid = '$ciu' ";
			if(mysqli_num_rows(mysqli_query($con, $uqsa2)) == 1)
			{
				if($ciu != $uci || $ucn != $uci1 || $ucy != $uci2) 
				{ 
					$sqlz = "SELECT * FROM awards where cuid='$ciu' and cname = '$ucn'  and cyear='$ucy' and caward='$ucs' ";
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
										$wu12 = "UPDATE awards SET cfile='$unFN', cname='$ucn',  caward='$ucs', ccontribution='$uce', cyear='$ucy', cuid='$ciu' where cuid='$uci' and cname='$uci1'  and cyear='$uci2' ";
										if (mysqli_query($con, $wu12))
										{
											echo '<script>alert("Award Details Updated Successfully"); location.href="depawards.php"</script>';
										}
										else
										{
											echo '<script>alert("Error while updating"); location.href="depawards.php"</script>';
										}
									}
								}
								if (file_exists($udp))
      							{
      								echo '<script>alert("File name Already exist. Please rename file and Try Again"); location.href="depawards.php";</script>';
      							}
      						}
							if($ufE != $uafE)
      						{
      							echo '<script>alert("File extension must be pdf"); location.href="depawards.php";</script>';
      						}
						}
						if($_FILES['ucf']['error'] == UPLOAD_ERR_NO_FILE)
						{
							$wu21 = "UPDATE awards SET cname='$ucn',  caward='$ucs', ccontribution='$uce', cyear='$ucy', cuid='$ciu' where cuid='$uci' and cname='$uci1' and cyear='$uci2' ";
							if (mysqli_query($con, $wu21))
							{
								echo '<script>alert("Award Details updated Successfully"); location.href="depawards.php"</script>';
							}
							else
							{
								echo '<script>alert("Error while updating"); location.href="depawards.php"</script>';
							}
						}
					}
					if(mysqli_num_rows($sqlzr) == 1)
					{
						echo '<script>alert("Award Already exist."); location.href="depawards.php";</script>';
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
      							echo '<script>alert("File name Already exist. Please rename file and Try Again"); location.href = "depawards.php";</script>';
      						}
      						if (!file_exists($udp))
      						{
       							if(move_uploaded_file($ufT, $udp)) 
      							{
									$wu1 = "UPDATE awards SET cfile='$unFN', cname='$ucn', caward='$ucs', ccontribution='$uce', cyear='$ucy', cuid='$ciu' where cuid='$uci' and cname='$uci1'  and cyear='$uci2' ";
									if (mysqli_query($con, $wu1))
									{
										echo '<script>alert("award Details Updated Successfully"); location.href="depawards.php"</script>';
									}
									else
									{
										echo '<script>alert("Error while updating"); location.href="depawards.php"</script>';
									}
								}
							}
							if (file_exists($udp))
      						{
      							echo '<script>alert("File name Already exist. Please rename file and Try Again"); location.href="depawards.php";</script>';
      						}
      					}
						if($ufE != $uafE)
      					{
      						echo '<script>alert("File extension must be pdf"); location.href="depawards.php";</script>';
      					}
					}	
					if($_FILES['ucf']['error'] == UPLOAD_ERR_NO_FILE)
					{
						$wu2 = "UPDATE awards SET cname='$ucn',  caward='$ucs', ccontribution='$uce', cyear='$ucy', cuid='$ciu' where cuid='$ciu' and cname='$uci1'  and cyear='$ucy' ";
						if (mysqli_query($con, $wu2))
						{
							echo '<script>alert("award Details updated Successfully"); location.href="depawards.php"</script>';
						}
						else
						{
							echo '<script>alert("Error while updating"); location.href="depawards.php"</script>';
						}
					}
      			}
			}
			if(mysqli_num_rows(mysqli_query($con, $uqsa2)) != 1)
			{
				echo '<script>alert("Please check the faculty ID"); location.href="depawards.php"</script>';
			}
		}
		if(!empty($_GET['del']) && !empty($_GET['del1']) && !empty($_GET['del2'])) //code to delete the selected award
		{
			$m = $_GET['del'];
			$m1 = $_GET['del1'];
			$m2 = $_GET['del2'];
			$selectSql = "SELECT * from awards where cuid='$m' and cname = '$m1'  and cyear='$m2' ";
			$rsSelect = mysqli_query($con, $selectSql);
			$getRow = mysqli_fetch_assoc($rsSelect);
			$getName = $getRow['cfile'];
			$createDeletePath = "certs/".$getName;
			if(unlink($createDeletePath))
			{
				$sqle = "DELETE FROM awards where cuid='$m' and cname = '$m1'  and cyear='$m2' ";
				if(mysqli_query($con, $sqle))
				{
					echo '<script>alert("Deleted Successfully"); location.href="depawards.php"</script>';
				}
				else
				{
					echo '<script>alert("Error while Deleting"); location.href="depawards.php"</script>';
				}
			}
		}
		?>
</body>
</html>
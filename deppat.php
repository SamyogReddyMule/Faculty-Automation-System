<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Patents</title>
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
		<img src="Images/patents.jfif">
	</div>
	<h3 class="h2"> Patents </h3>
	<table id="t1" class="cert">
		<tr>
            <th> Title </th>
			<th> Authors </th>
			<th> Application Number</th>
			<th> Position </th>
            <th> Year </th>
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
			$w = "SELECT * FROM patents where cuid='$uidi' ";
			$wr = mysqli_query($con, $w);
			while($wv = mysqli_fetch_array($wr))
			{
				$nam1 = urlencode($wv["cname"]);
				$nam = urlencode($wv["cuid"]);
				$nam2 = urlencode($wv["cyear"]);
			?>
			<tr>
				<td><?php echo $wv["cname"]; ?> </td>
				<td><?php echo $wv["cauthor"]; ?> </td>
				<td><?php echo $wv["cnumber"]; ?></td>
				<td><?php echo $wv["cpos"]; ?></td>
				<td><?php echo $wv["cyear"]; ?></td>
				<td><?php echo $wv["cstatus"]; ?> </td>
				<td><a style="text-decoration: none;" href="certs/<?php echo $wv["cfile"]; ?>" target="_blank"><?php echo $wv["cfile"]; ?> </td>
				<th><a style="text-decoration: none;" href="deppat.php?upd=<?php echo $nam; ?>&upd1=<?php echo $nam1; ?>&upd2=<?php echo $nam2; ?>" id="upd" title="Edit patents"> Y </a></th>
                <th><a style="text-decoration: none;" onclick="javascript: return confirm('Do you wnat to delete patents <?php echo $wv["cname"]; ?>');" href="deppat.php?del=<?php echo $nam; ?>&del1=<?php echo $nam1; ?>&del2=<?php echo $nam2; ?>" > X </a></th>
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
       <h3 class="h3">Insert Patents</h3>

        <label class="l1" > Unique ID </label>
        <input class="i1" type="text" placeholder="Enter Unique ID of Faculty" name="ci" required> <br>

        <label class="l1"> Title </label>
        <input class="i1" type="text" placeholder="Enter patents Title" name="cn" required><br>

		<label class="l1"> Authors </label>
        <input class="i1" type="text" name="ca" required> <br>

        <label class="l1"> Application Number</label>
        <input class="i1" type="text" name="cs" required> <br>

        <label class="l1"> Position</label>
        <input class="i1" type="text" name="ce" required> <br>

		<label class="l1"> Year </label>
        <input class="i1" type="text" placeholder="Enter Year" name="cy"  required> <br>
		
        <label class="l1"> Status </label>
        <input class="i1" type="text" name="ct" required> <br>

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
			$qsa = "SELECT * FROM patents where cuid = '$ci' and cname='$cn' and cyear='$cy'and cauthor='$ca' ";
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
      							$sql2 = "INSERT into patents SET cfile='$nFN', cname='$cn', cnumber='$cs', cpos='$ce', cyear='$cy', cuid='$ci, cauthor='$ca', cstatus='$ct'";
      							if (mysqli_query($con, $sql2))
      							{
      								echo '<script>alert("patents Added Successfully"); location.href="deppat.php"</script>';
      							}
      							else
      							{
      								echo '<script>alert("Error while Adding"); location.href="deppat.php"</script>';
      							}
      						}
      					}
      					if (file_exists($dp))
      					{
      						echo '<script>alert("File name Already exist. Please rename file and Try Again"); location.href="deppat.php";</script>';
      					}
      				}
      				if($fE != $afE)
      				{
      					echo '<script>alert("File extension must be pdf"); location.href="deppat.php";</script>';
      				}
      			}
      			if(mysqli_num_rows($qsar) == 1)
      			{
      				echo '<script>alert("patents Already exist."); location.href="deppat.php";</script>';
      			}
      		}
      		if(mysqli_num_rows(mysqli_query($con, $qsa2)) != 1)
      		{
      			echo '<script>alert("Faculty doesnt exist"); location.href="deppat.php";</script>';
      		}
		}
		if(!empty($_GET['upd']) && !empty($_GET['upd1']) && !empty($_GET['upd2']))
		{
			$uci = $_GET['upd'];
			$uci1 = $_GET['upd1'];
			$uci2 = $_GET['upd2'];
			$sql1 = "SELECT * FROM patents where cuid='$uci' and cname = '$uci1' and cyear='$uci2'  ";
			$wur = mysqli_query($con, $sql1);
			$wud = mysqli_fetch_array($wur);
			$pcf = $wud['cfile'];
			echo '<script> document.getElementById("f1").style.display = "none";
			document.getElementById("t1").style.display = "none"; </script>';
			echo '<form class="f1" id="f2" action="" method="POST" enctype="multipart/form-data">
			<h3 class="h3">Update Patents</h3>

			<label class="l1" > Unique ID </label>
        	<input class="i1" type="text" placeholder="Enter Unique ID of Faculty" name="ciu" value="'.$wud["cuid"].'" required> <br>

        	<label class="l1"> Title </label>
        	<input class="i1" type="text" placeholder="Enter patents Name" value="'.$wud["cname"].'" name="ucn" required> <br>

			<label class="l1"> Authors </label>
	        <input class="i1" type="text" name="uca" value="'.$wud["cauthor"].'" required> <br>

        	<label class="l1"> Year </label>
        	<input class="i1" type="text" placeholder="Enter Year" name="ucy" value="'.$wud["cyear"].'" required> <br>

	        <label class="l1"> Application Number </label>
	        <input class="i1" type="text" name="ucs" value="'.$wud["cnumber"].'" required> <br>

	        <label class="l1" > Position </label>
	        <input class="i1" type="text" name="uce" value="'.$wud["cpos"].'" required> <br>

	        <label class="l1"> Status </label>
        	<input class="i1" type="text" name="uct" value="'.$wud["cstatus"].'" required> <br>

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
					$sqlz = "SELECT * FROM patents where cuid='$ciu' and cname = '$ucn'  and cyear='$ucy' and cnumber='$ucs' ";
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
										$wu12 = "UPDATE patents SET cfile='$unFN', cname='$ucn',  cnumber='$ucs', cpos='$uce', cyear='$ucy', cuid='$ciu', cauthor='$uca', cstatus='$uct' where cuid='$uci' and cname='$uci1' and  cyear='$uci2' ";
										if (mysqli_query($con, $wu12))
										{
											echo '<script>alert("patents Details Updated Successfully"); location.href="deppat.php"</script>';
										}
										else
										{
											echo '<script>alert("Error while updating"); location.href="deppat.php"</script>';
										}
									}
								}
								if (file_exists($udp))
      							{
      								echo '<script>alert("File name Already exist. Please rename file and Try Again"); location.href="deppat.php";</script>';
      							}
      						}
							if($ufE != $uafE)
      						{
      							echo '<script>alert("File extension must be pdf"); location.href="deppat.php";</script>';
      						}
						}
						if($_FILES['ucf']['error'] == UPLOAD_ERR_NO_FILE)
						{
							$wu21 = "UPDATE patents SET cname='$ucn',  cnumber='$ucs', cpos='$uce', cyear='$ucy', cuid='$ciu', cauthor='$uca', cstatus='$uct' where cuid='$uci' and cname='$uci1' and cyear='$uci2' ";
							if (mysqli_query($con, $wu21))
							{
								echo '<script>alert("patents Details updated Successfully"); location.href="deppat.php"</script>';
							}
							else
							{
								echo '<script>alert("Error while updating"); location.href="deppat.php"</script>';
							}
						}
					}
					if(mysqli_num_rows($sqlzr) == 1)
					{
						echo '<script>alert("patents Already exist."); location.href="deppat.php";</script>';
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
      							echo '<script>alert("File name Already exist. Please rename file and Try Again"); location.href = "deppat.php";</script>';
      						}
      						if (!file_exists($udp))
      						{
       							if(move_uploaded_file($ufT, $udp)) 
      							{
									$wu1 = "UPDATE patents SET cfile='$unFN', cname='$ucn',  cnumber='$ucs', cpos='$uce', cyear='$ucy', cuid='$ciu', cauthor='$uca', cstatus='$uct' where cuid='$uci' and cname='$uci1'  and cyear='$uci2' ";
									if (mysqli_query($con, $wu1))
									{
										echo '<script>alert("patents Details Updated Successfully"); location.href="deppat.php"</script>';
									}
									else
									{
										echo '<script>alert("Error while updating"); location.href="deppat.php"</script>';
									}
								}
							}
							if (file_exists($udp))
      						{
      							echo '<script>alert("File name Already exist. Please rename file and Try Again"); location.href="deppat.php";</script>';
      						}
      					}
						if($ufE != $uafE)
      					{
      						echo '<script>alert("File extension must be pdf"); location.href="deppat.php";</script>';
      					}
					}	
					if($_FILES['ucf']['error'] == UPLOAD_ERR_NO_FILE)
					{
						$wu2 = "UPDATE patents SET cname='$ucn',  cnumber='$ucs', cpos='$uce', cyear='$ucy', cuid='$ciu', cauthor='$uca', cstatus='$uct' where cuid='$ciu' and cname='$uci1' and cyear='$ucy' ";
						if (mysqli_query($con, $wu2))
						{
							echo '<script>alert("patents Details updated Successfully"); location.href="deppat.php"</script>';
						}
						else
						{
							echo '<script>alert("Error while updating"); location.href="deppat.php"</script>';
						}
					}
      			}
			}
			if(mysqli_num_rows(mysqli_query($con, $uqsa2)) != 1)
			{
				echo '<script>alert("Please check the faculty ID"); location.href="deppat.php"</script>';
			}
		}
		if(!empty($_GET['del']) && !empty($_GET['del1']) && !empty($_GET['del2'])) //code to delete the selected patents
		{
			$m = $_GET['del'];
			$m1 = $_GET['del1'];
			$m2 = $_GET['del2'];
			$selectSql = "SELECT * from patents where cuid='$m' and cname = '$m1' and  cyear='$m2' ";
			$rsSelect = mysqli_query($con, $selectSql);
			$getRow = mysqli_fetch_assoc($rsSelect);
			$getName = $getRow['cfile'];
			$createDeletePath = "certs/".$getName;
			if(unlink($createDeletePath))
			{
				$sqle = "DELETE FROM patents where cuid='$m' and cname = '$m1' and cyear='$m2' ";
				if(mysqli_query($con, $sqle))
				{
					echo '<script>alert("Deleted Successfully"); location.href="deppat.php"</script>';
				}
				else
				{
					echo '<script>alert("Error while Deleting"); location.href="deppat.php"</script>';
				}
			}
		}
		?>
</body>
</html>
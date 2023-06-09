<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Paper Publication</title>
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
		?>
		<div style="padding-top: 10px; justify-content: center; display: flex; ">
			<img src="Images/ppubications.png">
		</div>
		<?php
		$f = "SELECT fuid, fname FROM faculty_details ";
		$fr = mysqli_query($con, $f);	
	?>
	<h3 class="h2"> Paper Publication </h3>
	<table id="t1" class="cert">
		<tr>
			<th> Name </th>
			<th> Year </th>
            <th> Type of Publication </th>
			<th> Name of the Journal/Conference </th>
			<th> Volume </th>
			<th> UGC/SCOPUS/SCI Indexed </th>
            <th> H Index </th>
            <th> Citations </th>
			<th> File </th>
			<th> Edit </th>
			<th> Delete </th>
		</tr>
	<?php
	while($fd = mysqli_fetch_array($fr))
		{
			echo '<tr> <th colspan="11" style="background-color: grey; "> '.$fd["fname"].'</th> </tr>';
			$uidi = $fd["fuid"];
			$w = "SELECT * FROM certifications where ctype = 'Paper Publication' and cuid='$uidi' ";
			$wr = mysqli_query($con, $w);
			while($wv = mysqli_fetch_array($wr))
			{
				$nam1 = urlencode($wv["cname"]);
				$nam = urlencode($wv["cuid"]);
				$nam2 = urlencode($wv["cyear"]);
			?>
			<tr>
				<td><?php echo $wv["cname"]; ?> </td>
				<td><?php echo $wv["cyear"]; ?></td>
                <td><?php echo $wv["cttype"]; ?> </td>
				<td><?php echo $wv["cjournal"]; ?></td>
				<td><?php echo $wv["cvol"]; ?></td>
				<td><?php echo $wv["cindex"]; ?></td>
                <td><?php echo $wv["chindex"]; ?></td>
                <td><?php echo $wv["ccite"]; ?></td>
				<td><a style="text-decoration: none;" href="certs/<?php echo $wv["cfile"]; ?>" target="_blank"><?php echo $wv["cfile"]; ?> </td>
				<th><a style="text-decoration: none;" href="adminppresent.php?upd=<?php echo $nam; ?>&upd1=<?php echo $nam1; ?>&upd2=<?php echo $nam2; ?>" id="upd" title="Edit Paper Publication"> Y </a></th>
                <th><a style="text-decoration: none;" onclick="javascript: return confirm('Do you wnat to delete Paper Publication <?php echo $wv["cname"]; ?>');" href="adminppresent.php?del=<?php echo $nam; ?>&del1=<?php echo $nam1; ?>&del2=<?php echo $nam2; ?>" > X </a></th>
            </tr>
        <?php 
    	}
    }
     ?>
		<tr>
			<td style="text-align: center;" colspan="11"><button class="b1" id = "b1" onclick="add()" > Add </button> </td>
		</tr>
	</table>

	<form class="f1" id="f1" action="" method="POST" style="display: none" enctype="multipart/form-data">
       <h3 class="h3">Insert Paper Publication</h3>

        <label class="l1" > Unique ID </label>
        <input class="i1" type="text" placeholder="Enter Unique ID of Faculty" name="ci" required> <br>

        <label class="l1"> Title </label>
        <input class="i1" type="text" placeholder="Enter Paper Publication Title" name="cn" required><br>

        <label class="l1"> Year </label>
        <input class="i1" type="number" placeholder="Enter Year" name="cy" pattern="(?:[0-9]{4})" min="1920" max="<?php echo date("Y"); ?>" title="Must be a calender year" required> <br>

        <label class="l1"> Type of Publication</label>
        <select class="s1" name="ctt"  required>
			<option value="Journal">Journal</option>
			<option value="Conference">Conference</option>
		</select> <br>

        <label class="l1"> Name of Journal/Conference</label>
        <input class="i1" type="text" name="cs" required> <br>

        <label class="l1"> Volume </label>
        <input class="i1" type="text" name="ce" required> <br>

        <label class="l1"> UGC/SCOPUS/SCI Indexed</label>
        <input class="i1" type="text" name="ct" required> <br>

        <label class="l1"> H Index </label>
        <input class="i1" type="text" name="ch" required> <br>

        <label class="l1"> Citations </label>
        <input class="i1" type="text" name="cc" required> <br>

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
            $ch = $_POST['ch'];
			$cc = $_POST['cc'];
			$ctt = $_POST['ctt'];
			$cf = $_FILES['cf']['name'];
			$qsa2 = "SELECT * FROM faculty_details where fuid = '$ci' ";
			if(mysqli_num_rows(mysqli_query($con, $qsa2)) == 1)
			{
			$qsa = "SELECT * FROM certifications where cuid = '$ci' and ctype = 'Paper Publication' and cname='$cn' and cyear='$cy' ";
			$qsar = mysqli_query($con, $qsa);
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
      						$sql2 = "INSERT into certifications SET cfile='$nFN', cname='$cn', cindex='$ct', cjournal='$cs', cvol='$ce', cyear='$cy',chindex='$ch',ccite='$cc',cttype='$ctt', ctype='Paper Publication', cuid='$ci'";
      						if (mysqli_query($con, $sql2))
      						{
      							echo '<script>alert("Paper Publication Added Successfully"); location.href="adminppresent.php"</script>';
      						}
      						else
      						{
      							echo '<script>alert("Error while Adding"); location.href="adminppresent.php"</script>';
      						}
      					}
      				}
      				if (file_exists($dp))
      				{
      					echo '<script>alert("File name Already exist. Please rename file and Try Again"); location.href="adminppresent.php";</script>';
      				}
      			}
      			if($fE != $afE)
      			{
      				echo '<script>alert("File extension must be pdf"); location.href="adminppresent.php";</script>';
      			}
      		}
      		if(mysqli_num_rows($qsar) == 1)
      		{
      			echo '<script>alert("Paper Publication Already exist."); location.href="adminppresent.php";</script>';
      		}
      	}
      	if(mysqli_num_rows(mysqli_query($con, $qsa2)) != 1)
			{
				echo '<script>alert("Faculty Id is wrong or doesnt exists"); location.href="adminppresent.php";</script>';
			}
		}
		if(!empty($_GET['upd']) && !empty($_GET['upd1']) && !empty($_GET['upd2']))
		{
			$uci = $_GET['upd'];
			$uci1 = $_GET['upd1'];
			$uci2 = $_GET['upd2'];
			$sql1 = "SELECT * FROM certifications where cuid='$uci' and cname = '$uci1' and ctype='Paper Publication' and cyear='$uci2' ";
			$wur = mysqli_query($con, $sql1);
			$wud = mysqli_fetch_array($wur);
			$pcf = $wud['cfile'];
			echo '<script> document.getElementById("f1").style.display = "none";
			document.getElementById("t1").style.display = "none"; </script>';
			echo '<form class="f1" id="f2" action="" method="POST" enctype="multipart/form-data">
			<h3 class="h3">Update Paper Publication</h3>

			<label class="l1" > Unique ID </label>
        	<input class="i1" type="text" placeholder="Enter Unique ID of Faculty" name="ciu" value="'.$wud["cuid"].'" required> <br>

        	<label class="l1"> Title </label>
        	<input class="i1" type="text" placeholder="Enter Paper Publication Name" value="'.$wud["cname"].'" name="ucn" required> <br>

        	<label class="l1"> Year </label>
        	<input class="i1" type="number" placeholder="Enter Year" name="ucy" value="'.$wud["cyear"].'" pattern="(?:[0-9]{4})" min="1920" max="'.date("Y").'" title="Must be a calender year" required> <br>

	        <label class="l1"> Name of the Conference/Journal </label>
	        <input class="i1" type="text" name="ucs" value="'.$wud["cjournal"].'" required> <br>

	        <label class="l1" > Volume </label>
	        <input class="i1" type="text" name="uce" value="'.$wud["cvol"].'" required> <br>

	        <label class="l1"> UGC/SCOPUS/SCI Indexed</label>
        	<input class="i1" type="text" name="uct" value="'.$wud["cindex"].'" required> <br>

            <label class="l1"> Type of Publication </label>
	        <select class="s1" name="uctt" value="'.$wud["cttype"].'" required>
                <option value="Journal">Journal</option>
			    <option value="Conference">Conference</option>
			</select>
            <br>

	        <label class="l1" > H Index </label>
	        <input class="i1" type="text" name="uch" value="'.$wud["chindex"].'" required> <br>

	        <label class="l1"> Citations </label>
        	<input class="i1" type="text" name="ucc" value="'.$wud["ccite"].'" required> <br>

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
            $uch = $_POST['uch'];
			$ucc = $_POST['ucc'];
			$uctt = $_POST['uctt'];
			$uqsa2 = "SELECT * FROM faculty_details where fuid = '$ciu' ";
			if(mysqli_num_rows(mysqli_query($con, $uqsa2)) == 1)
			{
			if($ciu != $uci || $ucn != $uci1 || $ucy != $uci2) 
			{ 
				$sqlz = "SELECT * FROM certifications where cuid='$ciu' and cname = '$ucn' and ctype='Paper Publication' and cyear='$ucy' and cjournal='$ucs' ";
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
									$wu12 = "UPDATE certifications SET cfile='$unFN', cname='$ucn', cindex='$uct', cjournal='$ucs', cvol='$uce', cyear='$ucy',chindex='$uch',ccite='$ucc',cttype='$uctt', cuid='$ciu' where cuid='$uci' and cname='$uci1' and ctype='Paper Publication' and cyear='$uci2' ";
									if (mysqli_query($con, $wu12))
									{
										echo '<script>alert("Paper Publication Details Updated Successfully"); location.href="adminppresent.php"</script>';
									}
									else
									{
										echo '<script>alert("Error while updating"); location.href="adminppresent.php"</script>';
									}
								}
							}
							if (file_exists($udp))
      						{
      							echo '<script>alert("File name Already exist. Please rename file and Try Again"); location.href="adminppresent.php";</script>';
      						}
      					}
						if($ufE != $uafE)
      					{
      						echo '<script>alert("File extension must be pdf"); location.href="adminppresent.php";</script>';
      					}
					}
					if($_FILES['ucf']['error'] == UPLOAD_ERR_NO_FILE)
					{
						$wu21 = "UPDATE certifications SET cname='$ucn', cindex='$uct', cjournal='$ucs', cvol='$uce', cyear='$ucy', cyear='$ucy',chindex='$uch',ccite='$ucc',cttype='$uctt', cuid='$ciu' where cuid='$uci', cuid='$uci' and cname='$uci1' and ctype='Paper Publication' and cyear='$uci2' ";
						if (mysqli_query($con, $wu21))
						{
							echo '<script>alert("Paper Publication Details updated Successfully"); location.href="adminppresent.php"</script>';
						}
						else
						{
							echo '<script>alert("Error while updating"); location.href="adminppresent.php"</script>';
						}
					}
				}
				if(mysqli_num_rows($sqlzr) == 1)
				{
					echo '<script>alert("Paper Publication Already exist."); location.href="adminppresent.php";</script>';
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
      						echo '<script>alert("File name Already exist. Please rename file and Try Again"); location.href = "adminppresent.php";</script>';
      					}
      					if (!file_exists($udp))
      					{
       						if(move_uploaded_file($ufT, $udp)) 
      						{
								$wu1 = "UPDATE certifications SET cfile='$unFN', cname='$ucn', cindex='$uct', cjournal='$ucs', cvol='$uce', cyear='$ucy',chindex='$uch',ccite='$ucc',cttype='$uctt', cuid='$ciu' where cuid='$uci' and cname='$uci1' and ctype='Paper Publication' and cyear='$uci2' ";
								if (mysqli_query($con, $wu1))
								{
									echo '<script>alert("Paper Publication Details Updated Successfully"); location.href="adminppresent.php"</script>';
								}
								else
								{
									echo '<script>alert("Error while updating"); location.href="adminppresent.php"</script>';
								}
							}
						}
						if (file_exists($udp))
      					{
      						echo '<script>alert("File name Already exist. Please rename file and Try Again"); location.href="adminppresent.php";</script>';
      					}
      				}
					if($ufE != $uafE)
      				{
      					echo '<script>alert("File extension must be pdf"); location.href="adminppresent.php";</script>';
      				}
				}
				if($_FILES['ucf']['error'] == UPLOAD_ERR_NO_FILE)
				{
					$wu2 = "UPDATE certifications SET cname='$ucn', cindex='$uct', cjournal='$ucs', cvol='$uce', cyear='$ucy',chindex='$uch',ccite='$ucc',cttype='$uctt', cuid='$ciu' where cuid='$ciu' and cname='$uci1' and ctype='Paper Publication' and cyear='$ucy' ";
					if (mysqli_query($con, $wu2))
					{
						echo '<script>alert("Paper Publication Details updated Successfully"); location.href="adminppresent.php"</script>';
					}
					else
					{
						echo '<script>alert("Error while updating"); location.href="adminppresent.php"</script>';
					}
				}
      		}
		}
		if(mysqli_num_rows(mysqli_query($con, $uqsa2)) != 1)
			{
				echo '<script>alert("Faculty Id is wrong or doesnt exists"); location.href="adminppresent.php";</script>';
			}
		}
		if(!empty($_GET['del']) && !empty($_GET['del1']) && !empty($_GET['del2'])) //code to delete the selected Paper Publication
		{
			$m = $_GET['del'];
			$m1 = $_GET['del1'];
			$m2 = $_GET['del2'];
			$selectSql = "SELECT * from certifications where cuid='$m' and cname = '$m1' and ctype='Paper Publication' and cyear='$m2' ";
			$rsSelect = mysqli_query($con, $selectSql);
			$getRow = mysqli_fetch_assoc($rsSelect);
			$getName = $getRow['cfile'];
			$createDeletePath = "certs/".$getName;
			if(unlink($createDeletePath))
			{
				$sqle = "DELETE FROM certifications where cuid='$m' and cname = '$m1' and ctype='Paper Publication' and cyear='$m2' ";
				if(mysqli_query($con, $sqle))
				{
					echo '<script>alert("Deleted Successfully"); location.href="adminppresent.php"</script>';
				}
				else
				{
					echo '<script>alert("Error while Deleting"); location.href="adminppresent.php"</script>';
				}
			}
		}
		?>
</body>
</html>
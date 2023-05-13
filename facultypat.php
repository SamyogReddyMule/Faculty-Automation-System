<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Patents </title>
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
		$cc = "SELECT * FROM patents where cuid = '$uid' ";
		$ccr = mysqli_query($con, $cc);
		?>
	
	<div style="padding-top: 10px; justify-content: center; display: flex; ">
		<img src="Images/patents.jfif">
	</div>
	<h3 class="h2"> Patents </h3>
	<table id="t1" class="cert" style="margin-top: 10px;">
		<tr class="tr1">
			<th> Title </th>
			<th> Application Number</th>
			<th> Position </th>
            <th> Year </th>
			<th> File </th>
			<th> Edit </th>
			<th> Delete </th>
		</tr>
		<?php
			while ($wv = mysqli_fetch_array($ccr))
			{
				$nam = urlencode($wv["cname"]);
				$nam1 = urlencode($wv["cyear"]);
			?>
			<tr>
				<td><?php echo $wv["cname"]; ?> </td>
				<td><?php echo $wv["cnumber"]; ?></td>
				<td><?php echo $wv["cpos"]; ?></td>
                <td><?php echo $wv["cyear"]; ?></td>
				<td><a style="text-decoration: none;" href="certs/<?php echo $wv["cfile"]; ?>" target="_blank"><?php echo $wv["cfile"]; ?> </td>
				<th><a style="text-decoration: none;" href="facultypat.php?upd=<?php echo $nam; ?>&upd1=<?php echo $nam1; ?>" > Y </a></th>
                <th><a style="text-decoration: none;" onClick="javascript: return confirm('Do you want to delete the Patents <?php echo $wv['cname']; ?>');" href="facultypat.php?del=<?php echo $nam; ?>&del1=<?php echo $nam1; ?>" > X </a></th>
            </tr>
        <?php } ?>
		<tr>
			<td style="text-align: center;" colspan="8"><button class="b1" id = "b1" onclick="add()" > Add </button> </td>
		</tr> 
	</table>

	 <form class="f1" id="f1" action="" method="POST" style="display: none" enctype="multipart/form-data">
        <h3 class="h3">Insert Patents</h3>

        <label class="l1"> Title </label>
        <input class="i1" type="text" placeholder="Enter Patents Title" name="cn" required><br>

        <label class="l1" > Acedamic Year </label>
        <input class="i1" type="text" placeholder=" Enter Acedamic Year" pattern="((?:[0-9]{4})-(?:[0-9]{2}))" name="cy" required> <br>

        <label class="l1"> Application Number</label>
        <input class="i1" type="number" name="cs" required> <br>

        <label class="l1"> Position </label>
        <input class="i1" type="number" name="ce" required> <br>

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
			$cf = $_FILES['cf']['name'];
			$qsa = "SELECT * FROM patents where cuid = '$uid'  and cname='$cn' and cyear='$cy' and cnumber='$cs' ";
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
      						$sql2 = "INSERT into patents SET cfile='$nFN', cname='$cn', cnumber='$cs', cpos='$ce', cyear='$cy', cuid='$uid'";
      						if (mysqli_query($con, $sql2))
      						{
      							echo '<script>alert("Patents Added Successfully"); location.href="facultypat.php"</script>';
      						}
      						else
      						{
      							echo '<script>alert("Error while Adding"); location.href="facultypat.php"</script>';
      						}
      					}
      				}
      				if (file_exists($dp)) 
      				{
      					echo '<script>alert("File name Already exist. Please rename file and Try Again"); location.href="facultypat.php";</script>';
      				}
      			}
      			if($fE != $afE)
      			{
      				echo '<script>alert("File extension must be pdf"); location.href="facultypat.php";</script>';
      			}
      		}
      		if(mysqli_num_rows($qsar) == 1)
      		{
      			echo '<script>alert("Patents Already exist."); location.href="facultypat.php";</script>';
      		}
      	}
		if(!empty($_GET['upd']) && !empty($_GET['upd1']))
		{
			$uci = $_GET['upd'];
			$uci1 = $_GET['upd1'];
			$sql1 = "SELECT * FROM patents where cuid='$uid' and cname = '$uci'  and cyear='$uci1' ";
			$wur = mysqli_query($con, $sql1);
			$wud = mysqli_fetch_array($wur);
			$pcf = $wud['cfile'];
			echo '<script> document.getElementById("f1").style.display = "none";
			document.getElementById("t1").style.display = "none"; </script>';
			echo '<form class="f1" id="f2" action="" method="POST" enctype="multipart/form-data">
			<h3 class="h3">Update Patents</h3>

        	<label class="l1"> Title </label>
        	<input class="i1" type="text" placeholder="Enter Patents Name" value="'.$wud["cname"].'" name="ucn" required> <br>

        	<label class="l1" > Acedamic Year </label>
	        <input class="i1" type="text" placeholder=" Enter Acedamic Year" value="'.$wud["cyear"].'" pattern="((?:[0-9]{4})-(?:[0-9]{2}))" name="ucy" required> <br>

	        <label class="l1"> Application Number </label>
	        <input class="i1" type="text" name="ucs" value="'.$wud["cnumber"].'" required> <br>

	        <label class="l1" > Position </label>
	        <input class="i1" type="text" name="uce" value="'.$wud["cpos"].'" required> <br>

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
			if($ucn != $uci || $ucy != $uci1) 
			{ 
				$sqlz = "SELECT * FROM patents where cuid='$uid' and cname = '$ucn'   and cyear='$ucy' and cnumber='$ucs' ";
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
									$wu12 = "UPDATE patents SET cfile='$unFN', cname='$ucn', cnumber='$ucs', cpos='$uce', cyear='$ucy' where cuid='$uid' and cname='$uci'   and cyear='$uci1' ";
									if (mysqli_query($con, $wu12))
									{
										echo '<script>alert("Patents Details Updated Successfully"); location.href="facultypat.php"</script>';
									}
									else
									{
										echo '<script>alert("Error while updating"); location.href="facultypat.php"</script>';
									}
								}
							}
							if (file_exists($udp))
      						{
      							echo '<script>alert("File name Already exist. Please rename file and Try Again"); location.href="facultypat.php";</script>';
      						}
      					}
						if($ufE != $uafE)
      					{
      						echo '<script>alert("File extension must be pdf"); location.href="facultypat.php";</script>';
      					}
					}
					if($_FILES['ucf']['error'] == UPLOAD_ERR_NO_FILE)
					{
						$wu21 = "UPDATE patents SET cname='$ucn', cnumber='$ucs', cpos='$uce', cyear='$ucy' where cuid='$uid' and cname='$uci'   and cyear='$uci1' ";
						if (mysqli_query($con, $wu21))
						{
							echo '<script>alert("Patents Details updated Successfully"); location.href="facultypat.php"</script>';
						}
						else
						{
							echo '<script>alert("Error while updating"); location.href="facultypat.php"</script>';
						}
					}
				}
				if(mysqli_num_rows($sqlzr) == 1)
				{
					echo '<script>alert("Patents Already exist."); location.href="facultypat.php";</script>';
				}
			}
			if($ucn === $uci && $ucy === $uci1)
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
      						echo '<script>alert("File name Already exist. Please rename file and Try Again"); location.href = "facultypat.php";</script>';
      					}
      					if (!file_exists($udp))
      					{
       						if(move_uploaded_file($ufT, $udp)) 
      						{
								$wu1 = "UPDATE patents SET cfile='$unFN', cname='$ucn', cnumber='$ucs', cpos='$uce', cyear='$ucy' where cuid='$uid' and cname='$uci'  and cyear='$uci1' ";
								if (mysqli_query($con, $wu1))
								{
									echo '<script>alert("Patents Details Updated Successfully"); location.href="facultypat.php"</script>';
								}
								else
								{
									echo '<script>alert("Error while updating"); location.href="facultypat.php"</script>';
								}
							}
						}
						if (file_exists($udp))
      					{
      						echo '<script>alert("File name Already exist. Please rename file and Try Again"); location.href="facultypat.php";</script>';
      					}
      				}
					if($ufE != $uafE)
      				{
      					echo '<script>alert("File extension must be pdf"); location.href="facultypat.php";</script>';
      				}
				}
				if($_FILES['ucf']['error'] == UPLOAD_ERR_NO_FILE)
				{
					$wu2 = "UPDATE patents SET cname='$ucn', cnumber='$ucs', cpos='$uce', cyear='$ucy' where cuid='$uid' and cname='$uci'   and cyear='$ucy' ";
					if (mysqli_query($con, $wu2))
					{
						echo '<script>alert("Patents Details updated Successfully"); location.href="facultypat.php"</script>';
					}
					else
					{
						echo '<script>alert("Error while updating"); location.href="facultypat.php"</script>';
					}
				}
      		}
		}
		if(!empty($_GET['del']) && !empty($_GET['del1'])) //code to delete the selected Patents
		{
			$m = $_GET['del'];
			$m1 = $_GET['del1'];
			$selectSql = "SELECT * from patents where cuid='$uid' and cname = '$m'   and cyear='$m1' ";
			$rsSelect = mysqli_query($con, $selectSql);
			$getRow = mysqli_fetch_assoc($rsSelect);
			$getName = $getRow['cfile'];
			$createDeletePath = "certs/".$getName;
			if(unlink($createDeletePath))
			{
				$sqle = "DELETE FROM patents where cuid='$uid' and cname = '$m'   and cyear='$m1' ";
				if(mysqli_query($con, $sqle))
				{
					echo '<script>alert("Deleted Successfully"); location.href="facultypat.php"</script>';
				}
				else
				{
					echo '<script>alert("Error while Deleting"); location.href="facultypat.php"</script>';
				}
			}
		}
		?>
</body>
</html>
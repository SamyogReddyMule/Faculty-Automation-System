<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Skills </title>
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
		$cc = "SELECT * FROM skills where cuid = '$uid' ";
		$ccr = mysqli_query($con, $cc);
		?>
	
	<div style="padding-top: 10px; justify-content: center; display: flex; ">
		<img src="Images/skills.png">
	</div>
	<h3 class="h2"> Skills </h3>
	<table id="t1" class="cert" style="margin-top: 10px;">
		<tr class="tr1">
			<th> Unique ID </th>
			<th>  Type  </th>
			<th>  Title </th>
			<th> File </th>
			<th> Edit </th>
			<th> Delete </th>
		</tr>
		<?php
			while ($wv = mysqli_fetch_array($ccr))
			{
				$nam = urlencode($wv["cname"]);
				$nam1 = urlencode($wv["ctype"]);
			?>
			<tr>
				<td><?php echo $wv["cuid"]; ?> </td>
				<td><?php echo $wv["ctype"]; ?></td>
				<td><?php echo $wv["cname"]; ?></td>
				<td><a style="text-decoration: none;" href="certs/<?php echo $wv["cfile"]; ?>" target="_blank"><?php echo $wv["cfile"]; ?> </td>
				<th><a style="text-decoration: none;" href="facultyskill.php?upd=<?php echo $nam; ?>&upd1=<?php echo $nam1; ?>" > Y </a></th>
                <th><a style="text-decoration: none;" onClick="javascript: return confirm('Do you want to delete the skills <?php echo $wv['cname']; ?>');" href="facultyskill.php?del=<?php echo $nam; ?>&del1=<?php echo $nam1; ?>" > X </a></th>
            </tr>
        <?php } ?>
		<tr>
			<td style="text-align: center;" colspan="8"><button class="b1" id = "b1" onclick="add()" > Add </button> </td>
		</tr> 
	</table>

	 <form class="f1" id="f1" action="" method="POST" style="display: none" enctype="multipart/form-data">
        <h3 class="h3">Insert Skills</h3>

        <label class="l1"> Title </label>
        <input class="i1" type="text" placeholder="Enter skills Title" name="cn" required><br>

        <label class="l1">  Type </label>
        <select class="s1" name="ce"  required>
			<option value="Technology">Technology</option>
			<option value="Programming Language">Programming Language</option>
		</select> <br>

        <label class="l1"> File </label>
        <input class="i1" type="file" name="cf" autocomplete="off"> <br>

        <input class="submit" type="submit" name="add">
    </form>
    <?php
    	if(isset($_POST['add']))
		{
			$cn = $_POST['cn'];			
			$ce = $_POST['ce'];
			$cf = $_FILES['cf']['name'];
			$qsa = "SELECT * FROM skills where cuid = '$uid'  and cname='$cn'  and ctype='$ce' ";
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
      						$sql2 = "INSERT into skills SET cfile='$nFN', cname='$cn', ctype='$ce', cuid='$uid'";
      						if (mysqli_query($con, $sql2))
      						{
      							echo '<script>alert("Skills Added Successfully"); location.href="facultyskill.php"</script>';
      						}
      						else
      						{
      							echo '<script>alert("Error while Adding"); location.href="facultyskill.php"</script>';
      						}
      					}
      				}
      				if (file_exists($dp)) 
      				{
      					echo '<script>alert("File name Already exist. Please rename file and Try Again"); location.href="facultyskill.php";</script>';
      				}
      			}
      			if($fE != $afE)
      			{
      				echo '<script>alert("File extension must be pdf"); location.href="facultyskill.php";</script>';
      			}
      		}
      		if(mysqli_num_rows($qsar) == 1)
      		{
      			echo '<script>alert("Skills Already exist."); location.href="facultyskill.php";</script>';
      		}
      	}
		if(!empty($_GET['upd']) && !empty($_GET['upd1']))
		{
			$uci = $_GET['upd'];
			$uci1 = $_GET['upd1'];
			$sql1 = "SELECT * FROM skills where cuid='$uid' and cname = '$uci'  and ctype='$uci1' ";
			$wur = mysqli_query($con, $sql1);
			$wud = mysqli_fetch_array($wur);
			$pcf = $wud['cfile'];
			echo '<script> document.getElementById("f1").style.display = "none";
			document.getElementById("t1").style.display = "none"; </script>';
			echo '<form class="f1" id="f2" action="" method="POST" enctype="multipart/form-data">
			<h3 class="h3">Update Skills</h3>

        	<label class="l1"> Title </label>
        	<input class="i1" type="text" placeholder="Enter skills Name" value="'.$wud["cname"].'" name="ucn" required> <br>

	        <label class="l1" >  Type </label>
	        <select class="s1" name="uce" value="'.$wud["ctype"].'" required>
				<option value="Technology">Technology</option>
				<option value="Programming Language">Programming Language</option>
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
			$ucn=$_POST['ucn'];
			$uce=$_POST['uce'];
		
			if($ucn != $uci || $uce != $uci1) 
			{ 
				$sqlz = "SELECT * FROM skills where cuid='$uid' and cname = '$ucn' and ctype='$uce' ";
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
									$wu12 = "UPDATE skills SET cfile='$unFN', cname='$ucn',  ctype='$uce' where cuid='$uid' and cname='$uci' and ctype='$uci1'";
									if (mysqli_query($con, $wu12))
									{
										echo '<script>alert("Skills Details Updated Successfully"); location.href="facultyskill.php"</script>';
									}
									else
									{
										echo '<script>alert("Error while updating"); location.href="facultyskill.php"</script>';
									}
								}
							}
							if (file_exists($udp))
      						{
      							echo '<script>alert("File name Already exist. Please rename file and Try Again"); location.href="facultyskill.php";</script>';
      						}
      					}
						if($ufE != $uafE)
      					{
      						echo '<script>alert("File extension must be pdf"); location.href="facultyskill.php";</script>';
      					}
					}
					if($_FILES['ucf']['error'] == UPLOAD_ERR_NO_FILE)
					{
						$wu21 = "UPDATE skills SET cname='$ucn', ctype='$uce' where cuid='$uid' and cname='$uci' and ctype='$uci1' ";
						if (mysqli_query($con, $wu21))
						{
							echo '<script>alert("Skills Details updated Successfully"); location.href="facultyskill.php"</script>';
						}
						else
						{
							echo '<script>alert("Error while updating"); location.href="facultyskill.php"</script>';
						}
					}
				}
				if(mysqli_num_rows($sqlzr) == 1)
				{
					echo '<script>alert("Skills Already exist."); location.href="facultyskill.php";</script>';
				}
			}
			if($ucn === $uci && $uce === $uci1 )
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
      						echo '<script>alert("File name Already exist. Please rename file and Try Again"); location.href = "facultyskill.php";</script>';
      					}
      					if (!file_exists($udp))
      					{
       						if(move_uploaded_file($ufT, $udp)) 
      						{
								$wu1 = "UPDATE skills SET cfile='$unFN', cname='$ucn', ctype='$uce'  where cuid='$uid' and cname='$uci' and ctype='$uci1' ";
								if (mysqli_query($con, $wu1))
								{
									echo '<script>alert("Skills Details Updated Successfully"); location.href="facultyskill.php"</script>';
								}
								else
								{
									echo '<script>alert("Error while updating"); location.href="facultyskill.php"</script>';
								}
							}
						}
						if (file_exists($udp))
      					{
      						echo '<script>alert("File name Already exist. Please rename file and Try Again"); location.href="facultyskill.php";</script>';
      					}
      				}
					if($ufE != $uafE)
      				{
      					echo '<script>alert("File extension must be pdf"); location.href="facultyskill.php";</script>';
      				}
				}
				if($_FILES['ucf']['error'] == UPLOAD_ERR_NO_FILE)
				{
					$wu2 = "UPDATE skills SET cname='$ucn',  ctype='$uce' where cuid='$uid' and cname='$uci' and ctype='$uci1'";
					if (mysqli_query($con, $wu2))
					{
						echo '<script>alert("Skills Details updated Successfully"); location.href="facultyskill.php"</script>';
					}
					else
					{
						echo '<script>alert("Error while updating"); location.href="facultyskill.php"</script>';
					}
				}
      		}
		}
		if(!empty($_GET['del']) && !empty($_GET['del1'])) //code to delete the selected skills
		{
			$m = $_GET['del'];
			$m1 = $_GET['del1'];
			$selectSql = "SELECT * from skills where cuid='$uid' and cname = '$m' and ctype='$m1' ";
			$rsSelect = mysqli_query($con, $selectSql);
			$getRow = mysqli_fetch_assoc($rsSelect);
			$getName = $getRow['cfile'];
			$createDeletePath = "certs/".$getName;
			if(unlink($createDeletePath))
			{
				$sqle = "DELETE FROM skills where cuid='$uid' and cname = '$m' and ctype='$m1' ";
				if(mysqli_query($con, $sqle))
				{
					echo '<script>alert("Deleted Successfully"); location.href="facultyskill.php"</script>';
				}
				else
				{
					echo '<script>alert("Error while Deleting"); location.href="facultyskill.php"</script>';
				}
			}
		}
		?>
</body>
</html>
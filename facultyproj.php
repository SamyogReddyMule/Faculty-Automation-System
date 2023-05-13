<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Projects </title>
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
		$cc = "SELECT * FROM projects where cuid = '$uid' and ctype = 'Sponsored'";
		$ccr = mysqli_query($con, $cc);

        $cc1 = "SELECT * FROM projects where cuid = '$uid' and ctype = 'Consultancy'";
		$ccr1 = mysqli_query($con, $cc1);
		?>
	
	<div style="padding-top: 10px; justify-content: center; display: flex; ">
		<img src="Images/projects.png">
	</div>
	<h3 class="h2"> Sponsored Projects </h3>
	<table id="t1" class="cert" style="margin-top: 10px;">
		<tr class="tr1">
			<th> Title </th>
            <th> Sponsored by </th>
			<th> Amount</th>
			<th> Period</th>
            <th> Status</th>
			<th> File </th>
			<th> Edit </th>
			<th> Delete </th>
		</tr>
		<?php
			while ($wv = mysqli_fetch_array($ccr))
			{
				$nam = urlencode($wv["cname"]);
				$nam1 = urlencode($wv["cperson"]);
			?>
			<tr>
				<td><?php echo $wv["cname"]; ?> </td>
				<td><?php echo $wv["cperson"]; ?></td>
				<td><?php echo $wv["camount"]; ?></td>
                <td><?php echo $wv["cperiod"]; ?></td>
				<td><?php echo $wv["cstatus"]; ?></td>
				<td><a style="text-decoration: none;" href="certs/<?php echo $wv["cfile"]; ?>" target="_blank"><?php echo $wv["cfile"]; ?> </td>
				<th><a style="text-decoration: none;" href="facultyproj.php?upd=<?php echo $nam; ?>&upd1=<?php echo $nam1; ?>" > Y </a></th>
                <th><a style="text-decoration: none;" onClick="javascript: return confirm('Do you want to delete the projects <?php echo $wv['cname']; ?>');" href="facultyproj.php?del=<?php echo $nam; ?>&del1=<?php echo $nam1; ?>" > X </a></th>
            </tr>
        <?php } ?>
		<tr>
			<td style="text-align: center;" colspan="8"><button class="b1" id = "b1" onclick="add()" > Add </button> </td>
		</tr> 
	</table>

    <h3 class="h2"> Consultancy Projects </h3>
	<table id="t1" class="cert" style="margin-top: 10px;">
		<tr class="tr1">
            <th> Title </th>
            <th> Agency </th>
			<th> Amount</th>
			<th> Period</th>
            <th> Status</th>
			<th> File </th>
			<th> Edit </th>
			<th> Delete </th>>
		</tr>
		<?php
			while ($wv = mysqli_fetch_array($ccr1))
			{
				$nam = urlencode($wv["cname"]);
				$nam1 = urlencode($wv["cperson"]);
			?>
			<tr>
				<td><?php echo $wv["cname"]; ?> </td>
				<td><?php echo $wv["cperson"]; ?></td>
				<td><?php echo $wv["camount"]; ?></td>
                <td><?php echo $wv["cperiod"]; ?></td>
				<td><?php echo $wv["cstatus"]; ?></td>
				<td><a style="text-decoration: none;" href="certs/<?php echo $wv["cfile"]; ?>" target="_blank"><?php echo $wv["cfile"]; ?> </td>
				<th><a style="text-decoration: none;" href="facultyproj.php?upd=<?php echo $nam; ?>&upd1=<?php echo $nam1; ?>" > Y </a></th>
                <th><a style="text-decoration: none;" onClick="javascript: return confirm('Do you want to delete the projects <?php echo $wv['cname']; ?>');" href="facultyproj.php?del=<?php echo $nam; ?>&del1=<?php echo $nam1; ?>" > X </a></th>
            </tr>
        <?php } ?>
		<tr>
			<td style="text-align: center;" colspan="8"><button class="b1" id = "b1" onclick="add()" > Add </button> </td>
		</tr> 
	</table>

	 <form class="f1" id="f1" action="" method="POST" style="display: none" enctype="multipart/form-data">
        <h3 class="h3">Insert Projects</h3>

        <label class="l1"> Title </label>
        <input class="i1" type="text" placeholder="Enter Projects Title" name="cn" required><br>

        <label class="l1"> Project Type </label>
        <select class="s1" name="ce"  required>
			<option value="Sponsored">Sponsored</option>
			<option value="Consultancy">Consultancy</option>
		</select> <br>

        <label class="l1"> Sponsored by / Agency</label>
        <input class="i1" type="text" name="cs" required> <br>

        <label class="l1"> Amount </label>
        <input class="i1" type="text" name="ca" required> <br>

        <label class="l1"> Period </label>
        <input class="i1" type="text" name="cp" required> <br>

        <label class="l1"> Status </label>
			<select class="s1" name="ct"  required>
				<option value="Completed">Completed</option>
				<option value="Ongoing">Ongoing</option>
			</select> <br>

        <label class="l1"> File </label>
        <input class="i1" type="file" name="cf" autocomplete="off" required> <br>

        <input class="submit" type="submit" name="add">
    </form>
    <?php
    	if(isset($_POST['add']))
		{
			$cn = $_POST['cn'];			
			$cs = $_POST['cs'];
			$ce = $_POST['ce'];
            $ca = $_POST['ca'];			
			$cp = $_POST['cp'];
			$ct = $_POST['ct'];
			$cf = $_FILES['cf']['name'];
			$qsa = "SELECT * FROM projects where cuid = '$uid'  and cname='$cn'  and cperson='$cs' and ctype='$ce' ";
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
      						$sql2 = "INSERT into projects SET cfile='$nFN', cname='$cn', cperson='$cs', ctype='$ce',camount='$ca', cperiod='$cp', cstatus='$ct',  cuid='$uid'";
      						if (mysqli_query($con, $sql2))
      						{
      							echo '<script>alert("Projects  Added Successfully"); location.href="facultyproj.php"</script>';
      						}
      						else
      						{
      							echo '<script>alert("Error while Adding"); location.href="facultyproj.php"</script>';
      						}
      					}
      				}
      				if (file_exists($dp)) 
      				{
      					echo '<script>alert("File name Already exist. Please rename file and Try Again"); location.href="facultyproj.php";</script>';
      				}
      			}
      			if($fE != $afE)
      			{
      				echo '<script>alert("File extension must be pdf"); location.href="facultyproj.php";</script>';
      			}
      		}
      		if(mysqli_num_rows($qsar) == 1)
      		{
      			echo '<script>alert("Projects  Already exist."); location.href="facultyproj.php";</script>';
      		}
      	}
		if(!empty($_GET['upd']) && !empty($_GET['upd1']))
		{
			$uci = $_GET['upd'];
			$uci1 = $_GET['upd1'];
			$sql1 = "SELECT * FROM projects where cuid='$uid' and cname = '$uci'  and cperson='$uci1' ";
			$wur = mysqli_query($con, $sql1);
			$wud = mysqli_fetch_array($wur);
			$pcf = $wud['cfile'];
			echo '<script> document.getElementById("f1").style.display = "none";
			document.getElementById("t1").style.display = "none"; </script>';
			echo '<form class="f1" id="f2" action="" method="POST" enctype="multipart/form-data">
			<h3 class="h3">Update projects</h3>

        	<label class="l1"> Title </label>
        	<input class="i1" type="text" placeholder="Enter Projects Name" value="'.$wud["cname"].'" name="ucn" required> <br>        

            <label class="l1"> Project Type </label>
			<select class="s1" name="uce" value="'.$wud["ctype"].'" required>
					<option value="Sponsored">Sponsored</option>
					<option value="Consultancy">Consultancy</option>
				</select> <br>

            <label class="l1" > Amount </label>
	        <input class="i1" type="text" name="uca" value="'.$wud["camount"].'" required> <br>

			<label class="l1" > Sponsored by / Agency </label>
	        <input class="i1" type="text" name="ucs" value="'.$wud["cperson"].'" required> <br>

            <label class="l1"> Period</label>
	        <input class="i1" type="text" name="ucp" value="'.$wud["cperiod"].'" required> <br>

            <label class="l1"> Status</label>
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
			$ucn=$_POST['ucn'];
			$ucs=$_POST['ucs'];
            $uca=$_POST['uca'];
			$ucp=$_POST['ucp'];
			$uct=$_POST['uct'];
		
			if($ucn != $uci || $ucs != $uci1) 
			{ 
				$sqlz = "SELECT * FROM projects where cuid='$uid' and cname = '$ucn' and cperson='$ucs'  ";
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
									$wu12 = "UPDATE projects SET cname='$ucn', cperson='$ucs',  camount='$uca', cperiod='$ucp', cstatus='$uct' where cuid='$uid' and cname='$uci' and cperson='$uci1'";
									if (mysqli_query($con, $wu12))
									{
										echo '<script>alert("Projects  Details Updated Successfully"); location.href="facultyproj.php"</script>';
									}
									else
									{
										echo '<script>alert("Error while updating"); location.href="facultyproj.php"</script>';
									}
								}
							}
							if (file_exists($udp))
      						{
      							echo '<script>alert("File name Already exist. Please rename file and Try Again"); location.href="facultyproj.php";</script>';
      						}
      					}
						if($ufE != $uafE)
      					{
      						echo '<script>alert("File extension must be pdf"); location.href="facultyproj.php";</script>';
      					}
					}
					if($_FILES['ucf']['error'] == UPLOAD_ERR_NO_FILE)
					{
						$wu21 = "UPDATE projects SET cname='$ucn', cperson='$ucs',  camount='$uca', cperiod='$ucp', cstatus='$uct'where cuid='$uid' and cname='$uci' and cperson='$uci1' ";
						if (mysqli_query($con, $wu21))
						{
							echo '<script>alert("Projects  Details updated Successfully"); location.href="facultyproj.php"</script>';
						}
						else
						{
							echo '<script>alert("Error while updating"); location.href="facultyproj.php"</script>';
						}
					}
				}
				if(mysqli_num_rows($sqlzr) == 1)
				{
					echo '<script>alert("Projects  Already exist."); location.href="facultyproj.php";</script>';
				}
			}
			if($ucn === $uci && $ucs === $uci1 )
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
      						echo '<script>alert("File name Already exist. Please rename file and Try Again"); location.href = "facultyproj.php";</script>';
      					}
      					if (!file_exists($udp))
      					{
       						if(move_uploaded_file($ufT, $udp)) 
      						{
								$wu1 = "UPDATE projects SET cfile='$unFN', cname='$ucn', cperson='$ucs', camount='$uca', cperiod='$ucp', cstatus='$uct'  where cuid='$uid' and cname='$uci' and cperson='$uci1' ";
								if (mysqli_query($con, $wu1))
								{
									echo '<script>alert("Projects  Details Updated Successfully"); location.href="facultyproj.php"</script>';
								}
								else
								{
									echo '<script>alert("Error while updating"); location.href="facultyproj.php"</script>';
								}
							}
						}
						if (file_exists($udp))
      					{
      						echo '<script>alert("File name Already exist. Please rename file and Try Again"); location.href="facultyproj.php";</script>';
      					}
      				}
					if($ufE != $uafE)
      				{
      					echo '<script>alert("File extension must be pdf"); location.href="facultyproj.php";</script>';
      				}
				}
				if($_FILES['ucf']['error'] == UPLOAD_ERR_NO_FILE)
				{
					$wu2 = "UPDATE projects SET cname='$ucn', cperson='$ucs', camount='$uca', cperiod='$ucp', cstatus='$uct' where cuid='$uid' and cname='$uci' and cperson='$uci1'";
					if (mysqli_query($con, $wu2))
					{
						echo '<script>alert("Projects  Details updated Successfully"); location.href="facultyproj.php"</script>';
					}
					else
					{
						echo '<script>alert("Error while updating"); location.href="facultyproj.php"</script>';
					}
				}
      		}
		}
		if(!empty($_GET['del']) && !empty($_GET['del1'])) //code to delete the selected projects
		{
			$m = $_GET['del'];
			$m1 = $_GET['del1'];
			$selectSql = "SELECT * from projects where cuid='$uid' and cname = '$m' and cperson='$m1' ";
			$rsSelect = mysqli_query($con, $selectSql);
			$getRow = mysqli_fetch_assoc($rsSelect);
			$getName = $getRow['cfile'];
			$createDeletePath = "certs/".$getName;
			if(unlink($createDeletePath))
			{
				$sqle = "DELETE FROM projects where cuid='$uid' and cname = '$m' and cperson='$m1' ";
				if(mysqli_query($con, $sqle))
				{
					echo '<script>alert("Deleted Successfully"); location.href="facultyproj.php"</script>';
				}
				else
				{
					echo '<script>alert("Error while Deleting"); location.href="facultyproj.php"</script>';
				}
			}
		}
		?>
</body>
</html>
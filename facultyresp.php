<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Responsibilities </title>
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
		$cc = "SELECT * FROM responsibilities where cuid = '$uid' ";
		$ccr = mysqli_query($con, $cc);
		?>
	
	<div style="padding-top: 10px; justify-content: center; display: flex; ">
		<img src="Images/responsibility.jpg">
	</div>
	<h3 class="h2"> Responsibilities </h3>
	<table id="t1" class="cert" style="margin-top: 10px;">
		<tr class="tr1">
			<th> Responsibility Description</th>
			<th> Responsibility Level</th>
			<th> Edit </th>
			<th> Delete </th>
		</tr>
		<?php
			while ($wv = mysqli_fetch_array($ccr))
			{
				$nam = urlencode($wv["cdescription"]);
				$nam1 = urlencode($wv["clevel"]);
			?>
			<tr>
				<td><?php echo $wv["cdescription"]; ?> </td>
				<td><?php echo $wv["clevel"]; ?></td>
				<th><a style="text-decoration: none;" href="facultyresp.php?upd=<?php echo $nam; ?>&upd1=<?php echo $nam1; ?>"> Y </a></th>
                <th><a style="text-decoration: none;" onClick="javascript: return confirm('Do you want to delete the responsibilities <?php echo $wv['cdescription']; ?>');" href="facultyresp.php?del=<?php echo $nam; ?>&del1=<?php echo $nam1; ?>" > X </a></th>
            </tr>
        <?php } ?>
		<tr>
			<td style="text-align: center;" colspan="8"><button class="b1" id = "b1" onclick="add()" > Add </button> </td>
		</tr> 
	</table>

	 <form class="f1" id="f1" action="" method="POST" style="display: none" enctype="multipart/form-data">
        <h3 class="h3">Insert Responsibilities</h3>

        <label class="l1"> Description </label>
        <input class="i1" type="text" placeholder="Enter responsibilities Title" name="cn" required><br>

        <label class="l1"> Level</label>

		<select class="s1" name="cs"  required>
			<option value="College">College</option>
			<option value="Department">Department</option>
		</select>

        <input class="submit" type="submit" name="add">
    </form>
    <?php
    	if(isset($_POST['add']))
		{
			$cn = $_POST['cn'];			
			$cs = $_POST['cs'];
			$qsa = "SELECT * FROM responsibilities where cuid = '$uid'  and cdescription='$cn'  and clevel='$cs' ";
			$qsar = mysqli_query($con, $qsa);
			if(mysqli_num_rows($qsar) != 1)
			{     					
      						$sql2 = "INSERT into responsibilities SET  cdescription='$cn', clevel='$cs', cuid='$uid'";
      						if (mysqli_query($con, $sql2))
      						{
      							echo '<script>alert("Responsibilities Added Successfully"); location.href="facultyresp.php"</script>';
      						}
      						else
      						{
      							echo '<script>alert("Error while Adding"); location.href="facultyresp.php"</script>';
      						}
     				
            }	
      		if(mysqli_num_rows($qsar) == 1)
      		{
      			echo '<script>alert("Responsibilities Already exist."); location.href="facultyresp.php";</script>';
      		}
      	}
		if(!empty($_GET['upd']) && !empty($_GET['upd1']))
		{
			$uci = $_GET['upd'];
			$uci1 = $_GET['upd1'];
			$sql1 = "SELECT * FROM responsibilities where cuid='$uid' and cdescription = '$uci'  and clevel='$uci1' ";
			$wur = mysqli_query($con, $sql1);
			$wud = mysqli_fetch_array($wur);
			
			echo '<script> document.getElementById("f1").style.display = "none";
			document.getElementById("t1").style.display = "none"; </script>';
			echo '<form class="f1" id="f2" action="" method="POST" enctype="multipart/form-data">
			<h3 class="h3">Update responsibilities</h3>

        	<label class="l1"> Resonsibility Description</label>
        	<input class="i1" type="text" placeholder="Enter responsibilities Name" value="'.$wud["cdescription"].'" name="ucn" required> <br>

	        <label class="l1"> Responsibility Level </label>
	        	<select class="s1" name="ucs" value="'.$wud["clevel"].'" required>
					<option value="College">College</option>
					<option value="Department">Department</option>
				</select>

	        <input class="submit" type="submit" name="upd">
	            </form>';
    	}
     	?>
    	<?php
		if(isset($_POST['upd']))
		{
			$ucn=$_POST['ucn'];
			$ucs=$_POST['ucs'];
		
			if($ucn != $uci || $ucs != $uci1) 
			{ 
				$sqlz = "SELECT * FROM responsibilities where cuid='$uid' and cdescription = '$ucn' and clevel='$ucs' ";
				if(mysqli_num_rows(mysqli_query($con, $sqlz)) != 1)
				{
					      						
					$wu12 = "UPDATE responsibilities SET  cdescription='$ucn', clevel='$ucs' where cuid='$uid' and cdescription='$uci' and clevel='$uci1'";
					if (mysqli_query($con, $wu12))
						{
						    echo '<script>alert("Responsibilities Details Updated Successfully"); location.href="facultyresp.php"</script>';
						}
					else
					    {
							echo '<script>alert("Error while updating"); location.href="facultyresp.php"</script>';
						}

				}
				if(mysqli_num_rows($sqlzr) == 1)
				{
					echo '<script>alert("Responsibilities Already exist."); location.href="facultyresp.php";</script>';
				}
			}
			if($ucn === $uci && $ucs === $uci1 )
			{
				
					$wu1 = "UPDATE responsibilities SET  cdescription='$ucn', clevel='$ucs'  where cuid='$uid' and cdescription='$uci' and clevel='$uci1' ";
					if (mysqli_query($con, $wu1))
						{
							echo '<script>alert("Responsibilities Details Updated Successfully"); location.href="facultyresp.php"</script>';
						}
					else
						{
							echo '<script>alert("Error while updating"); location.href="facultyresp.php"</script>';
						}

					$wu2 = "UPDATE responsibilities SET cdescription='$ucn', clevel='$ucs'  where cuid='$uid' and cdescription='$uci' and clevel='$uci1'";
					if (mysqli_query($con, $wu2))
					{
						echo '<script>alert("Responsibilities Details updated Successfully"); location.href="facultyresp.php"</script>';
					}
					else
					{
						echo '<script>alert("Error while updating"); location.href="facultyresp.php"</script>';
					}
				
      		}
		}
		if(!empty($_GET['del']) && !empty($_GET['del1'])) //code to delete the selected responsibilities
		{
			$m = $_GET['del'];
			$m1 = $_GET['del1'];
			$selectSql = "SELECT * from responsibilities where cuid='$uid' and cdescription = '$m' and clevel='$m1' ";
			$rsSelect = mysqli_query($con, $selectSql);
			$getRow = mysqli_fetch_assoc($rsSelect);
				$sqle = "DELETE FROM responsibilities where cuid='$uid' and cdescription = '$m' and clevel='$m1' ";
				if(mysqli_query($con, $sqle))
				{
					echo '<script>alert("Deleted Successfully"); location.href="facultyresp.php"</script>';
				}
				else
				{
					echo '<script>alert("Error while Deleting"); location.href="facultyresp.php"</script>';
				}
			
		}
		?>
</body>
</html>
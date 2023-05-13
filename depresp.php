<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Responsibilities</title>
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
		<img src="Images/responsibility.jpg">
	</div>
	<h3 class="h2"> Responsibilities </h3>
	<table id="t1" class="cert">
		<tr>
            <th> Unique ID </th>
            <th> Description </th>
			<th> Level</th>
			<th> Edit </th>
			<th> Delete </th>
		</tr>
	<?php
	while($fd = mysqli_fetch_array($fr))
		{
			echo '<tr> <th colspan="8" style="background-color: grey; "> '.$fd["fname"].'</th> </tr>';
			$uidi = $fd["fuid"];
			$w = "SELECT * FROM responsibilities where cuid='$uidi' ";
			$wr = mysqli_query($con, $w);
			while($wv = mysqli_fetch_array($wr))
			{
				$nam = urlencode($wv["cuid"]);
                $nam1 = urlencode($wv["cdescription"]);
				$nam2 = urlencode($wv["clevel"]);
			?>
			<tr>
                <td><?php echo $wv["cuid"]; ?> </td>
				<td><?php echo $wv["cdescription"]; ?> </td>
				<td><?php echo $wv["clevel"]; ?></td>
				<th><a style="text-decoration: none;" href="depresp.php?upd=<?php echo $nam; ?>&upd1=<?php echo $nam1; ?>&upd2=<?php echo $nam2; ?>" id="upd" title="Edit Responsibility"> Y </a></th>
                <th><a style="text-decoration: none;" onclick="javascript: return confirm('Do you wnat to delete Responsibilities <?php echo $wv['cdescription']; ?>');" href="depresp.php?del=<?php echo $nam; ?>&del1=<?php echo $nam1; ?>&del2=<?php echo $nam2; ?>" > X </a></th>
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
       <h3 class="h3">Insert Responsibilities</h3>

        <label class="l1" > Unique ID </label>
        <input class="i1" type="text" placeholder="Enter Unique ID of Faculty" name="ci" required> <br>

        <label class="l1"> Responsibility Description </label>
        <input class="i1" type="text" placeholder="Enter Responsibility Description" name="cn" required><br>

        <label class="l1">Responsibility Level</label>
        <input class="i1" type="text" name="cs" required> <br>

        <input class="submit" type="submit" name="add">
    </form>
    <?php
    	if(isset($_POST['add']))
		{
			$ci = $_POST['ci'];
			$cn = $_POST['cn'];
			$cs = $_POST['cs'];
			$qsa = "SELECT * FROM responsibilities where cuid = '$ci' and cdescription='$cn' and clevel='$cs' ";
			$qsar = mysqli_query($con, $qsa);
			$qsa2 = "SELECT * FROM faculty_details where fuid = '$ci' ";
			if(mysqli_num_rows(mysqli_query($con, $qsa2)) == 1)
			{
				
      						
      							$sql2 = "INSERT into responsibilities SET cdescription='$cn', clevel='$cs',  cuid='$ci'";
      							if (mysqli_query($con, $sql2))
      							{
      								echo '<script>alert("Responsibility Added Successfully"); location.href="depresp.php"</script>';
      							}
      							else
      							{
      								echo '<script>alert("Error while Adding"); location.href="depresp.php"</script>';
      							}
  			if(mysqli_num_rows($qsar) == 1)
      			{
      				echo '<script>alert("Responsibility Already exist."); location.href="depresp.php";</script>';
      			}
      		}
      		if(mysqli_num_rows(mysqli_query($con, $qsa2)) != 1)
      		{
      			echo '<script>alert("Faculty doesnt exist"); location.href="depresp.php";</script>';
      		}
		}
		if(!empty($_GET['upd']) && !empty($_GET['upd1']) && !empty($_GET['upd2']))
		{
			$uci = $_GET['upd'];
			$uci1 = $_GET['upd1'];
			$uci2 = $_GET['upd2'];
			$sql1 = "SELECT * FROM responsibilities where cuid='$uci' and cdescription = '$uci1' and clevel='$uci2'  ";
			$wur = mysqli_query($con, $sql1);
			$wud = mysqli_fetch_array($wur);
			echo '<script> document.getElementById("f1").style.display = "none";
			document.getElementById("t1").style.display = "none"; </script>';
			echo '<form class="f1" id="f2" action="" method="POST" enctype="multipart/form-data">
			<h3 class="h3">Update Responsibility</h3>

			<label class="l1" > Unique ID </label>
        	<input class="i1" type="text" placeholder="Enter Unique ID of Faculty" name="ciu" value="'.$wud["cuid"].'" required> <br>

        	<label class="l1">Responsibility Description </label>
        	<input class="i1" type="text" placeholder="Enter Responsibility Name" value="'.$wud["cdescription"].'" name="ucn" required> <br>

	        <label class="l1">Responsibility Level </label>
	        <input class="i1" type="text" name="ucs" value="'.$wud["clevel"].'" required> <br>

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
			$uqsa2 = "SELECT * FROM faculty_details where fuid = '$ciu' ";
			if(mysqli_num_rows(mysqli_query($con, $uqsa2)) == 1)
			{
				if($ciu != $uci || $ucn != $uci1 || $ucs != $uci2) 
				{ 
					$sqlz = "SELECT * FROM responsibilities where cuid='$ciu' and cdescription = '$ucn'  and clevel='$ucy' and clevel='$ucs' ";
					if(mysqli_num_rows(mysqli_query($con, $sqlz)) != 1)
					{
						
    						
      							
										$wu12 = "UPDATE responsibilities SET  cdescription='$ucn',  clevel='$ucs', cuid='$ciu' where cuid='$uci' and cdescription='$uci1'  and clevel='$uci2' ";
										if (mysqli_query($con, $wu12))
										{
											echo '<script>alert("Responsibility Details Updated Successfully"); location.href="depresp.php"</script>';
										}
										else
										{
											echo '<script>alert("Error while updating"); location.href="depresp.php"</script>';
										}
						
							$wu21 = "UPDATE responsibilities SET cdescription='$ucn',  clevel='$ucs', cuid='$ciu' where cuid='$uci' and cdescription='$uci1' and clevel='$uci2' ";
							if (mysqli_query($con, $wu21))
							{
								echo '<script>alert("Responsibility Details updated Successfully"); location.href="depresp.php"</script>';
							}
							else
							{
								echo '<script>alert("Error while updating"); location.href="depresp.php"</script>';
							}
						
					}
					if(mysqli_num_rows($sqlzr) == 1)
					{
						echo '<script>alert("Responsibility Already exist."); location.href="depresp.php";</script>';
					}
				}	
				if($ciu == $uci && $ucn == $uci1 && $ucy == $uci2)
				{
                        
									$wu1 = "UPDATE responsibilities SET , cdescription='$ucn', clevel='$ucs', cuid='$ciu' where cuid='$uci' and cdescription='$uci1'  and clevel='$uci2' ";
									if (mysqli_query($con, $wu1))
									{
										echo '<script>alert("Responsibility Details Updated Successfully"); location.href="depresp.php"</script>';
									}
									else
									{
										echo '<script>alert("Error while updating"); location.href="depresp.php"</script>';
									}
								
					$wu2 = "UPDATE responsibilities SET cdescription='$ucn',  clevel='$ucs',  cuid='$ciu' where cuid='$ciu' and cdescription='$uci1'  and clevel='$ucy' ";
						if (mysqli_query($con, $wu2))
						{
							echo '<script>alert("Responsibility Details updated Successfully"); location.href="depresp.php"</script>';
						}
						else
						{
							echo '<script>alert("Error while updating"); location.href="depresp.php"</script>';
						}
					
      			}
			}
			if(mysqli_num_rows(mysqli_query($con, $uqsa2)) != 1)
			{
				echo '<script>alert("Please check the faculty ID"); location.href="depresp.php"</script>';
			}
		}
		if(!empty($_GET['del']) && !empty($_GET['del1']) && !empty($_GET['del2'])) //code to delete the selected Responsibility
		{
			$m = $_GET['del'];
			$m1 = $_GET['del1'];
			$m2 = $_GET['del2'];
			$selectSql = "SELECT * from responsibilities where cuid='$m' and cdescription = '$m1'  and clevel='$m2' ";
			$rsSelect = mysqli_query($con, $selectSql);
			$getRow = mysqli_fetch_assoc($rsSelect);		
				$sqle = "DELETE FROM responsibilities where cuid='$m' and cdescription = '$m1'  and clevel='$m2' ";
				if(mysqli_query($con, $sqle))
				{
					echo '<script>alert("Deleted Successfully"); location.href="depresp.php"</script>';
				}
				else
				{
					echo '<script>alert("Error while Deleting"); location.href="depresp.php"</script>';
				}
			
		}
		?>
</body>
</html>
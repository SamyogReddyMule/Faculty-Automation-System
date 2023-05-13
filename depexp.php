<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>  Experience </title>
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
			<img src="Images/exp.png">
		</div>
		<?php 
		echo '<h3 class="h2">  Experience </h3>';
		echo '<table id="t1" class="cert">';
		echo '
				<tr>
					<th> College/School/Company </th>
					<th> Designation </th>
					<th> Start Year </th>
					<th> End Year </th>
					<th> Experience </th>
					<th> Edit </th>
					<th> Delete </th>
				</tr>';
		while($fd = mysqli_fetch_array($fr))
		{
			echo '<tr> <th colspan="7" style="background-color: grey; ">'.$fd["fname"].'</th></tr>';
			$o = $fd['fuid'];
			$e = "SELECT * FROM  experience where expid='$o' ";
			$er = mysqli_query($con, $e);
			while($ed = mysqli_fetch_array($er))
			{
					$a = urlencode($ed["expid"]);
					$a1 = urlencode($ed["ename"]);
					?>
					<tr>
						<td> <?php echo $ed["ename"]; ?> </td>
						<td> <?php echo $ed["edes"]; ?> </td>
						<td> <?php echo $ed["ejyear"]; ?> </td>
						<td> <?php echo $ed["eeyear"]; ?> </td>
						<td> <?php  echo $ed["etime"]; ?> </td>
						<th><a style="text-decoration: none;" href=" depexp.php?upd0=<?php echo $a; ?>&upd1=<?php echo $a1; ?>"> Edit </a></th>
						<th><a style="text-decoration: none;" onClick="javascript: return confirm('Do you want to delete the  experience');" href=" depexp.php?del0=<?php echo $a; ?>&del1=<?php echo $a1; ?> "> Delete </a></th>
               		</tr>
            <?php
      		}
      	}
      	?>
		<tr>
			<td style="text-align: center;" colspan="7"><button class="b1" id = "b1" onclick="add()" > Add </button> </td>
		</tr>
	</table>

	 <form class="f1" id="f1" action="" method="POST" style="display: none" enctype="multipart/form-data">
        <h3 class="h3"> Insert  Experience </h3>

        <label class="l1" > Unique ID </label>
        <input class="i1" type="text" placeholder="Enter Unique ID of Faculty" name="ci" required> <br>

        <label class="l1" > College/School/Company </label>
        <input class="i1" type="text" placeholder=" Enter Previously worked College/School/Company name " name="cn" required> <br>

        <label class="l1" >Designation</label>
        <input class="i1" type="text" placeholder=" Enter Previously worked designation " name="cy" required> <br>

        <label class="l1" > Joining Year </label>
        <input class="i1" type="number" placeholder="Enter joining year" name="cl" required> <br>

        <label class="l1" > End Year </label>
        <input class="i1" type="number" placeholder="Enter Ending Year" name="cs" required> <br>      

        <input class="submit" type="submit" name="add">
    </form>
    	<?php
    	if(isset($_POST['add']))
		{
			$ci = $_POST['ci'];
			$cn = $_POST['cn'];
			$cy = $_POST['cy'];
			$cl = $_POST['cl'];
			$cs = $_POST['cs'];
			$ce = $cs - $cl;
			$qsa2 = "SELECT * FROM faculty_details where fuid = '$ci' ";
			if(mysqli_num_rows(mysqli_query($con, $qsa2)) == 1)
			{
			$qsa = "SELECT * FROM  experience where ejyear='$cl' and eeyear='$cs' and expid='$ci'";
			$qsar = mysqli_query($con, $qsa);
			if(mysqli_num_rows($qsar) != 1)
			{
       	 		$add = "INSERT INTO experience set expid='$ci', ename='$cn', edes='$cy', ejyear='$cl', eeyear='$cs', etime='$ce' ";
       	 		if(mysqli_query($con, $add))
				{
					echo '<script>alert("Inserted Successfully"); location.href="depexp.php";</script>';
				} else {
					echo '<script>alert("Error while inserting"); location.href="depexp.php";</script>';
				}
			}
			if(mysqli_num_rows($qsar) == 1)
			{
				echo '<script>alert(" Experience Details already exists in the database"); location.href=" depexp.php";</script>';
			}
		}
			if(mysqli_num_rows(mysqli_query($con, $qsa2)) != 1)
			{
				echo '<script>alert(" Please check the faculty ID it doesnt seem to have any data"); location.href=" depexp.php";</script>';
			}
		}
		if(!empty($_GET['upd0']) && !empty($_GET['upd1']))
		{
			$uci = $_GET['upd0'];
			$uci1 = $_GET['upd1'];
			$sql1 = "SELECT * FROM  experience where expid='$uci' and ename='$uci1' ";
			$wur = mysqli_query($con, $sql1);
			$wud = mysqli_fetch_array($wur);
			echo '<script> document.getElementById("f1").style.display = "none";
			document.getElementById("t1").style.display = "none"; </script>';
			echo '<form class="f1" id="f2" action="" method="POST" enctype="multipart/form-data">
			<h3 class="h3"> Update  Experience </h3>

        	<label class="l1" > Unique ID </label>
        	<input class="i1" type="text" value="'.$wud["expid"].'" placeholder="Enter Unique ID of Faculty" name="ciu" required> <br>

	        <label class="l1" > College/School/Company </label>
	        <input class="i1" type="text" value="'.$wud["ename"].'" placeholder=" Enter Previously worked College/School/Company name " name="ucn" required> <br>

	        <label class="l1" >Designation</label>
	        <input class="i1" type="text" value="'.$wud["edes"].'" placeholder=" Enter Previously worked designation " name="ucy" required> <br>

	        <label class="l1" > Joining Year </label>
	        <input class="i1" type="number" value="'.$wud["ejyear"].'" placeholder="Enter joining year" name="ucl" required> <br>

	        <label class="l1" > End Year </label>
	        <input class="i1" type="number" value="'.$wud["eeyear"].'" placeholder="Enter Ending Year" name="ucs" required> <br>

	        <input class="submit" type="submit" name="change">
	            </form>';
    	}
		if(isset($_POST['change']))
		{
			$ciu = $_POST['ciu'];
			$ucn = $_POST['ucn'];
			$ucy = $_POST['ucy'];
			$ucl = $_POST['ucl'];
			$ucs = $_POST['ucs'];
			$uce = $ucs - $ucl;
			$uqsa2 = "SELECT * FROM faculty_details where fuid = '$ciu' ";
			if(mysqli_num_rows(mysqli_query($con, $uqsa2)) == 1)
			{
			if($ciu != $uci || $ucn != $uci1)
       	 	{
       	 		if(mysqli_num_rows(mysqli_query($con, " SELECT * FROM  experience where expid='$ciu' and ename='$ucn' and ejyear='$ucl' ")) != 1)
       	 		{
       	 			$uadd = "UPDATE experience set expid='$ciu', ename='$ucn', edes='$ucy', ejyear='$ucl', eeyear='$ucs', etime='$uce' where expid='$uci' and ename='$uci1' ";
       	 			if(mysqli_query($con, $uadd))
					{
						echo '<script>alert("Updated Successfully"); location.href="depexp.php";</script>';
					} else { 
						echo '<script>alert("Error while Updating"); location.href="depexp.php";</script>';
					}
				}
				if(mysqli_num_rows(mysqli_query($con, " SELECT * FROM  experience where expid='$ciu' and ename='$ucn' and ejyear='$ucl' ")) == 1)
				{
					echo '<script>alert(" Experience Details already exists"); location.href="depexp.php";</script>';
				}
			}
			if($ciu == $uci && $ucn == $uci1)
			{
				$uadd0 = "UPDATE experience set expid='$ciu', ename='$ucn', edes='$ucy', ejyear='$ucl', eeyear='$ucs', etime='$uce' where expid='$uci' and ename='$uci1' ";
       	 		if(mysqli_query($con, $uadd0))
				{
					echo '<script>alert("Updated Successfully"); location.href="depexp.php";</script>';
				} else {
					echo '<script>alert("Error while updating"); location.href="depexp.php";</script>';
				}
			}
		}
		if(mysqli_num_rows(mysqli_query($con, $uqsa2)) != 1)
			{
				echo '<script>alert(" Please check the faculty ID it doesnt seem to have any data"); location.href=" depexp.php";</script>';
			}
		}
		if(!empty($_GET['del0']) && !empty($_GET['del1'])) //code to delete the selected workload
		{
			$m = $_GET['del0'];
			$m1 = $_GET['del1'];
			$sqle = "DELETE FROM  experience where expid='$m' and ename='$m1' ";
			if(mysqli_query($con, $sqle))
			{
				echo '<script>alert("Deleted Successfully"); location.href=" depexp.php"</script>';
			}
			else
			{
				echo '<script>alert("Error while Deleting"); location.href=" depexp.php"</script>';
			}
		}
    ?>
</body>
</html>
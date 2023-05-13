<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>College Work</title>
	<link rel="stylesheet" type="text/css" href="css/faculty.css">
	<link rel="stylesheet" type="text/css" href="css/facultymenu.css">
    <style type="text/css">
                table, th, tr, td {
                        border: 1px solid black;
                        margin-left: auto;
                        margin-right: auto;
                        border-collapse: collapse;
                        border-radius: 10px;
                }
                h3 {
                        border: 1px solid black;
                        margin-left: auto;
                        margin-right: auto;
                        width: 20%;
                        text-align: center;
                        color:red;
                        
                }
                .center {
                        padding-top: 10px;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                }
                #rcorners2 {
                        border-radius: 25px;
                        background-color: powderblue;
                        border: 2px solid #73AD21;
                        padding: 7px; 
                        width: 20%;
                        height: 10%;  
                }
                html { 
                        background-color:white;
                }
    </style>
</head>
<body>
	<?php
		session_start();
		$uid = $_SESSION['id'];
		if (empty($uid)) {
                        echo "<script>alert('Cant Press back'); location.href='home.php'</script>";
                }
		include 'db.php';
	?>
		<?php
			$s = "SELECT * FROM subjects where suid = '$uid' ORDER BY syear ";
			$sr = mysqli_query($con, $s);
			$sc = mysqli_num_rows($sr);
			if(date('m') >= '06')
			{
				$date = date('Y').'-'.date('y')+1;
			}
			else
			{
				$date = (date('Y')-1).'-'.date('y');
			}
			$l = "SELECT * FROM leaves where luid = '$uid' and lyear = '$date'";
			$lr = mysqli_query($con, $l);

			$w = "SELECT * FROM workload where wuid = '$uid' order by wyear asc";
			$wr = mysqli_query($con, $w);
			$wc = mysqli_num_rows($wr);
		?>
	<h3 class="h2" id="rcorners2"> Subjects Taught </h3>
	<table id="t1" class="cert">
		<tr>
			<th> Name </th>
			<th> Year </th>
			<th> Class </th>
			<th> Sem </th>
			<th> Pass Percentage </th>
			<th> Feedback </th>
		</tr>
		<?php
			while ($sd = mysqli_fetch_assoc($sr))
			{
				echo '<tr>
				<td> '.$sd["sname"].' </td>
				<td> '.$sd["syear"].' </td>
				<td> '.$sd["sclass"].' </td>
				<td> '.$sd["ssem"].' </td>
				<td> '.$sd["spassp"].' </td>
				<td> '.$sd["sfeed"].' </td>
               	</tr>';
      		}
		?>
	</table>
	<h3 class="h2" id="rcorners2"> Leaves </h3>
	<table id="t1" class="cert">
		<tr>
			<th> Type </th>
			<th> No.of Days </th>
			<th> From </th>
			<th> Upto </th>
			<th> Balance </th>
			<th> Reason </th>
		</tr>
		<?php
			while ($ld = mysqli_fetch_array($lr))
			{
				echo '<tr>
				<td> '.$ld["lyear"].' </td>
				<td> '.$ld["ltime"].' </td>
				<td> '.$ld["lstart"].' </td>
				<td> '.$ld["lend"].' </td>
				<td> '.$ld["lremain"].' </td>
				<td> '.$ld["lrason"].' </td>
               	</tr>';
     		}
		?>
	</table>
	<h3 class="h2" id="rcorners2"> Workload </h3>
	<table id="t1" class="cert">
		<tr>
			<th> Year </th>
			<th> Sem </th>
			<th> No.of Subjects </th>
			<th> Theory </th>
			<th> Lab </th>
			<th> Total </th>
			<th> Fraction </th>
			<th> File </th>
		</tr>
		<?php
			while ($wd = mysqli_fetch_array($wr))
			{
				echo '<tr>
				<td> '.$wd["wyear"].' </td>
				<td> '.$wd["wsem"].' </td>
				<td> '.$wd["wsub"].' </td>
				<td> '.$wd["wtheory"].' </td>
				<td> '.$wd["wlab"].' </td>
				<td> '.$wd["wtotal"].' </td>
				<td> '.$wd["wfrac"].' </td>
				<td><a style="text-decoration: none;" href="workload/'.$wd["wfile"].'"> '.$wd["wfile"].'</a></td>
            	</tr>';
       		}
		?>
	</table>
    <div class="center">
                <button style="margin-left:auto; margin-right: auto; " onclick="window.print()">Print</button>
    </div>
</body>
</html>
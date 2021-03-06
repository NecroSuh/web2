<!doctype html>
<html>
	<head>
		<title>Apple Pizza</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style>
				body {
				  background: #e2e1e0;
				  text-align: center;
				}
				h1 {
					text-align: center;
					padding: 32px;
				}
				.card {
				  background: #fff;
				  border-radius: 2px;
				  display: inline-block;
				  height: 540px;
				  margin: 10px;
				  /*position: relative;*/
				  width: 300px;
					border: 1px solid #999;
				}
				img {
					width: 100%;
					height: 400px;
					margin-top: 0;
				}
				.card-1 {
				  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
				  /*transition: all 0.3s cubic-bezier(.25,.8,.25,1);*/
					overflow: hidden;
				}
				.card-1 img {
					object-fit: cover;
					display: block;
					width: 100%;
					height: 60%;
					transition: .3s transform ease-out;
				}
				.card-1:hover img{
				  /*box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);*/
				  transform: scale(1.15);
				}
				.card-1:hover h3 {
					color: navy;
					text-shadow: 1px 1px 1px darkorange;
					border-bottom: 1px dotted gray;
				}
				.card-1 .text {
					margin-top: 50px;
				}
				/* Add a black background color to the top navigation */
				.topnav {
					background-color: #333;
					overflow: hidden;
				}
	 
				/* Style the links inside the navigation bar */
				.topnav a {
				  float: left;
				  color: #f2f2f2;
				  text-align: center;
				  padding: 14px 16px;
				  text-decoration: none;
				  font-size: 17px;
				}
	 
				/* Change the color of links on hover */
				.topnav a:hover {
				  background-color: #ddd;
				  color: black;
				}
	 
				/* Add a color to the active/current link */
				.topnav a.active {
				  background-color: #4CAF50;
				  color: white;
				}
	 
				/* Right-aligned section inside the top navigation */
				.topnav-right {
				  float: right;
				}        
		</style>
	</head>
	<body>
		<?php
			session_start();
			$logged = false;
			if(isset($_SESSION['uid'])) {  // ????????? uid ?????? ???????????? ????????? 
				$uid = $_SESSION['uid'];
				$uname = $_SESSION['uname'];
				//echo "$uid : $uname<br>";
				$logged = true;
			}
			#1. Database connection
			include_once('connect.php');
			if($logged) { // log in ?????? 
				// ???????????? ??????
				$sql = "select count(*) rowcnt from cart where email = '$uid'";
				$result = $conn->query($sql);
				//$row = $result->fetch_array(MYSQLI_NUM);
				$row = $result->fetch_assoc();
			}
		?>
		<div class="topnav">
		<?php
			if(!$logged) {
				echo "<a href='signup.html'>????????????</a>";
				echo "<a href='signin.html'>?????????</a>";
			}
			else {
				echo "<a href=''>{$uname}??? ???????????????.</a>";
				echo "<a href='signout.php'>????????????</a>";
				echo "<a href='signmodify.php'>??????????????????</a>";
				echo "<a href='signdel.php'>????????????</a>";
				echo "<a href='showcart.php'>????????????(".$row['rowcnt'].")</a>";
			}
		?>
		</div>
		<h1>Pizza Mall</h1>
	<?php	
	#2. SELECT SQL??? : mypizza ???????????? ?????? ????????? ???????????? ??????
	$sql = "select * from mypizza";
	#3. SQL ????????????
	$result = $conn->query($sql); 
	#4. ???????????? ??????????????? ????????? ?????????
	if(!$result)
		die('?????? ????????? ????????? ????????? ??????????????????. Error : '.$conn->error);
	?>
	<?php
	while($row = $result->fetch_array(MYSQLI_NUM)) {
	?>
	<div class="card card-1">
		<a href="addcart.php?pizza=<?=$row[1]?>&lprice=<?=$row[2]?>&sprice=<?=$row[3]?>">
			<img src="images/<?=$row[4]?>"></a>
		<div class="">
			<h3><?=$row[1]?></h3>
			<h3><?=$row[2]?></h3>
			<h3><?=$row[3]?></h3>
		</div>
	</div>
	<?php } //<?php} ?????? ?>
		
	</body>
</html>

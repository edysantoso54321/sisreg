<?php 
	session_start();
	include("conn.php");
	if(isset($_POST['id']) && isset($_POST['pass'])){
		$idx=addslashes($_POST['id']);
		$pass=addslashes($_POST['pass']);
		$data=mysqli_query($conn,"select * from user where id=$idx and password='$pass'");
		// echo "select * from user where id=$idx and password='$pass'";
		foreach ($data as $key) {
			$id=$key['id'];
			unset($_SESSION['gagal']);
			$_SESSION['id']=$key['id'];
			$_SESSION['password']=$key['password'];
			$_SESSION['jk']=$key['jk'];
		}
		if (isset($id)){
			if ($_SESSION['jk']=='cowok'){
				$temp=mysqli_query($conn,"select nama from cowok where id=$id");
				foreach ($temp as $key) {
					$_SESSION['username'] = $key['nama'];
				}
			}else{
				$temp=mysqli_query($conn,"select nama from cewek where id=$id");
				foreach ($temp as $key) {
					$_SESSION['username'] = $key['nama'];
				}
			}
			header("location: index.php");	
		}else{
			$_SESSION['gagal']='gagal';	
			header("location: login.php");
		}
	}else{
		header("location: login.php");
	}
 ?>
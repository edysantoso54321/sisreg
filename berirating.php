<?php 
	session_start();
	include ("conn.php");
  	if (isset($_SESSION['id'])){
  		$id=addslashes($_SESSION['id']);
  		if ($_SESSION['jk']=="cowok"){
  			if ((isset($_GET['id'])) && (isset($_GET['rating']))){
  				$id1=addslashes($_GET['id']);
  				$rating=addslashes($_GET['rating']);
  				mysqli_query($conn,"insert into ratingcotoce values($id,$id1,$rating)");
  				header("location: profile.php?id=$id1");
  			}else{
  				header("location: index.php");
  			}
  		}else if($_SESSION['jk']=="cewek"){
  			if ((isset($_GET['id'])) && (isset($_GET['rating']))){
  				$id1=addslashes($_GET['id']);
  				$rating=addslashes($_GET['rating']);
  				mysqli_query($conn,"insert into ratingcetoco values($id,$id1,$rating)");
  				header("location: profile.php?id=$id1");
  			}else{
  				header("location: index.php");
  			}
  		}
  		else{
  			header("location: index.php");
  		}
  	}else{
  		header("location: index.php");
  	}
?>
<?php
	include("conn.php");
	$query="select id from user";
	$hasil=mysqli_query($conn,$query);
	$lastid=0;
	foreach ($hasil as $key) {
		$lastid=(int) $key['id'];
	}
	function generate($id){
		$id=$id+1;
		// if ($id<10){
		// 	return "0000".strval($id);
		// }else if($id<100){
		// 	return "000".strval($id);
		// }else if ($id<1000){
		// 	return "00".strval($id);
		// }else if ($id<10000){
		// 	return "0".strval($id);
		// }else{
		// 	return strval($id);
		// }
		return $id;
	}
	// echo generate($lastid);
	// $cow = array("edi","edo","dadang","alam","fahmi","taris","parlan","solikin","urashiki","yudi","yanto","febry","farhat","abas","bili","naruto","songoku","asep","ivan","yuda");
	// $cew = array("ayu","ani","bella","citra","dinda","eva","fitri","halimah","indi","ina","juvita","kirana","lulun","lestari","nurul","puji","putri","sri","susanti","yuni");
	// $i=1;
	// while ($i <= 20) {
	// 	mysqli_query($conn,"insert into user values(".$i.",'".$cow[$i-1]."','cowok')");
	// 	mysqli_query($conn,"insert into user values(".($i+20).",'".$cew[($i-1)]."','cewek')");
	// 	mysqli_query($conn,"insert into cowok values(".$i.",'".$cow[($i-1)]."')");
	// 	mysqli_query($conn,"insert into cewek values(".($i+20).",'".$cew[($i-1)]."')");
	// 	$i=$i+1;
	// }
	// $numbers = range(21,40);
	// for ($i=1; $i <= 20; $i++) { 
	// 	shuffle($numbers);	
	// 	$random_15 = array_slice($numbers, 0, 7);
	// 	for ($j=0; $j <7 ; $j++) {
	// 		$rating=rand(1,5);
	// 		$cow=$random_15[$j];
	// 		mysqli_query($conn,"insert into ratingcotoce values($i,$cow,$rating)");
	// 	}
	// }
	// $id=6;
	// $data=mysqli_query($conn,"select ide as id, (select nama from cewek where id=ratingcotoce.ide)as nama , rating from ratingcotoce where ido=$id");
	// $notrate=mysqli_query($conn,"select id from cewek where id not in (select ide from ratingcotoce where ido=$id) order by id asc");
	// $produc=array();
	// $predic=array();
	// foreach ($notrate as $key) {
	// 	$atas = 0;
	//     $bawah = 0;
	//     foreach ($data as $val) {
	//     	$temp=mysqli_query($conn,"select rating from ratingcotoce where ido in (select ido from ratingcotoce where ido in (select ido from ratingcotoce where ide=".$key['id'].") and ide=".$val['id'].") and (ide=".$key['id']." or ide=".$val['id'].")");
	//     	$nil = array();
	//     	foreach ($temp as $tmp) {
	//     		array_push($nil,$tmp['rating']);
	//     	}
	//     	$a=0;
	//     	$b=0;
	//     	$c=0;
	//     	for ($i=0; $i < count($nil)/2 ; $i++) {
	//     		$a = $a + ($nil[$i]*$nil[($i+count($nil)/2)]);
	//     		$b = $b + ($nil[$i]*$nil[$i]);
	//     		$c = $c + ($nil[($i+count($nil)/2)]*$nil[($i+count($nil)/2)]);
	//     	}
	//     	$sim = $a/sqrt($b+$c);
	//     	$bawah = $bawah + $sim;
	//     	$atas = $atas + ($val['rating']*$sim);
	//     }
	//     array_push($predic, $atas/$bawah);
	//     array_push($produc, $key)
	// }
	$next=1;
	if(isset($_GET['id'])){
		$next=$_GET['id']+1;
		$id=$_GET['id'];
		$pendidikan=$_GET['pendidikan'];
		$kotasaatini=$_GET['kotasaatini'];
		$kotaasal=$_GET['kotaasal'];
		$statushubungan=$_GET['statushubungan'];
		$biografi=$_GET['biografi'];
		$tgllahir=$_GET['tgllahir'];
		$umur=$_GET['umur'];
		$pekerjaan=$_GET['pekerjaan'];
		$email=$_GET['email'];
		$kepercayaan=$_GET['kepercayaan'];
		$namapanggilan=$_GET['namapanggilan'];
		$tentang=$_GET['tentang'];
		$hobi=$_GET['hobi'];
		$sekilas=$_GET['sekilas'];
		$telp=$_GET['telp'];
		mysqli_query($conn, "update cewek set pendidikan='$pendidikan', kotasaatini='$kotasaatini', kotaasal='$kotaasal', statushubungan='$statushubungan', biografi='$biografi', tgllahir='$tgllahir', umur=$umur, pekerjaan='$pekerjaan', email='$email', kepercayaan='$kepercayaan', namapanggilan='$namapanggilan', tentang='$tentang', hobi='$hobi', sekilas='$sekilas', telp='$telp' where id=$id");
	}
	$data=mysqli_query($conn,'select * from cewek');
	foreach ($data as $key) {
		if ($key['id']==$next){
			$nama=$key['nama'];
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<img src="img/<?php echo $next; ?>.jpg">
	<form action="coba.php" method="get">
		id : <input type="text" name="id" value="<?php echo $next; ?>"><br>
		nama : <input type="text" name="nama" value="<?php echo $nama; ?>"><br>
		pendidikan : <input type="text" name="pendidikan"><br>
		kotasaatini : <input type="text" name="kotasaatini"><br>
		kotaasal : <input type="text" name="kotaasal"><br>
		statushubungan : <input type="text" name="statushubungan"><br>
		biografi : <input type="text" name="biografi"><br>
		tgllahir : <input type="text" name="tgllahir"><br>
		umur : <input type="text" name="umur"><br>
		pekerjaan : <input type="text" name="pekerjaan"><br>
		email : <input type="text" name="email"><br>
		kepercayaan : <input type="text" name="kepercayaan"><br>
		namapanggilan : <input type="text" name="namapanggilan"><br>
		tentang : <input type="text" name="tentang"><br>
		hobi : <input type="text" name="hobi"><br>
		sekilas : <input type="text" name="sekilas"><br>
		telp : <input type="text" name="telp"><br>
		<input type="submit" name="submit" value="submit">
	</form>
</body>
</html>
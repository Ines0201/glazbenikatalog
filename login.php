<!DOCTYPE html>
<html>
<head>
	<title>Glazbeni katalog</title>
	<meta charset="UTF-8"/>
	<meta name="autor" content="Ines Šimićev">
	<meta name="viewport" content="width-device-width, initial-scale=1">
	<link href="stil.css" rel="stylesheet" type="text/css">
</head>
<body>
	<header>
		<div class="logo-zaglavlje">
			<a href=""><img class="logo" src="slike/big.jpg"></a>
		</div>
		<div class="zaglavlje-div">
			<div class="glavi-naslov">GLAZBENI KATALOG</div>
			<div class="glavna-nav">
				<div class="nav-pod active"><a href="">Home</a></div>
				<div class="nav-pod"><a href="">Pjesme</a></div>
				<div class="nav-pod"><a href="">O autoru</a></div>
				<div class="nav-pod"><a href="">Prijava</a></div>
			</div>
		</div>
		<div class="div-footer">
				<form>
					<div class="pretrazi">
						<input class="pretrazi" type="text" placeholder="Pretraži glazbu" name="trazi">
						<button class="btn">Pretraži</button>
					</div>
				</form>
			</div>
	</header>
	

    <?php
	define("POSLUZITELJ","localhost");
	define("BAZA","iwa_2021_vz_projekt");
	define("BAZA_KORISNIK","iwa_2021");
	define("BAZA_LOZINKA","foi2021");
	
	function SpajanjeNaBazu(){
		$veza=mysqli_connect(POSLUZITELJ,BAZA_KORISNIK,BAZA_LOZINKA);
		if(!$veza)echo "GREŠKA: Problem sa spajanjem u datoteci baza.php funkcija SpajanjeNaBazu: ".mysqli_connect_error();
		mysqli_select_db($veza,BAZA);
		if(mysqli_error($veza)!=="")echo "GREŠKA: Problem sa odabirom baze u baza.php funkcija SpajanjeNaBazu: ".mysqli_error($veza);
		mysqli_set_charset($veza,"utf8");
		if(mysqli_error($veza)!=="")echo "GREŠKA: Problem sa odabirom baze u baza.php funkcija SpajanjeNaBazu: ".mysqli_error($veza);
		return $veza;
	}

	function izvrsiUpit($veza,$upit){
		$rezultat=mysqli_query($veza,$upit);
		if(mysqli_error($veza)!=="")echo "GREŠKA: Problem sa upitom: ".$upit." : u datoteci baza.php funkcija izvrsiUpit: ".mysqli_error($veza);
		return $rezultat;
	}

	function ZatvoriBazu($veza){
		mysqli_close($veza);
	}
?>
<?php
	if(session_id()=="")session_start(); //start session samo ??????

	$trenutna=basename($_SERVER["PHP_SELF"]);
	$putanja=$_SERVER['REQUEST_URI'];
	$prijavljen=0; //prijavljen korisnik ili ne??
	$prijavljen_tip=-1;//šta to znači?
	$vel_str=10; // broj prikazanih elemenata na stranici s korisnicima PROMIJENI
	$vel_str_video=10; 	// broj prikazanih elemenata na stranici s video materijalima PROMIJENI

	if(isset($_SESSION['prijavljen'])){
		$prijavljen=$_SESSION['prijavljen'];
		$prijavljen_ime=$_SESSION['prijavljen_ime'];
		$prijavljen_tip=$_SESSION['prijavljen_tip'];
		$prijavljen_id=$_SESSION['prijavljen_id'];
	}
	$bp=SpajanjeNaBazu();
?>

<!DOCTYPE html>
<html lang="hr">
	<head>
		<title>Ines Šimićev - Glazbeni katalog</title>
		<meta charset="UTF-8"/>
		<meta name="autor" content="Ines Šimićev">
		<meta name="date" content="15.06.2022">
		
		
	</head>
<?php
	if(isset($_GET['logout'])){
		$prijavljen=$_SESSION['prijavljen'];
		$prijavljen_ime=$_SESSION['prijavljen_ime'];
		$prijavljen_tip=$_SESSION['prijavljen_tip'];
		$prijavljen_id=$_SESSION['prijavljen_id'];
		session_destroy();
	}
$greska= "";
	if(isset($_POST['submit'])){
		$korisnicko_ime=mysqli_real_escape_string($bp,$_POST['korisnicko_ime']);
		$lozinka=mysqli_real_escape_string($bp,$_POST['lozinka']);

		if(!empty($kor_ime)&&!empty($lozinka)){
			$sql="SELECT id_korisnik,id_tip,ime,prezime FROM korisnik WHERE korisnicko_ime='$korisnicko_ime' AND lozinka='$lozinka'";
			$rs=izvrsiUpit($bp,$sql);
			if(mysqli_num_rows($rs)==0)$greska="Ne postoji korisnik s navedenim korisničkim imenom i lozinkom";
			else{
				list($ime,$prezime,$id,$tip)=mysqli_fetch_array($rs);
				$_SESSION['prijavljen']=$korisnicko_ime;
				$_SESSION['prijavljen_ime']=$ime." ".$prezime;
				$_SESSION["prijavljen_id"]=$id;
				$_SESSION['prijavljen_tip']=$tip;
				header("Location:index.php");
			}
		}
		else $greska = "Molim unesite korisničko ime i lozinku";
	}
?>
<img class="big" style="width: 30%" src="slike/big.jpg"/>
<form name="obrazac_za_prijavu" class="obrazac" action="" method="POST">
    <h2>Prijavi se:</h2>
    <input class="korisnicko-ime" style="padding: 5px 10px;margin: 10px;", placeholder="korisničko ime" name="korisnicko_ime"><br>
    <input type="password" class="korisnicko-ime" style="padding: 5px 10px;margin: 10px;" placeholder="lozinka" name="lozinka"><br> 
    <button type="submit" href="#" class="btn" style="padding: 5px 10px;">Prijava</a></button>
</form>


		<footer>
				
		</footer>

	</div>

</body>
</html>
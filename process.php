<?php
	$korime = $_POST['korime'];
	$lozinka = $_POST['lozinka'];
	
	
	//to conect ot the server and database
	mysql_connect("localhost", "iwa_2021_vz_projekt", "iwa_2021", "foi2021");
	mysql_select_db("korisnik");
	
	$rezultat =  mysql_query("select * from korisnik where korime = '$korime' and lozinka = '$lozinka'") or die ("Greška u spajanju sa bazom".mysql_error());
	$row = mysql_fetch_array($rezultat);
	if ($row['korime'] == $korime && $row['lozinka'] == $lozinka ){
		echo "Dobrodošli " .$row['korime'];
	} else {
		echo "Neuspjeh u logiranju!";
	}
?>
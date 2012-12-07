<html>
	<head><meta http-equiv="Content-Type" content="text/html; charset=utf8">
		<title>R-L-C Soros rezgő kör</title>
	</head>
	<body>
		<form method="POST" action="feldolgoz.php">
			Adja meg a Generáor feszültségét Volt-ban!    (U)</br>
			<input type="text" name="U">V</br>
			Adja meg a Kondenzátor kapacitását Farad-ban! (C)</br>
			<input type="text" name="C"><select name="cm">
											<option>mF</option>
											<option>µF</option>
											<option>nF</option>
											<option>pF</option>
										</select></br>
			Adja meg a Tekercs induktivitását Henry-ben!  (L)</br>
			<input type="text" name="L"><select name="lm">
											<option>mH</option>
											<option>µH</option>
											<option>nH</option>
											<option>pH</option>
										</select></br>
			Adja meg az Ellenállás ellenállását Ohm-ban!  (R)</br>
			<input type="text" name="R"><select name="rm">
											<option>MΩ</option>
											<option>KΩ</option>
											<option selected>Ω</option>
											<option>mΩ</option>
										</select></br>
			<input type="submit" value="Számítás"><br/>
			<?php
				if(isset($_GET['hiba'])){$hiba = $_GET['hiba'];}
				else{$hiba='';}
				if($hiba == 1){echo"<div>Hiba, kitöltetlen mezők!</div>";}
			?>
		</form>
	</body>
</html>
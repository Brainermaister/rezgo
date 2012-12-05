<html>
	<head>
		<title>R-L-C Soros rezgő kör</title>
	</head>
	<body>
<?php
$U = $_POST['U'];
$C = $_POST['C'];
$L = $_POST['L'];
$R = $_POST['R'];
$cm = $_POST['cm'];
$lm = $_POST['lm'];
if(empty($U) or empty($C) or empty($L) or empty($R)){header("Location:index.php?hiba=1");exit;}
else{
	echo"U=$U V</br>C=$C $cm</br>L=$L $lm</br>R=$R Ohm</br></br>";
	switch($cm){
		case 'mF': $C=$C/1000;break;
		case 'uF': $C=$C/1000000;break;
		case 'nF': $C=$C/1000000000;break;
		case 'pF': $C=$C/1000000000000;break;
	}
	switch($lm){
		case 'mH': $L=$L/1000;break;
		case 'uH': $L=$L/1000000;break;
		case 'nH': $L=$L/1000000000;break;
		case 'pH': $L=$L/1000000000000;break;
	}
	echo "Rezonancia körfrekvencia</br>";
		$w=1/sqrt($L*$C);
		echo "w=1/sqrt(L*C)=1/sqrt($L*$C)=$w cps</br></br>";
	echo "Rezonancia frekvencia</br>";
		$fr=$w/(2*Pi());
		echo "fr=w/(2*Pi)=$w/(2*Pi)=$fr fok</br></br>";
	echo "Körjóság</br>";
		$Q0=1/($R*sqrt($L/$C));
		echo "Q0=1/(R*sqrt)(L/C)=1/($R*sqrt($L/$C))=$Q0</br></br>";
	echo "Sávszélesség</br>";
		$B=$fr/$Q0;
		echo "B=fr/Q0=$fr/$Q0=$B Hz</br></br>";
	echo "Áram rezonancián</br>";
		$I0=$U/$R;
		echo "I0=U/R=$U/$R=$I0 A</br></br>";
	echo "Kondenzátor reaktanciája</br>";
		$Xc0=1/($w*$C);
		echo "Xc0=1/(w*C)=1/($w*$C)=$Xc0 Ohm</br></br>";
	
}
?>
</body>
</html>
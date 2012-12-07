<html>
	<head><meta http-equiv="Content-Type" content="text/html; charset=utf8">
		<title>R-L-C Soros rezgő kör©</title>
	</head>
	<body>
<?php
function normal($be){
	if ($be>=1000000){$be=$be/1000000;$me='M';$exp='*10^6';}
	elseif ($be>=1000){$be=$be/1000;$me='K';$exp='*10^3';}
	elseif ($be<0.000000001){$be=$be*1000000000;$me='p';$exp='*10^-12';}
	elseif ($be<0.000001){$be=$be*1000000;$me='n';$exp='*10^-9';}
	elseif ($be<0.001){$be=$be*1000;$me='µ';$exp='*10^-6';}
	elseif ($be<1){$be=$be*1000;$me='m';$exp='*10^-3';}
	else{$me='';$exp='';}
	return array(round($be,2),$me,$exp);
}
function mert($sz, $ki){
	switch(utf8_encode($ki[1])){
		case 'M': $sz=$sz*1000000;break;
		case 'K': $sz=$sz*1000;break;
		case 'm': $sz=$sz/1000;break;
		case 'µ': $sz=$sz/1000000;break;
		case 'n': $sz=$sz/1000000000;break;
		case 'p': $sz=$sz/1000000000000;break;}
	return $sz;
}

$U = $_POST['U'];
$C = $_POST['C'];
$L = $_POST['L'];
$R = $_POST['R'];
$rm = $_POST['rm'];
$cm = $_POST['cm'];
$lm = $_POST['lm'];
if(empty($U) or empty($C) or empty($L) or empty($R)){header("Location:index.php?hiba=1");exit;}
else{
	echo"R-L-C Soros rezgő kör©</br>U=$U V</br>C=$C $cm</br>L=$L $lm</br>R=$R Ohm</br></br>";
	$R=mert($R, $rm);
	$L=mert($L, $lm);
	$C=mert($C, $cm);
	echo "Rezonancia körfrekvencia</br>";
		$w=1/sqrt($L*$C);
		$ertek=normal($w);
		echo "ω=1/sqrt(L*C)=1/sqrt($L*$C)=",$ertek[0]," ",$ertek[1],"cps</br></br>";
	echo "Rezonancia frekvencia</br>";
		$fr=$w/(2*Pi());
		$ertek=normal($fr);
		echo "fr=ω/(2*Pi)=$w/(2*Pi)=",$ertek[0]," ",$ertek[1],"Hz</br></br>";
	echo "Körjóság</br>";
		$Q0=(1/$R)*(sqrt($L/$C));
		echo "Q0=(1/R)*(sqrt(L/C))=(1/$R)*(sqrt($L/$C))=",round($Q0,2),"</br></br>";
	echo "Sávszélesség</br>";
		$B=$fr/$Q0;
		$ertek=normal($B);
		echo "B=fr/Q0=$fr/$Q0=",$ertek[0]," ",$ertek[1],"Hz</br></br>";
	echo "Áram rezonancián</br>";
		$I0=$U/$R;
		$ertek=normal($I0);
		echo "I0=U/R=$U/$R=",$ertek[0]," ",$ertek[1],"A</br></br>";
	echo "Kondenzátor reaktanciája</br>";
		$Xc0=1/($w*$C);
		$ertek=normal($Xc0);
		echo "Xc0=1/(ω*C)=1/($w*$C)=",$ertek[0]," ",$ertek[1],"Ω</br></br>";
	echo "Kondenzátoron eső feszültség rezonancián</br>";
		$Uc0=$U*$Q0;
		$ertek=normal($Uc0);
		echo "Uc0=U*Q0=$U*$Q0=",$ertek[0]," ",$ertek[1],"V</br></br>";
	//fázis szög φ °
}
?>
</body>
</html>
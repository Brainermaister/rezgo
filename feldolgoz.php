<html>
	<head>
		<title>R-L-C Soros rezgő kör</title>
	</head>
	<body>
<?php
function normal($be){
	if ($be>=1000000){$be=$be/1000000;$me='M';}
	elseif ($be>=1000){$be=$be/1000;$me='K';}
	elseif ($be<0.000000001){$be=$be*1000000000;$me='p';}
	elseif ($be<0.000001){$be=$be*1000000;$me='n';}
	elseif ($be<0.001){$be=$be*1000;$me='u';}
	elseif ($be<1){$be=$be*1000;$me='m';}
	else{$me='';}
	return array($be,$me);
}
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
		$ertek=normal($w);
		echo "w=1/sqrt(L*C)=1/sqrt($L*$C)=",round($ertek[0],2)," ",$ertek[1],"cps</br></br>";
	echo "Rezonancia frekvencia</br>";
		$fr=$w/(2*Pi());
		$ertek=normal($fr);
		echo "fr=w/(2*Pi)=$w/(2*Pi)=",round($ertek[0],2)," ",$ertek[1],"Hz</br></br>";
	echo "Körjóság</br>";
		$Q0=(1/$R)*(sqrt($L/$C));
		echo "Q0=(1/R)*(sqrt(L/C))=(1/$R)*(sqrt($L/$C))=$Q0</br></br>";
	echo "Sávszélesség</br>";
		$B=$fr/$Q0;
		$ertek=normal($B);
		echo "B=fr/Q0=$fr/$Q0=",round($ertek[0],2)," ",$ertek[1],"Hz</br></br>";
	echo "Áram rezonancián</br>";
		$I0=$U/$R;
		$ertek=normal($I0);
		echo "I0=U/R=$U/$R=",round($ertek[0],2)," ",$ertek[1],"A</br></br>";
	echo "Kondenzátor reaktanciája</br>";
		$Xc0=1/($w*$C);
		$ertek=normal($Xc0);
		echo "Xc0=1/(w*C)=1/($w*$C)=",round($ertek[0],2)," ",$ertek[1],"Ohm</br></br>";
	echo "Kondenzátoron eső feszültség rezonancián</br>";
		$Uc0=$U*$Q0;
		$ertek=normal($Uc0);
		echo "Uc0=U*Q0=$U*$Q0=",round($ertek[0],2)," ",$ertek[1],"V</br></br>";
	
}
?>
</body>
</html>
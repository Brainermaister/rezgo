<html>
	<head><meta http-equiv="Content-Type" content="text/html; charset=utf8">
		<title>R-L-C Soros rezgő kör©</title>
	</head>
	<body>
<?php
function normal($be){
	if ($be>=1E6){$be=$be*1E-6;$me='M';$exp='*10^6';}
	elseif ($be>=1E3){$be=$be*1E-3;$me='K';$exp='*10^3';}
	elseif ($be<1E-9){$be=$be*1E9;$me='p';$exp='*10^-12';}
	elseif ($be<1E-6){$be=$be*1E6;$me='n';$exp='*10^-9';}
	elseif ($be<1E-3){$be=$be*1E3;$me='µ';$exp='*10^-6';}
	elseif ($be<1){$be=$be*1E3;$me='m';$exp='*10^-3';}
	else{$me='';$exp='';}
	return array(round($be,2),$me,$exp);
}
function mert($sz, $ki){
	$k=0;
	for($i=0;$i<=strlen($ki)-1;$i++){
		if($ki[$i]==utf8_encode($ki[$i])){$utf[$k]=$ki[$i];$k=$k+1;}
		elseif($ki[$i]!=utf8_encode($ki[$i]) && $ki[$i+1]!=utf8_encode($ki[$i+1]))
			{$i=$i+1;$utf[$k]=utf8_encode($ki[$i]);$k=$k+1;}}
	switch($utf[0]){
		case 'M': $sz=$sz*(1E6);break;
		case 'K': $sz=$sz*(1E3);break;
		case 'm': $sz=$sz*(1E-3);break;
		case 'µ': $sz=$sz*(1E-6);break;
		case 'n': $sz=$sz*(1E-9);break;
		case 'p': $sz=$sz*(1E-12);break;
		default:break;}
	return $sz;
}

$U = $_POST['U'];
$R = $_POST['R'];
$L = $_POST['L'];
$C = $_POST['C'];
$rm = $_POST['rm'];
$lm = $_POST['lm'];
$cm = $_POST['cm'];
if(empty($U) or empty($C) or empty($L) or empty($R)){header("Location:index.php?hiba=1");exit;}
else{
	echo "R-L-C Soros rezgő kör©</br>U=$U V</br>C=$C $cm</br>L=$L $lm</br>R=$R $rm</br></br>";
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
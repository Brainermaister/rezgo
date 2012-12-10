<html>
	<head><meta http-equiv="Content-Type" content="text/html; charset=utf8">
		<title>R-L-C Soros rezgő kör©</title>
	</head>
	<body>
<?php
function normal($be){
	if ($be>=1E6){$be=$be*1E-6;$me='M';$exp='*10<sup>6</sup>';}
	elseif ($be>=1E3){$be=$be*1E-3;$me='K';$exp='*10<sup>3</sup>';}
	elseif ($be<1E-9){$be=$be*1E12;$me='p';$exp='*10<sup>-12</sup>';}
	elseif ($be<1E-6){$be=$be*1E9;$me='n';$exp='*10<sup>-9</sup>';}
	elseif ($be<1E-3){$be=$be*1E6;$me='µ';$exp='*10<sup>-6</sup>';}
	elseif ($be<1){$be=$be*1E3;$me='m';$exp='*10<sup>-3</sup>';}
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

function ex($m){
	$k=0;
	for($i=0;$i<=strlen($m)-1;$i++){
		if($m[$i]==utf8_encode($m[$i])){$utf[$k]=$m[$i];$k=$k+1;}
		elseif($m[$i]!=utf8_encode($m[$i]) && $m[$i+1]!=utf8_encode($m[$i+1]))
			{$i=$i+1;$utf[$k]=utf8_encode($m[$i]);$k=$k+1;}}
	switch($utf[0]){
		case 'M': $out='*10<sup>6</sup>';break;
		case 'K': $out='*10<sup>3</sup>';break;
		case 'm': $out='*10<sup>-3</sup>';break;
		case 'µ': $out='*10<sup>-6</sup>';break;
		case 'n': $out='*10<sup>-9</sup>';break;
		case 'p': $out='*10<sup>-12</sup>';break;
		default : $out='';break;}
	return $out;	
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
	echo "R-L-C Soros rezgő kör<sup>©</sup></br>U=$U V</br>C=$C $cm</br>L=$L $lm</br>R=$R $rm</br></br>";
	$R=mert($R, $rm);
	$L=mert($L, $lm);
	$C=mert($C, $cm);
	echo "Rezonancia körfrekvencia</br>";
		$w=1/sqrt($L*$C);
		$ertekW=normal($w);
		echo "ω=1/sqrt(L*C)=1/sqrt(",$_POST['L'],ex($lm),"*",$_POST['C'],ex($cm),")=$ertekW[0] $ertekW[1]cps</br></br>";
	echo "Rezonancia frekvencia</br>";
		$fr=$w/(2*Pi());
		$ertekFR=normal($fr);
		echo "f<sub>r</sub>=ω/(2*Pi)=$ertekW[0]$ertekW[2]/(2*Pi)=$ertekFR[0] $ertekFR[1]Hz</br></br>";
	echo "Körjóság</br>";
		$Q0=(1/$R)*(sqrt($L/$C));
		echo "Q<sub>0</sub>=(1/R)*(sqrt(L/C))=(1/",$_POST['R'],ex($rm),")*(sqrt(",$_POST['L'],ex($lm),"/",$_POST['C'],ex($cm),"))=",round($Q0,2),"</br></br>";
	echo "Sávszélesség</br>";
		$B=$fr/$Q0;
		$ertekB=normal($B);
		echo "B=f<sub>r</sub>/Q<sub>0</sub>=$ertekFR[0]$ertekFR[2]/",round($Q0,2),"=$ertekB[0] $ertekB[1]Hz</br></br>";
	echo "Áram rezonancián</br>";
		$I0=$U/$R;
		$ertekI=normal($I0);
		echo "I<sub>0</sub>=U/R=$U/",$_POST['R'],ex($rm),"=$ertekI[0] $ertekI[1]A</br></br>";
	echo "Kondenzátor reaktanciája</br>";
		$XC0=1/($w*$C);
		$ertekXC=normal($XC0);
		echo "X<sub>C0</sub>=1/(ω*C)=1/($ertekW[0]$ertekW[2]*",$_POST['C'],ex($cm),")=$ertekXC[0] $ertekXC[1]Ω</br></br>";
	echo "Kondenzátoron eső feszültség rezonancián</br>";
		$UC0=$U*$Q0;
		$ertekUC=normal($UC0);
		echo "U<sub>C0</sub>=U*Q<sub>0</sub>=$U*",round($Q0,2),"=$ertekUC[0] $ertekUC[1]V</br></br>";
	echo "Tekercs reaktanciája</br>";
		$XL0=$w*$L;
		$ertekXL=normal($XL0);
		echo "X<sub>L0</sub>=ω*L=$ertekW[0]$ertekW[2]*",$_POST['L'],ex($lm),"=$ertekXL[0] $ertekXL[1]Ω</br></br>";
	echo "Látszólagos teljesítmény rezonancián</br>";
		$S0=$I0*$I0*$R;
		$ertekS=normal($S0);
		echo "S<sub>0</sub>=I<sub>0</sub><sup>2</sup>*R=($ertekI[0]$ertekI[2])<sup>2</sup>*",$_POST['R'],ex($rm),"=$ertekS[0] $ertekS[1]VA</br></br>";
	echo "Kondenzátor meddő teljesítménye</br>";
		$QC=$I0*$I0*$XC0;
		$ertekQC=normal($QC);
		echo "Q<sub>C</sub>=I<sub>0</sub><sup>2</sup>*X<sub>C0</sub>=($ertekI[0]$ertekI[2])<sup>2</sup>*$ertekXC[0]$ertekXC[2]=$ertekQC[0] $ertekQC[1]VAr</br></br>";
	echo "Tekercs meddő teljesítménye</br>";
		$QL=$I0*$I0*$XL0;
		$ertekQL=normal($QL);
		echo "Q<sub>L</sub>=I<sub>0</sub><sup>2</sup>*X<sub>L0</sub>=($ertekI[0]$ertekI[2])<sup>2</sup>*$ertekXL[0]$ertekXL[2]=$ertekQL[0] $ertekQL[1]VAr</br></br>";
	//fázis szög φ °
}
?>
</body>
</html>
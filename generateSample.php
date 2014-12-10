<?php
session_start();
$_SESSION['c1']=$_POST['c1'];
$_SESSION['c2']=$_POST['c2'];
$_SESSION['c3']=$_POST['c3'];
$_SESSION['c4']=$_POST['c4'];
$_SESSION['c5']=$_POST['c5'];
$_SESSION['c6']=$_POST['c6'];

$_SESSION['label1']=$_POST['label1'];
$_SESSION['label2']=$_POST['label2'];
$_SESSION['label3']=$_POST['label3'];
$_SESSION['label4']=$_POST['label4'];
$_SESSION['label5']=$_POST['label5'];
$_SESSION['label6']=$_POST['label6'];

function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}

$myfile = fopen("mySamples.txt", "w") or die("Unable to open file!");
$txt = $_POST['1'].$_POST['2'].$_POST['3'].$_POST['4'].$_POST['5'].$_POST['6'];
fwrite($myfile, $txt);
fclose($myfile);

$myfile = fopen("myClasses.txt", "w") or die("Unable to open file!");
$s1 = "1 ".hex2rgb($_POST['c1'])[0]." ".hex2rgb($_POST['c1'])[1]." ".hex2rgb($_POST['c1'])[2]." ".$_SESSION['label1']."\n";
$s2 = "2 ".hex2rgb($_POST['c2'])[0]." ".hex2rgb($_POST['c2'])[1]." ".hex2rgb($_POST['c2'])[2]." ".$_SESSION['label2']."\n";
$s3 = "3 ".hex2rgb($_POST['c3'])[0]." ".hex2rgb($_POST['c3'])[1]." ".hex2rgb($_POST['c3'])[2]." ".$_SESSION['label3']."\n";
$s4 = "4 ".hex2rgb($_POST['c4'])[0]." ".hex2rgb($_POST['c4'])[1]." ".hex2rgb($_POST['c4'])[2]." ".$_SESSION['label4']."\n";
$s5 = "5 ".hex2rgb($_POST['c5'])[0]." ".hex2rgb($_POST['c5'])[1]." ".hex2rgb($_POST['c5'])[2]." ".$_SESSION['label5']."\n";
$s6 = "6 ".hex2rgb($_POST['c6'])[0]." ".hex2rgb($_POST['c6'])[1]." ".hex2rgb($_POST['c6'])[2]." ".$_SESSION['label6']."\n";
$txt = $s1.$s2.$s3.$s4.$s5.$s6;
fwrite($myfile, $txt);
fclose($myfile);

echo "Samples and Class Description Files Created!";
?> 
<form action = "classify.php">
<input type="submit" value="Classify"/>
</form>


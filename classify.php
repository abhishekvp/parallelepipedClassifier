<?php
session_start();
shell_exec('java -jar signatures.jar '.$_SESSION['fname'].' myClasses.txt mySamples.txt');
shell_exec('java -jar classify.jar '.$_SESSION['fname'].' myClasses.txt new_parallel_signatures.txt');
echo '<img src='.$_SESSION['fname'].' width = 500 />';
echo '<img src= classified-with-parallelepiped.png width = 500 />';
echo '<br><h2>Original Image&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Classified Image</h2>';
echo '<input type="color" value = '.$_SESSION['c1'].' /> - '.$_SESSION['label1'].'<br>';
echo '<input type="color" value = '.$_SESSION['c2'].' /> - '.$_SESSION['label2'].'<br>';
echo '<input type="color" value = '.$_SESSION['c3'].' /> - '.$_SESSION['label3'].'<br>';
echo '<input type="color" value = '.$_SESSION['c4'].' /> - '.$_SESSION['label4'].'<br>';
echo '<input type="color" value = '.$_SESSION['c5'].' /> - '.$_SESSION['label5'].'<br>';
echo '<input type="color" value = '.$_SESSION['c6'].' /> - '.$_SESSION['label6'].'<br><br>';
echo '<form action="index.html">
<input type="submit" value="Classify New Image"/>
</form>';

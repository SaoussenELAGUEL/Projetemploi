<?php session_start();
if (!empty($_POST)){
$jour=$_POST['jour'];
$heure=$_POST['heure'];
unset($_SESSION['emploi'][$jour][$heure]);
echo true;
}
else 
exit;

?>
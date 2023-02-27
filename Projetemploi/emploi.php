<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Emploi de Temps</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <style>
    @media print {
      form, button,a {
        display:none;
      }
    }
    .style1{
      color:black;
      text-align:center;
      font-size:20px;
      padding:90px;
      height:400px;
      width:100%;
          }
    .style2{
      color:blue;
      text-align:center; 
      background-color:white;
      padding:30px 50px;
      border: blue 5px solid;
    }
    .style3{
      text-align:center;
    }
    .commun {
      background-image:url("https://www.education.gouv.fr/sites/default/files/styles/banner_1340x730/public/2020-02/ecole-elementaire-164383-jpg-30848.jpg?h=060947eb&itok=yREGyon3");
    }

  </style>
</head>
<body class="commun">
<?php session_start();
include "config.php";
if (!isset($_SESSION['emploi']))
$_SESSION['emploi']=[];
if (isset($_GET['new'])){
  unset($_SESSION['emploi']);
  header("location:emploi.php");
 }
if(isset($_POST['submit'])){
  $_SESSION['emploi'][$_POST['jour']][$_POST['heure']]=$_POST['matiere'];
  header("location:emploi.php");
}
  $emploi=$_SESSION['emploi'];
?>
    
    <div class="style1">
    <form  action="" method="post" class="style3">
    <label for="jour"><strong>Jour:</strong></label>
    <select name='jour' id='jour' >
      <option value="">--Choisir le jour--</option>
    <?php 
    foreach ($jours as $jour){
    echo "<option value='$jour'>$jour</option>";
  } 
  ?>
    </select>
    <label><strong>Heure:</strong></label>
    <select  name='heure' id='heure'>
    <option value="">--Choisir l'heure--</option>
    <?php 
    foreach ($heures as $heure){
    echo "<option  value='$heure'>$heure</option>";} 
    ?>
    </select>
    <label for="matiere"><strong>Matière:</strong></label>
    <input type="text" name="matiere" >
    <br> <br>
    <button name="submit" class="btn btn-lg btn-primary"> Ajoutez </button> 
    <button name="" class="btn btn-lg btn-secondary" onclick="window.print()">Imprimer </button>
  </form>
    <br><br>
   
    <a href="emploi.php?new=1"> <button class="btn btn-lg btn-success">Nouveau emploi</button></a>
    </div>
<br>
<div class="style2">
  <h1><strong >EMPLOI DU TEMPS</strong></h1>
  <?php
  echo "<h5> Imprimé le :".date("d/m/Y H:i:s")."</h5>";
  ?>
</div>
<br>
<?php
echo "<table style='text-align:center; font-size:18px;' class='table-light table table-bordered' width='100%' height='500'>
<tr><th><span style='color:blue'>Jour\Heure</span></th>";
foreach ($heures as $heure){
   echo "<th><span style='color:blue'>$heure</span></th>";
}
echo "</tr>";
foreach($jours as $jour){
   echo "<tr><th><span style='color:blue'>$jour</span></th>";
foreach($heures as $heure){
  if (isset($emploi[$jour][$heure]))
  echo "<td id='$jour$heure'>".$emploi[$jour][$heure]."<button  onclick=\"if(confirm('Etes vous sur de supprimer ?')) supprimer('$jour','$heure')\" type='button' class='btn-close' aria-label='Close'></button></td>";
  else echo "<td></td>";
}
}

echo "</table>";  
?>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <script>
  function supprimer(jour,heure){
  $.ajax(
    {
      type:"POST",
      url:"supprimer.php",
      data:{jour:jour,heure:heure},
      beforeSend:function(){
      },
      success:function(data){
        var id=jour+heure;
      document.getElementById(id).innerHTML="";
      }
    }
  );
}
 </script>
</body>
</html>
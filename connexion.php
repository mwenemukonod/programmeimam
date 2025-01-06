<?php
$con=mysqli_connect("localhost","root","","programmeimambd");

if($con)
{
    //echo "connexion etablie";
}
else

{
  die('Erreur de la connexion au serveur'.mysqli_connect_error());

}




?>
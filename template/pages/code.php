<?php
 session_start();
//include  "../../conn.php";
$con = mysqli_connect("localhost","root","","programmeimambd");

$_SESSION['active'] = 0;
if(isset($_POST['save_multiple_data']))
{
    $idm = $_POST['idm'];
    $dj = $_POST['dj'];
    $mada = $_POST['mada'];
   // $imam=$_GET['ima'];
    $imam=$_SESSION['imam'];
    $mois=$_SESSION['mois'];;
    $annee=$_SESSION['annee'];
 
  
  //  $quai = $_POST['quai'];
   // $longueur = $_POST['longueur'];
  //  $largeur = $_POST['largeur'];
   // $poste = $_POST['poste'];

     foreach($dj as $index => $djs)
    {
      $codep=rand(5,1111111);
        $s_dj = $djs;
        $s_idm = $idm[$index];
        //$s_dj= $dj[$index];
        $s_mada = $mada[$index];
       //$s_poste = $poste[$index];
      
       //$query = $db->query("INSERT INTO programme (idprog,dateprog,mada,idm,mois,annnee,id) VALUES ('$codep','2025-01-02','ok','32','$mois','$annee','$imam')");
       $addx ="INSERT INTO programme(dateprog,mada,idm,mois,annnee,id) VALUES ('$s_dj','$s_mada','$s_idm','$mois','$annee','$imam')";
       $add = mysqli_query($con, $addx);
      }
      if ($add){
        $_SESSION['active'] = 1;$_SESSION['color']="success";$_SESSION['message']="Enregistrement reussi. !";
        header("Refresh: 0; url=prog.php");
        //exit(0);
      }
      else{
        $_SESSION['active'] = 1;$_SESSION['color']="danger";$_SESSION['message']="Impossible d'enregistrer. !";
       // echo 'niko napima';
       header("Refresh: 0; url=prog.php");
      }

}
//header("Refresh: 0; url=programme.php");
?>
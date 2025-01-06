<?php
  session_start();
  include  "../../conn.php";
  $_SESSION['active'] = 0;

  $btnAdd = $_POST['btnAdd'];
  $btnUpdate = $_POST['btnUpdate'];
  $btnDelete = $_POST['btnDelete'];
  $id = $_POST['id'];
  $name = $_POST['name'];
  

  if(isset($btnAdd))
  {
    $count = 0;
    $student_check = $db->query("SELECT * FROM localisation WHERE libele='$name'");
    $count = $student_check->fetchColumn();
    if($count < 1)
    {
      $add_student = $db->query("INSERT INTO localisation(libele) VALUES ('$name')");
      if ($add_student){
        $_SESSION['active'] = 1;$_SESSION['color']="success";$_SESSION['message']="Enregistrement reussi. !";
      }
      else{
        $_SESSION['active'] = 1;$_SESSION['color']="danger";$_SESSION['message']="Impossible d'enregistrer. !";
      }
    }
    else
    {
      $_SESSION['active'] = 1;
      $_SESSION['color'] = "danger";
      $_SESSION['message'] = "Il ya une erreur";
    }
  }

  if (isset($btnUpdate)) {
    $new_class = $db->query("SELECT * FROM localisation ")->fetch(PDO::FETCH_ASSOC);
    $clas_count = $new_class["idlib"];

    if( $new_class){
   
        $upd_std = $db->query("UPDATE localisation SET libele='$name' WHERE idlib='$id'");
        if ($upd_std) {
          $_SESSION['active'] = 1;$_SESSION['color']="success";$_SESSION['message']="Modification reussi";
        }
        else{
          $_SESSION['active'] = 1;$_SESSION['color']="danger";$_SESSION['message']="Impossible de modifier . !";
        }
     
        }
        else{
          $_SESSION['active'] = 1;$_SESSION['color']="danger";$_SESSION['message']="Veuillez selectionner une information. !";
        }
     
  }

  if (isset($btnDelete)) {
    $dlt_std = $db->query("DELETE FROM localisation WHERE idlib='$id'");
    if ($dlt_std) {
      $_SESSION['active'] = 1;$_SESSION['color']="success";$_SESSION['message']="Supression reussi. !";
      $max_std = $db->query("SELECT id FROM imam WHERE nomcomplet='$name'")->fetch(PDO::FETCH_ASSOC);
      $upd_count = $max_std["classes_count"] + 1;
      
    }
    else{
      $_SESSION['active'] = 1;$_SESSION['color']="danger";$_SESSION['message']="impossible de supprimer. !";
    }
  }

  header("Refresh: 0; url=localisation.php");
?>

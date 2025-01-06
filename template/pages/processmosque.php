<?php
  session_start();
  include  "../../conn.php";
  $_SESSION['active'] = 0;

  $btnAdd = $_POST['btnAdd'];
  $btnUpdate = $_POST['btnUpdate'];
  $btnDelete = $_POST['btnDelete'];
  $id = $_POST['idm'];
  $name = $_POST['name'];
  $idlib = $_POST['idlib'];
  

  if(isset($btnAdd))
  {
    $count = 0;
    $student_check = $db->query("SELECT * FROM mosques WHERE designation='$name'");
    $count = $student_check->fetchColumn();
    if($count < 1)
    {
      $add_student = $db->query("INSERT INTO mosques(designation,idlib) VALUES ('$name','$idlib')");
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
      $_SESSION['message'] = "Cette mosquée existe déjà";
    }
    
  }
  


  if (isset($btnUpdate)) {
    $new_class = $db->query("SELECT * FROM mosques ")->fetch(PDO::FETCH_ASSOC);
    $clas_count = $new_class["idm"];

    if( $new_class){
   
        $upd_std = $db->query("UPDATE mosques SET designation='$name',idlib='$idlib' WHERE idm='$id'");
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
    $dlt_std = $db->query("DELETE FROM mosques WHERE idm='$id'");
    if ($dlt_std) {
      $_SESSION['active'] = 1;$_SESSION['color']="success";$_SESSION['message']="Supression reussi. !";
      $max_std = $db->query("SELECT idm FROM mosques WHERE designation='$name'")->fetch(PDO::FETCH_ASSOC);
      $upd_count = $max_std["idm"] + 1;
      
    }
    else{
      $_SESSION['active'] = 1;$_SESSION['color']="danger";$_SESSION['message']="impossible de supprimer. !";
    }
  }
  header("Refresh: 0; url=mosque.php");
  
?>

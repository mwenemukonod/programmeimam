<?php
  session_start();
  include  "../../conn.php";
  $_SESSION['active'] = 0;

  $btnAdd = $_POST['btnAdd'];
  $btnUpdate = $_POST['btnUpdate'];
  $btnDelete = $_POST['btnDelete'];
  $id = $_POST['id'];
  $no = $_POST['no'];
  //$updNo = $_POST['updNo'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $codep=rand(5,1111111);

  if(isset($btnAdd))
  {
    $count = 0;
    $student_check = $db->query("SELECT * FROM imam ");
    $count = $student_check->fetchColumn();
    //if($count > 1)
    //{
      $add_student = $db->query("INSERT INTO imam(nomcomplet, telephone, gmail, role,motdepasse,statut) VALUES ('$name','$no','$email','imam','$codep','1')");
      if ($add_student){
        $_SESSION['active'] = 1;$_SESSION['color']="success";$_SESSION['message']="Enregistrement reussi. !";
      }
      else{
        $_SESSION['active'] = 1;$_SESSION['color']="danger";$_SESSION['message']="Impossible d'enregistrer. !";
      }
    //}
    //else
    //{
    //  $_SESSION['active'] = 1;
    //  $_SESSION['color'] = "danger";
    //  $_SESSION['message'] = "Il ya une erreur";
    //}
  }

  if (isset($btnUpdate)) {
    $new_class = $db->query("SELECT * FROM imam WHERE nomcomplet='$name'")->fetch(PDO::FETCH_ASSOC);
    $clas_count = $new_class["id"];

    if( $new_class){
   
        $upd_std = $db->query("UPDATE imam SET nomcomplet='$name',telephone='$no',gmail='$email' WHERE id='$id'");
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
    $dlt_std = $db->query("DELETE FROM imam WHERE id='$id'");
    if ($dlt_std) {
      $_SESSION['active'] = 1;$_SESSION['color']="success";$_SESSION['message']="Supression reussi. !";
      $max_std = $db->query("SELECT id FROM imam WHERE nomcomplet='$name'")->fetch(PDO::FETCH_ASSOC);
      $upd_count = $max_std["classes_count"] + 1;
      
    }
    else{
      $_SESSION['active'] = 1;$_SESSION['color']="danger";$_SESSION['message']="impossible de supprimer. !";
    }
  }

  header("Refresh: 0; url=imam.php");
?>

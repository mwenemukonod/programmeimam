<?php
  session_start();
                 include  "../../conn.php";
        $_SESSION['active'] = 0;
        $idprog=$_GET['idprog'];
        $btnAdd = $_POST['modifier'];
        $mosque=$_POST['idm'];
        $dat=$_POST['dj'];
        $mada=$_POST['mada'];
      if  (isset($btnAdd))
      {
      
        $add_student = $db->query("UPDATE programme SET idm='$mosque',dateprog='$dat',mada='$mada' where idprog='$idprog'");
      if ($add_student){
        $_SESSION['active'] = 1;$_SESSION['color']="success";$_SESSION['message']="Modification reussi. !";
      }
      else{
        $_SESSION['active'] = 1;$_SESSION['color']="danger";$_SESSION['message']="Impossible de modifier. !";
      }
                          
     }
     header("Refresh: 0; url=sitprog.php");
      ?>
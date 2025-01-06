<?php
  include 'header.php'; 
  $ajout = $db->query("SELECT idm,mosques.idlib,localisation.libele,mosques.designation FROM mosques,localisation where mosques.idlib=localisation.idlib")->fetchAll(PDO::FETCH_ASSOC);
  $mosq = $db->query("SELECT idm,mosques.idlib,localisation.libele,mosques.designation FROM mosques,localisation where mosques.idlib=localisation.idlib")->fetchAll(PDO::FETCH_ASSOC);
  
  
  ?>
<!DOCTYPE html>
<html lang="fr">
    
<!-- Mirrored from coderthemes.com/hyper/saas/form-elements.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 29 Jul 2022 10:21:33 GMT -->
<head>
<meta charset="utf-8" />
        <title>PROGRAMME IMAM|UVIRA</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="cpmmisariat" name="description" />
        <meta content="BUSIME PATRICK" name="author" />
        <!-- App favicon -->
        <link rel="icon" href="../multiprog/images/maritime.png">

        <!-- third party css -->
        <link href="../multiprog/css/vendor/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- third party css end -->

        <!-- App css -->
        <link href="../multiprog/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="../multiprog/css/app.min.css" rel="stylesheet" type="text/css" id="app-style"/>
        
    </head>

    <body class="loading" data-layout-color="light" data-leftbar-theme="dark" data-layout-mode="fluid" data-rightbar-onstart="true">
        <!-- Begin page -->
        <div class="wrapper">
        <div class="card-header">
                        <h4>ENREGISTREMENT PROGRAMME
             
                        </h4>
                    </div>
                    
                    <div class="card-body">
                    <div class="row">
            <?php if($_SESSION['active'] == 1){?>
              <div class="container alert alert-<?php echo $_SESSION['color']; ?> text-center" role="alert" style="font-weight: bold;">
                <?php echo $_SESSION['message']; ?>
              </div>
            <?php 
             $_SESSION['active'] = 0;
             ?>
             <script type="text/javascript">
              setTimeout(function(){
               window.location.reload(1);
              }, 3000);
              </script>
             <?php 
            } 
            ?>
           
                
                      
                       
                 
                <div class="tab-content">
                        <div class="tab-pane show active" id="buttons-table-preview">
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
    <thead>
        <tr>
            <th>Imam</th>
            <th>Mosque</th>
            <th>Mada</th>
            <th>Date</th>
            <th>Mois</th>
            <th>Annee</th>
            <th>Action</th>
     
        </tr>
    </thead>
    

    <tbody>
    <?php

$con = mysqli_connect("localhost","root","","programmeimambd");


$selectionnernav=mysqli_query($con,"select libele,idprog,nomcomplet,designation,mada,dateprog,mois,annnee from mosques,imam,programme,localisation where programme.id=imam.id and programme.idm=mosques.idm and localisation.idlib=mosques.idlib ORDER BY idprog desc");

    while($lignes=mysqli_fetch_assoc($selectionnernav))
    {?>
        <tr>
            <td><?php echo $lignes['nomcomplet']; ?></td>
            <td><?php echo $lignes['designation'].' de '.$lignes['libele']; ?></td>
            <td><?php echo $lignes['mada']; ?></td>
            <td><?php echo $lignes['dateprog']; ?></td>
            <td><?php echo $lignes['mois']; ?></td>
            <td><?php echo $lignes['annnee']; ?></td>

            <td class="table-action text-center">
                <a href="modallprog.php?idprog=<?php echo $lignes['idprog'];?> "class="action-icon" style="color:red;">Modifier </a>
            </td>
        </tr>
        <?php }  ?>
    </tbody>
    
</table>
    </div>
    </div>
                <script src="../multiprog/js/vendor.min.js"></script>
        <script src="../multiprog/js/app.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>


                </body>
                <script src="../multiprog/js/vendor/jquery.dataTables.min.js"></script>
        <script src="../multiprog/js/vendor/dataTables.bootstrap5.js"></script>
        <script src="../multiprog/js/vendor/dataTables.responsive.min.js"></script>
        <script src="../multiprog/js/vendor/responsive.bootstrap5.min.js"></script>
        <script src="../multiprog/js/vendor/dataTables.buttons.min.js"></script>
        <script src="../multiprog/js/vendor/buttons.bootstrap5.min.js"></script>
        <script src="../multiprog/js/vendor/buttons.html5.min.js"></script>
        <script src="../multiprog/js/vendor/buttons.flash.min.js"></script>
        <script src="../multiprog/js/vendor/buttons.print.min.js"></script>
        <script src="../multiprog/js/vendor/dataTables.keyTable.min.js"></script>
        <script src="../multiprog/js/vendor/dataTables.select.min.js"></script>
        <script src="../multiprog/js/vendor/fixedColumns.bootstrap5.min.js"></script>
        <script src="../multiprog/js/vendor/fixedHeader.bootstrap5.min.js"></script>
       
        <script src="../multiprog/js/pages/demo.datatable-init.js"></script>        
                </html>

            

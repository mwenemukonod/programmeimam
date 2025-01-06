<?php
  include 'header.php'; 
 
$idprog=$_GET['idprog'];
  $ajout = $db->query("SELECT idm,mosques.idlib,localisation.libele,mosques.designation FROM mosques,localisation where mosques.idlib=localisation.idlib")->fetchAll(PDO::FETCH_ASSOC);
  $mosq = $db->query("SELECT idm,mosques.idlib,localisation.libele,mosques.designation FROM mosques,localisation where mosques.idlib=localisation.idlib")->fetchAll(PDO::FETCH_ASSOC);
  $prog = $db->query("SELECT programme.idm,idprog,libele,designation,mada,dateprog FROM mosques,programme,localisation where localisation.idlib=mosques.idlib and mosques.idm=programme.idm and idprog='$idprog'")->fetchAll(PDO::FETCH_ASSOC);
  $dt;
  foreach($prog as $prog){
$dt=$prog['dateprog'];
$mada=$prog['mada'];
$designation=$prog['designation'].' de '.$prog['libele'];
$idm=$prog['idm'];
  }
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
           
                
                        <form action="processmodprog.php?idprog=<?php echo $idprog;?>" method="POST" enctype="multipart/form-data">
                        
                            <div class="main-form mt-3 border-bottom">
                                <div class="row">
                               
                               
                                           <div class="col-md-4">
                                    <div class="form-group mb-2">
                                        
                                             <label for="">Mosquée  </label>
                                             <select name="idm" class="form-select" id="example-select" >
                                            <option value="<?php echo $idm;?>"><?php echo $designation;?></option>
                                            <?php foreach($mosq as $mosqx){ ?>
                                <option value="<?php echo $mosqx["idm"]; ?>"><?php echo $mosqx["designation"]." de ".$mosqx["libele"]; ?></option>
                              <?php } ?>
                                            </select>
                                            </div>                  
                                            </div>
                                            <div class="col-md-2">
                                            <div class="form-group mb-2">
                                                        
                                              <label for="">Date du jour </label>
                                              <input name="dj" type="date" value="<?php echo $dt;?>" class="form-control" placeholder="<?php echo $dt;?>">
                                             </div>
                                             </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label for="">Mada du jour</label>
                                            <input type="text" name="mada" value="<?php echo $mada;?>" class="form-control" required placeholder="">
                                        </div>
                                    </div>
                                   
                                    </div>
                                   
                                </div>
                            </div>

                            <div class="paste-new-forms"></div>

                            <button type="submit" name="modifier" class="btn btn-primary">Modifier</button>
                        </form>
                       
          
                <script src="../multiprog/js/vendor.min.js"></script>
        <script src="../multiprog/js/app.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>


   

                </body>
                
                </html>

           

            

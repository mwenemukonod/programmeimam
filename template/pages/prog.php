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
           <h2>ETAPE 2/2</h2>
                
                        <form action="code.php" method="POST">
                        
                            <div class="main-form mt-3 border-bottom">
                                <div class="row">
                               
                               
                                           <div class="col-md-4">
                                    <div class="form-group mb-2">
                                        
                                             <label for="">Mosquée  </label>
                                             <select name="idm[]" class="form-select" id="example-select" >
                                            <option selected="true" enabled="true">Selectionnez une mosquee</option>
                                            <?php foreach($mosq as $mosqx){ ?>
                                <option value="<?php echo $mosqx["idm"]; ?>"><?php echo $mosqx["designation"]." de ".$mosqx["libele"]; ?></option>
                              <?php } ?>
                                            </select>
                                            </div>                  
                                            </div>
                                            <div class="col-md-2">
                                            <div class="form-group mb-2">
                                                        
                                              <label for="">Date du jour </label>
                                              <input name="dj[]" type="date"  class="form-control" placeholder="Adresse Port">
                                             </div>
                                             </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label for="">Mada du jour</label>
                                            <input type="text" name="mada[]" class="form-control" required placeholder="description ici">
                                        </div>
                                    </div>
                                   
                                    </div>
                                   
                                </div>
                            </div>

                            <div class="paste-new-forms"></div>

                            <button type="submit" name="save_multiple_data" class="btn btn-primary">Programmer</button>
                        </form>
                       
                 
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
                <a href="supprog.php?idprog=<?php echo $lignes['idprog'];?> "class="action-icon" style="color:red;">Modifier </a>
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


    <script>
        $(document).ready(function () {

            $(document).on('click', '.remove-btn', function () {
                $(this).closest('.main-form').remove();
            });
            
            $(document).on('click', '.add-more-form', function () {
                $('.paste-new-forms').append('<div class="main-form mt-3 border-bottom">\
                                <div class="row">\
                                    <div class="col-md-3">\
                                        <div class="form-group mb-2">\
                                            <label for="">Mosquée</label>\
                                            <select name="idm[]" class="form-select" id="example-select" >\
                                             <option>Selectionnez une autre mosquee</option>\
                                            <?php foreach($ajout as $ajout){?>
                                                 <option value="<?php echo $ajout['idm']; ?>"><?php  echo $ajout['designation']." de ".$ajout["libele"];  ?></option>\
                              <?php } ?>
                              </select>\
                                            </div>\
                                    </div>\
                                    <div class="col-md-2">\
                                        <div class="form-group mb-2">\
                                            <label for="">date du jour</label>\
                                            <input type="date" name="dj[]" class="form-control" required placeholder="Entrer la lonueur du quai">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-3">\
                                        <div class="form-group mb-2">\
                                            <label for="">Mada du jour</label>\
                                            <input type="text" name="mada[]" class="form-control" required placeholder="Description ici">\
                                        </div>\
                                    </div>\
                                   <div class="col-md-4">\
                                        <div class="form-group mb-2">\
                                            <br>\
                                            <button type="button" class="remove-btn btn btn-danger">Enlever</button>\
                                        </div>\
                                    </div>\
                                </div>\
                            </div>');
            });

        });
    </script>


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

            

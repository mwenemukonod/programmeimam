<?php
  include 'header.php'; 
  $students = $db->query("SELECT idm,mosques.idlib,libele,designation FROM mosques,localisation where mosques.idlib=localisation.idlib")->fetchAll(PDO::FETCH_ASSOC);
  $locs = $db->query("SELECT * FROM localisation order by libele asc")->fetchAll(PDO::FETCH_ASSOC);

?>
        <div class='main-panel'>
          <div class='content-wrapper text-center'>
            <h2 class="p-3 " style="font-weight: bold;">ENREGISTREMENT DE LA MOSQUEE</h2>
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
            <div class="col-12">
              <div class="card">
                <div class="container text-center mt-3">
                  <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modalinsert">Ajouter une nouvelle Mosquée</button>
                </div>
                <div class="card-body">



                
                    <div class="table-responsive">
                      <form name="formName" action="" method="POST">
                        <div class="container-fluid text-center mt-3 mb-3" id="editAll" style="display: none;border: 1px solid;">
                          <button type="submit" class="mt-3 col-5 btn btn-outline-danger" data-target="#checkedDelete" data-toggle="modal" name="delete" id="btnAllDelete" >Supprimer</button>
                            <button type="submit" class="col-5 btn btn-outline-primary mt-3" data-target="#checkedUpdate" data-toggle="modal" name="update" id="btnAllAdd">a changer</button>
                          
                          <button type="submit" class="col-12 btn btn-outline-secondary mt-3 mb-3" data-target="#checkedUpdate" data-toggle="modal" name="randomAdd" id="btnAllAdd">a changer</button>
                          
                        </div>
                        <table id="zero_config" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" name="all" id="all" value=""  onclick="sec()"/>Sélectionner tout</th>
                                    <th>#</th>
                                    <th>Designation</th>
                                 
                                    <th>Libellé</th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                              <?php 
                               ?>
                              <?php 
                              $count = 0;
                              foreach ($students as $students){
                              $count++;
                              $id[$count] = $students["idm"];

                              ?>
                                <tr>
                                    <td><input type="checkbox" id="std" name="sec[]" value="<?php echo $students["idm"]; ?>"></td>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo $students["designation"]; ?></td>
                                    <td><?php echo $students["libele"]; ?></td>
                                 
                                    
                                    <td>
                                        <button type="button" class="btn btn-outline-success editstudent p-2" data-toggle="modal" data-name = "<?php echo $students["designation"]; ?>" data-libele="<?php echo $students["libele"]; ?>"  data-idm="<?php echo $students["idm"]; ?>" data-idlib="<?php echo $students["idlib"]; ?>"  data-target="#exampleModal"> 
                                          <i class="mdi mdi-table-edit"></i>Modifier
                                        </button>
                                        <button type="button" class="btn btn-outline-danger deletestudent p-2" data-name = "<?php echo $students["designation"]; ?>" data-libele = "<?php echo $students["libele"]; ?>"  data-toggle="modal" data-idm="<?php echo $students["idm"]; ?>"  data-idlib="<?php echo $students["idlib"]; ?>" data-target="#myModal"> 
                                          <i class="mdi mdi-delete-forever"></i>Supprimer
                                        </button>
                                    </td>
                                </tr>
                              <?php } ?>
                            </tbody>
                        </table>
                        </form>
                      </div>
                    </div>


                  </div>
                </div>
          </div>
          </div>
        </div>

        <!-- Modal UPDATE-->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"> MODIFICATION</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                  <div class="modal-body">
                    <div class="card">
                      <div class="card-body">
                        <form class="forms-sample" action="processmosque.php" method="POST"enctype="multipart/form-data">
                          <input type="hidden" id="idm" name="idm" id="value">
                          
                          <div class="form-group row">
                              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Designation Mosquée</label>
                              <div class="col-sm-9">
                                <input id="name" type="text" class="form-control" name="name"  placeholder="Designation" required>
                              </div>
                            </div>
                            <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Adresse</label>
                            <div class="col-sm-9">
                              <input type="hidden" id="updClass" name="updClass">
                              <select name="idlib" id="idlib" class="form-control text-white">
                              <?php foreach($loc as $loc){ ?>
                                <option value="<?php echo $loc["idlib"]; ?>"><?php echo "".$loc["libele"]; ?></option>
                              <?php } ?>
                              </select>
                            </div>
                          </div>
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-outline-primary" name="btnUpdate" id="btnUpdateSubmit"> Modifier</button>
                        </form>
                      </div>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- modal UPDATE -->

            <!-- modal INSERT -->
            <div class="modal fade" id="modalinsert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> INSERTION</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                    <div class="modal-body">
                      <div class="card">
                        <div class="card-body">
                          <form class="forms-sample" action="processmosque.php" method="POST"enctype="multipart/form-data">
                            <input type="hidden" id="idm" name="idm" id="value">
                            <div class="form-group row">
                              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Designation Mosquée</label>
                              <div class="col-sm-9">
                                <input id="name" type="text" class="form-control" name="name"  placeholder="Entre la designation" required>
                              </div>
                            </div>
                            <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Adresse</label>
                            <div class="col-sm-9">
                              <input type="hidden" id="" name="">
                              <select  class="form-control text-white" name="idlib" id="idlib">
                              <?php foreach($locs as $locs){ ?>
                                <option value="<?php echo $locs["idlib"]; ?>"><?php echo $locs["libele"]; ?></option>
                              <?php } ?>
                              </select>
                            </div>
                          </div>
                           
                              <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Fermer</button>
                              <button type="submit" class="btn btn-outline-success" name="btnAdd" id="btnUpdateSubmit">Envoyer</button>
                        
                            </form>
                        </div>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
              <!-- modal INSERT -->

              <!-- Modal DELETE-->
              <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4  style="text-transform:uppercase;" class="modal-title" id="myModalLabel"></h4>
                          </div>
                          <div class="modal-body" style="height:120px">
                              <form class="form-control" method="POST" action="processmosque.php">
                                  <input type="hidden" id="deleteid" name="idm">
                                  <input type="hidden" id="deleteclass" name="class">
                                  <p>
                                   Voulez-vous supprimer cette information ?

                                  </p>
                                  <br>
                                      <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fermer</button>
                                      <button type="submit" name="btnDelete" class="btn btn-outline-danger">Supprimer</button>
                              </form>
                          </div>
                      </div>
                      <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
$('.editstudent').click(function (event) {
    var name = $(this).attr("data-designation");
    var idm = $(this).attr("data-idm");
    var idlib = $(this).attr("data-idlib");
    var libele = $(this).attr("data-libele");
    $("#name").val(name);
    $("#value").val(idm);
    $("#idm").val(idm);
    $("#idlib").val(idlib);
    $("#libele").val(libele);
   
    });

$('.deletestudent').click(function (event) {
    var name = $(this).attr("data-designation");
    var idm = $(this).attr("data-idm");
    var idlib = $(this).attr("data-idlib");
    var libele = $(this).attr("data-libele");
 

    $("#deleteid").val(idm);
   // $("#deleteclass").val(clas);
    $("#myModalLabel").html(name);
    });

var selectname = document.getElementsByName('sec[]');
var count = selectname.length;

function sec(){
    for (var i = 0; i< count; i++) {
      if(document.getElementById('all').checked){ 
        selectname[i].checked=true;
          document.getElementById("editAll").style.display="";
      }
      else{
          document.getElementById("editAll").style.display="none";
       selectname[i].checked=false;
     }
    }
  }

if (document.getElementById("std").checked) {
  document.getElementById("editAll").style.display="";
}else{
  document.getElementById("editAll").style.display="none";
}


</script>
          <!-- content-wrapper ends -->
          <!-- Footer -->
      <?php include 'footer.php'; ?>

<?php

  include 'header.php'; 
  $locs = $db->query("SELECT idm,mosques.idlib,libele,designation FROM mosques,localisation where mosques.idlib=localisation.idlib order by designation asc")->fetchAll(PDO::FETCH_ASSOC);
  $im = $db->query("SELECT * FROM imam order by nomcomplet asc")->fetchAll(PDO::FETCH_ASSOC);
 
  
?>
        <div class='main-panel'>
          <div class='content-wrapper text-center'>
            <h2 class="p-3 " style="font-weight: bold;">ENREGISTREMENT PROGRAMME</h2>
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
                  <h>ETAPE 1/2</h2>
                </div>
                <div class="card-body">
            
                      <form method="post"  action="programme.php">
                 

                            <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Imam</label>
                            <div class="col-sm-4">
                             
                              <select name="idimam" id="idimam" class="form-control text-white">
                             
                                <option>Selectionnez l'imam</option>
                              
                              <?php foreach($im as $im){ ?>
                              
                               
                                <option value="<?php echo $im["id"]; ?>"><?php echo "".$im["nomcomplet"]; ?></option>
                              <?php } ?>
                              </select>
                            </div>
                          </div>
                          <div class="form-group row">
                              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Mois</label>
                              <div class="col-sm-4">
                              <select name="mois" id="mois" class="form-control text-white">
                            
                                
                                <option>Selectionnez le mois</option>
                             
                                <option value="Janvier">Janvier</option>
                                <option value="Février">Février</option>
                                <option value="Mars">Mars</option>
                                <option value="Avril">Avril</option>
                                <option value="Mai">Mai</option>
                                <option value="Juin">Juin</option>
                                <option value="Juillet">Juillet</option>
                                <option value="Aout">Aout</option>
                                <option value="Septembre">Septembre</option>
                                <option value="Octobre">Octobre</option>
                                <option value="Novembre">Novembre</option>
                                <option value="Décembre">Décembre</option>
                              </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Anée</label>
                              <div class="col-sm-4">
                                <input id="annee" type="text" class="form-control" name="annee"  placeholder="2025" required>
                              </div>
                            </div>

                            
                              <button type="submit" class="btn btn-outline-success" name="suivant" id="suivant">Suivant</button>
                        
                        </form>
                   
                    </div>
                  </div>
                </div>
          </div>
          </div>
        </div>


           
                      <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">



</script>
          <!-- content-wrapper ends -->
          <!-- Footer -->
      <?php include 'footer.php'; ?>

      <?php
      
      if  (isset($_POST["suivant"]))
      {
    
       $_SESSION['imam']=$_POST['idimam'];
       $_SESSION['mois']=$_POST['mois'];
       $_SESSION['annee']=$_POST['annee'];

      
       
       echo "<script type='text/javascript'>window.location.href ='prog.php';</script>";
                          
     }
    
      ?>

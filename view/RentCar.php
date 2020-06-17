<html>
    <?php
    include 'fragmentHead.html';
    //session_start();
    ?>
    <body>
        <?php include 'fragmentNav.html'; ?>
        <?php include 'fragmentJum.php'; ?>
        <div class="panel-success" style="position: relative; top: 10px;border: solid; border-color: #ccffcc">
            <div class="panel-heading">Gather the information of your rent</div>
            <div class="panel-body">
                <form method="get" action="../Controler/router.php">
                   <input type="hidden" name='action' value='rentedcar'>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="plaque">Licence plate number</label>
                                <input type="text" class="form-control" id="plaque" name="plaque" >
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="brand">Brand of your car</label>
                                <input type="text" class="form-control" id="brand" name="brand" >
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="NumberOfSeat">Number of seats</label>
                                <input type="text" class="form-control" id="brand" name="nb_seat" >
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="dof">Date of start availble</label>
                                <input type="date" class="form-control" id="DoS" name="d_start" >
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="dof">Date of finish availble</label>
                                <input type="date" class="form-control" id="Dof" name="d_finish" >
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="dp">Daily Price</label>
                                <input type="text" class="form-control" id="dp" name="prix" >
                            </div>
                        </div>


                    </div>

                    <div class="form-group">
                        <label>Choose an agence which you car arrive</label>
                        <select name="agence">
                            <?php
                                foreach ($results as $ins){
                                    printf('<option value="%s">%s,%s<option>',$ins->getName(),$ins->getName(),$ins->getAdress());
                                }
                            
                            
                            
                            
                            ?>
                            
                            
                            
                           
                        </select>
                    </div>

                    <input type="submit"/>
                </form>




            </div>




        </div>







    </body>
</html>

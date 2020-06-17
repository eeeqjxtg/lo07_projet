<html>
    <?php
    include 'fragmentHead.html';
   // session_start();
    ?>
    <body>
        <?php include 'fragmentNav.html'; ?>
        <?php include 'fragmentJum.php'; ?>
        <div class="panel-success" style=" position: relative; top: 10px;border: solid; border-color: #ccffcc">
            <div class="panel-heading">Input your condition of reservation</div>
            <div class="panel-body">
                <form method="get" action="../Controler/router.php">
                    <input type="hidden" name='action' value='selectedcar'>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="ville">Date of start </label>
                                <input type="date" class="form-control" id="DoS" name="DateOfStart" placeholder="aaaa-mm-jj" >
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="ville">Date of finish </label>
                                <input type="date" class="form-control" id="Dof" name="DateOfFinish" placeholder="aaaa-mm-jj" >
                            </div>
                        </div>



                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Agence </label>
                                <select name="Agence">
                                    <?php 
                                        foreach ($resultsr as $re){
                                            printf("<option value=%s>%s</option>",$re->getName(),$re->getName());
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">


                            <div class="form-group">
                                <label>Number of person </label>
                                <select name="NumberOfPerson">
                                    <option value="1">1-4</option>
                                    <option value="5">5-7</option>
                                    <option value="8">8-10</option>
                                    <option value="11">10+</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="submit"/>
                </form>




            </div>




        </div>




    </body>
</html>
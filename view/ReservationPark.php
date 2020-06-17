<html>
    <?php
    include 'fragmentHead.html';
   // session_start();
    ?>
    <body>
        <?php include 'fragmentNav.html'; ?>
        <?php include 'fragmentJum.php'; ?>
        <div class="panel panel-success" style="background-color: #ffffff; position: relative; top: 10px; border: solid; border-color: #ccffcc">
            <div class="panel-heading">Input your condition of reservation</div>
            <div class="panel-body">
                <form method="get" action="../Controler/router.php">
                    <input type="hidden" name='action' value='selectedpark'>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="ville">Date of start </label>
                                <input type="date" class="form-control" id="DoS" name="DateOfStart" >
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="ville">Date of finish </label>
                                <input type="date" class="form-control" id="Dof" name="DateOfFinish" >
                            </div>
                        </div>



                    </div>

                    <div class="form-group">
                        <label>Choose your parking</label>
                        <input name="city" class="form-control" id="city" type="text">
                           Enter your destination city
                        </input>
                    </div>

                    <input type="submit"/>
                </form>




            </div>




        </div>



    </body>
</html>
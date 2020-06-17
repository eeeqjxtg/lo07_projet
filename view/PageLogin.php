<html>
    <?php
    include 'fragmentHead.html';
    //session_start();
    ?>
    <body>
        <?php include 'fragmentNav.html'; ?>
        <div class="panel panel-success" style=" position: relative; top: 60px">
            <div class="panel-heading">Congratulations!</div>
            <div class="panel-body">
                <form method="post" action="../Controler/router.php">
                    <input type="hidden" name='action' value='logedin'>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="un" name="email" >
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="passwd">Password </label>
                                <input type="password" class="form-control" id="ps" name="passwd" >
                            </div>
                        </div>



                    </div>

                    

                    <input type="submit"/>
                </form>
            </div>
        </div>
        
        
        
        
    </body>

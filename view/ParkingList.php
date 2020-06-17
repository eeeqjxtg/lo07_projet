<html>
    <?php
    require_once '../Model/ModelSite.php';
    require_once '../Model/ModelParking.php';
    include 'fragmentHead.html';
    session_start();
    ?>
    <body>
        <?php include 'fragmentNav.html'; ?>
        <?php include 'fragmentJum.php'; ?>

        <div class="panel panel-success" style=" position: relative;top: 20px">
            <div class="panel-heading">results of your select</div>
            <div class="panel-body">
            <table class="table-striped table-bordered" style="width: 100%; " >
                <thead >
                <th scope="col">Identification of your trunk space</th>
                <th scope="col">Parking name</th>
                <th scope="col">Adresse</th>
                <th scope="col">Daily price</th>
                <th scope="col">reserve now</th>
                </thead>
                <tbody>
                  <?php 
                        foreach ($results as $ins){
                            printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td><a href='../Controler/router?action=reservepark&siteid=%s&email=%s&dos=%s&dof=%s'>click here</td>",
                                    $ins->getNumSite(),$ins->getNomPark(),$ins->getAdresse(),$ins->getPrix(),$ins->getIdSite(),$_SESSION['email'],$dos,$dof);
                        }
                    
                    
                    ?>
                </tbody>

            </table>
            </div></div>

    </body>
</html>

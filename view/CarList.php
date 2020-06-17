<html>
    <?php
    include 'fragmentHead.html';
    session_start();
    require_once '../Model/ModelVoiture.php';
    ?>
    <body>
        <?php include 'fragmentNav.html'; ?>
        <?php include 'fragmentJum.php'; ?>

        <div class="panel panel-success" style=" position: relative;top: 20px">
            <div class="panel-heading">results of your select</div>
            <div class="panel-body">
            <table class="table-striped table-bordered" style="width: 100%; " >
                <thead >
                <th scope="col" >Brand of car</th>
                <th scope="col">Date of start availble</th>
                <th scope="col">Date of finish availble</th>
                <th scope="col">Number of Seats</th>
                <th scope="col">Daily price</th>
                <th scope="col">Reserve now</th>
                </thead>
                <tbody>
                    <?php 
                        foreach ($results as $ins){
                            printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%d</td><td>%s</td><td><a href='../Controler/router?action=reserve&noplague=%s&email=%s&dos=%s&dof=%s'>click here</td>",
                                    $ins->getMarque(),$ins->getDateDebut(),$ins->getDateFin(),$ins->getNbPlace(),$ins->getPrixUnit(),$ins->getNumPlaque(),$_SESSION['email'],$dos,$dof);
                        }
                    
                    
                    ?>

                    
                </tbody>

            </table>
            </div></div>

    </body>
</html>

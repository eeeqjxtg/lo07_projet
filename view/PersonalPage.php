<html>
    <?php
    include 'fragmentHead.html';
    require_once '../Model/ModelLocation.php';
    ?>
    <body>
        <?php include 'fragmentNav.html'; ?>
        <div class="panel panel-success" style=" position: relative; top: 60px">
            <div class="panel-heading">Your car Reservation records</div>
            <div class="panel-body">
                <table class="table-striped table-bordered" style="width: 100%; " >
                    <thead >

                    <th scope="col">Date of start</th>
                    <th scope="col">Date of finish</th>

                    <th scope="col">Licence plate number</th>
                    <th scope="col">Total price</th>
                    <th scope="col">Cancel</th>

                    </thead>
                    <tbody>
                        <?php
                        foreach ($resultsC as $ins) {
                            if ($ins->getEtat() == 1) {
                                printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td><a href='../Controler/router.php?action=cancellocationcar&locid=%s'>click here</td>", $ins->getDateDebut(), $ins->getDateFin(), $ins->getNumPlaque(), $ins->getPrixTotal(), $ins->getIdLocation());
                            } else if ($ins->getEtat() == 0) {
                                printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>Unchangeable</td>", $ins->getDateDebut(), $ins->getDateFin(), $ins->getNumPlaque(), $ins->getPrixTotal());
                            } else if ($ins->getEtat() == -1) {
                                printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>ou of date</td>", $ins->getDateDebut(), $ins->getDateFin(), $ins->getNumPlaque(), $ins->getPrixTotal());
                            } else if ($ins->getEtat() == -2) {
                                printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>canceled</td>", $ins->getDateDebut(), $ins->getDateFin(), $ins->getNumPlaque(), $ins->getPrixTotal());
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel panel-success" style=" position: relative; top: 60px">
            <div class="panel-heading">Your parking Reservation records</div>
            <div class="panel-body">
                <table class="table-striped table-bordered" style="width: 100%; " >
                    <thead >

                    <th scope="col">Date of start</th>
                    <th scope="col">Date of finish</th>

                    <th scope="col">Adresse of Parking</th>
                    <th scope="col">Total price</th>
                    <th scope="col">Cancel</th>

                    </thead>
                    <tbody>
                        <?php
                        foreach ($resultsS as $ins) {
                           if($ins->getEtat()==1){
                                printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td><a href='../Controler/router.php?action=cancellocationsite&id=%s'>click here</td>", 
                                        $ins->getDateDebut(), $ins->getDateFin(), $ins->getAdress(), $ins->getPrixTotal(),$ins->getId());
                           }else if($ins->getEtat()==-2){
                                printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>canceled</td>", 
                                        $ins->getDateDebut(), $ins->getDateFin(), $ins->getAdress(), $ins->getPrixTotal());
                           }else {
                                printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>out of date</td>", 
                                        $ins->getDateDebut(), $ins->getDateFin(), $ins->getAdress(), $ins->getPrixTotal());
                           }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        
        
        <div class="panel panel-success" style=" position: relative; top: 60px">
            <div class="panel-heading">Your rent records</div>
            <div class="panel-body">
                <table class="table-striped table-bordered" style="width: 100%; " >
                    <thead >
                    <th scope="col" >Brand of car</th>
                    <th scope="col">Date of start</th>
                    <th scope="col">Date of finish</th>
                    <th scope="col">Licence plate number</th>
                    <th scope="col">Daily price</th>
                    
                    <th scope="col">Cancel</th>
                    </thead>
                    <tbody><?php
                       foreach ($resultsMC as $ins) {
                           if($ins->getEtat()==-1){
                                printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td><a href='../Controler/router.php?action=cancelcar&id=%s'>click here</td>", 
                                        $ins->getMarque(), $ins->getDateDebut(), $ins->getDateFin(), $ins->getNumPlaque(),$ins->getPrixUnit(),$ins->getId());
                          }//else if($ins->getEtat()==-2){
                             //   printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>canceled</td>", 
                            //            $ins->getDateDebut(), $ins->getDateFin(), $ins->getAdress(), $ins->getPrixTotal());
                         else {
                              printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>unchangeable</td>", 
                                        $ins->getMarque(), $ins->getDateDebut(), $ins->getDateFin(), $ins->getNumPlaque(),$ins->getPrixUnit());
                          }
                        } 
                        ?>
                    </tbody>

                </table>

            </div>
        </div>



    </body>

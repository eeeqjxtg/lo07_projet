<?php
require_once '../fragment/fragmentHead.html';
?>
    <body>
    <div class="container">
        <div><?php require_once '../fragment/fragmentNav_admin.html';?></div>
        <div class="panel-info panel">
            <div class="panel-heading ">Put cars to agence</div>
            <div class="panel-body">
                <table class = "table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th scope = "col">ID of Cars</th>
                        <th scope = "col">PLATE NUMBER</th>
                        <th scope = "col">MARQUE</th>
                        <th scope = "col">NUMBER OF PLACE</th>
                        <th scope = "col">START DATE</th>
                        <th scope = "col">END DATE</th>
                        <th scope = "col">PRICE/DAY</th>
                        <th scope = "col">AGENCE</th>
                        <th scope = "col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    // La liste des utilisatuers est dans une variable $results
                    // $attributs=array();
                    foreach ($results as $car) {
                        //print_r($results);
                        echo"<div>";
                        printf("<tr><td>%d</td><td>%s</td><td>%s</td><td>%d</td><td>%s</td><td>%s</td><td>%d</td><td>%s</td>",
                            $car->getId(), $car->getNumPlaque(),$car->getMarque(),$car->getNbPlace(),
                            $car->getDateDebut(),$car->getDateFin(),$car->getPrixUnit(),$car->getAgence());
                        echo("<td>");
                        miniform($car->getNumPlaque());
                        echo("</td>");
                        echo("</tr>");
                        echo"</div>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </body>

<?php
function miniform($no_plaque){
    echo"<div>";
    echo("<form role='form' method='get' action='../controler/router.php'>");
    echo("<input type='submit' id='submit' value='Confirm'>");
    echo("<input type='hidden' name='controller' value='admin'>");
    echo("<input type='hidden' name='action' value='putCarsAtAgence_done'>");
    echo("<input type='hidden' name='change' value='putCarsAtAgence'>");
    echo("<input type='hidden' name='no_plaque' value='$no_plaque'>");
    echo("</form>");
    echo"</div>";
}
?>
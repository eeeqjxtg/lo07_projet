<?php
require_once '../fragment/fragmentHead.html';
?>

    <body>
    <div class="container">
        <div><?php require_once '../fragment/fragmentNav_admin.html';?></div>
        <div class="panel-info panel">
            <div class="panel-heading ">Confirmation : Rent Cars</div>
            <div class="panel-body">
                <table class = "table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th scope = "col">ID of Location</th>
                        <th scope = "col">PLATE NUMBER</th>
                        <th scope = "col">START DATE</th>
                        <th scope = "col">END DATE</th>
                        <th scope = "col">TOTAL PRICE</th>
                        <th scope = "col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    // La liste des utilisatuers est dans une variable $results
                    // $attributs=array();
                    foreach ($results as $car) {
                        echo"<div>";
                        printf("<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td>",
                            $car->getIdLocation(), $car->getNumPlaque(),
                            $car->getDateDebut(),$car->getDateFin(),
                            $car->getPrixTotal());
                        echo("<td>");
                        miniform($car->getIdLocation(),$car->getNumPlaque());
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
function miniform($id,$no_plaque){
    echo"<div>";
    echo("<form role='form' method='get' action='../controler/router.php'>");
    echo("<input type='submit' id='submit' value='Confirm'>");
    echo("<input type='hidden' name='controller' value='admin'>");
    echo("<input type='hidden' name='action' value='rentCars_done'>");
    echo("<input type='hidden' name='change' value='rent_cars'>");
    echo("<input type='hidden' name='id_location' value='$id'>");
    echo("<input type='hidden' name='no_plaque' value='$no_plaque'>");
    echo("</form>");
    echo"</div>";
}
?>
<?php
require_once '../fragment/fragmentHead.html';
?>

<body>
<div class="container">
    <div><?php require_once '../fragment/fragmentNav_admin.html';?></div>
    <div class="panel-info panel">
       <div class="panel-heading ">Return Cars</div>
      <div class="panel-body">
        <table class = "table table-striped table-bordered">
            <thead>
            <tr>
                <th scope = "col">ID of LOCATION</th>
                <th scope = "col">PLATE NUMBER</th>
                <th scope = "col">EMAIL OF BORROWER</th>
                <th scope = "col">START DATE</th>
                <th scope = "col">END DATE</th>
                <th scope = "col">TOTAL PRICE</th>
                <th scope = "col">TOTAL PRICE</th>
            </tr>
            </thead>
            <tbody>
            <?php

            // La liste des utilisatuers est dans une variable $results
            // $attributs=array();
            foreach ($results as $location) {
                echo"<div>";
                printf("<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%d</td>",
                    $location->getIdLocation(), $location->getNumPlaque(), $location->getPropTempEmail(),
                    $location->getDateDebut(),$location->getDateFin(),$location->getPrixTotal());
                echo("<td>");
                miniform($location->getIdLocation(),$location->getNumPlaque());
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
    echo("<input type='hidden' name='action' value='returnCars_done'>");
    echo("<input type='hidden' name='change' value='return_cars'>");
    echo("<input type='hidden' name='id_location' value='$id'>");
    echo("<input type='hidden' name='no_plaque' value='$no_plaque'>");
    echo("</form>");
    echo"</div>";
}
?>
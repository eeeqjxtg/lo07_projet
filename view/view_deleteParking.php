<?php
require_once '../fragment/fragmentHead.html';
require_once '../Model/ModelParking.php';
?>

<body>
<div class="container">
    <div><?php require_once '../fragment/fragmentNav_admin.html';?></div>
    <div>
        <table class = "table table-striped table-bordered">
            <thead>
            <tr>
                <th scope = "col">ID</th>
                <th scope = "col">LABEL</th>
                <th scope = "col">PARKING NAME</th>
                <th scope = "col">ADDRESS</th>
                <th scope = "col">NUMBER OF SITE</th>
            </tr>
            </thead>
            <tbody>
            <?php

            if(@$delete_result != NULL){
                if($delete_result == 'done'){
                    echo "<script>window.alert('Delete successful !')</script>";
                }
                else if($delete_result === 'zero'){
                    echo "<script>window.alert('Wrong id !')</script>";
                }
            }
            // La liste des utilisatuers est dans une variable $results
           // $attributs=array();
            foreach ($results as $parking) {
               // echo("<tr>");
               // echo("<td>.$parking->getIdParking().</td>")
               // echo ("</tr>");
                printf("<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td><td>%d</td></tr>",
                    $parking->getIdParking(), $parking->getLabel(), $parking->getNomParking(),$parking->getAdress(),$parking->getNbSite());
            }
            ?>
            </tbody>
        </table>
    </div>
    <div>
        <form role="form" method='get' action="../controler/router.php" >
            <div class='form-group'>
                <input type="hidden" name="action" value="delete_done_parking">
                <input type="hidden" name="controller" value="admin">
                <input type="hidden" name="change" value="delete">
                <label>Delete a parking</label>
                <input type='text' class='form-control' id='delete_parking' name='id_parking' placeholder="id_parking">
            </div>
            <input type='submit' id='submit' value='Delete'/>
        </form>
    </div>
</div>
</body>
<?php
require_once '../fragment/fragmentHead.html';
include "../fragment/bibliotheque.php";
?>

<body>
<div class="container">
    <div><?php require_once '../fragment/fragmentNav_admin.html';?></div>
    <?php
    formHead('ADD NEW SITES','get','../controler/router.php');
    echo("<input type='hidden' name='action' value='addSite_done'>");
    echo("<input type='hidden' name='controller' value='admin'>");
    echo("<input type='hidden' name='change' value='add'>");
    echo("<input type='hidden' name='id_parking' value='$id'>");
    for($i=1;$i<=$number;$i++){
        formInput("SITE NUMBER",'num_site'.$i);
        formDate('date_disp_debut'.$i,"START TIME");
        formDate('date_disp_fin'.$i,"END TIME");
        formInput("PRICE/DAY",'prix_unit'.$i);
        echo("<hr>");
    }
    submit("Confirm");
    formFoot();
    ?>
</div>
</body>
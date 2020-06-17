<?php
require_once '../fragment/fragmentHead.html';
include "../fragment/bibliotheque.php";
?>

<body>
<div class="container">
    <div><?php require_once '../fragment/fragmentNav_admin.html';?></div>
    <?php
    if(@$success == '1'){
        echo "<script>window.alert('Insert success !')</script>";}

    formHead('ADD A NEW PARKING','get','../controler/router.php');
    echo("<input type='hidden' name='action' value='addParking_done'>");
    echo("<input type='hidden' name='controller' value='admin'>");
    echo("<input type='hidden' name='change' value='add'>");
    formInput('PARKING NAME','nom_parking');
    formInput('ADDRESS','adress');
    formInput('LABEL','label');
    formInput('NUMBER OF SITE','nb_site');
    submit("Next");
    formFoot();
    ?>

</div>
</body>
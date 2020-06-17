<?php
require_once '../fragment/fragmentHead.html';
?>

<body>
<div class="container">
<div><?php require_once '../fragment/fragmentNav_admin.html';?></div>
<div>
    <table class = "table table-striped table-bordered">
        <thead>
        <tr>
            <th scope = "col">SURNAME</th>
            <th scope = "col">FIRST NAME</th>
            <th scope = "col">EMAIL</th>
            <th scope = "col">PHONE</th>
        </tr>
        </thead>
        <tbody>
        <?php

        if($delete_result != NULL){
            if($delete_result == 'done'){
               // echo'<h3>L\'utilisateur est bien supprimé</h3>';
                echo "<script>window.alert('Delete successful !')</script>";
            }
            else if($delete_result === 'zero'){
               // echo'<h3>Il n\'y a pas cet utilisateur</h3>';
                echo "<script>window.alert('Wrong email')</script>";
            }
        }
        // La liste des utilisatuers est dans une variable $results
        foreach ($results as $customer) {
            printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%d</td></tr>",
                $customer->getNom(), $customer->getPrenom(), $customer->getEmail(),$customer->getPhone());
        }
        ?>
        </tbody>
    </table>
</div>
<div>
    <form role="form" method='get' action="../controler/router.php" >
        <div class='form-group'>
            <input type="hidden" name="action" value="delete_done">
            <input type="hidden" name="controller" value="admin">
            <input type="hidden" name="change" value="delete">
            <label>Delete a customer</label>
            <input type='text' class='form-control' id='delete_user' name='email' placeholder="email">
        </div>
        <input type='submit' id='submit' value='Delete'/>
    </form>
</div>
</div>
</body>